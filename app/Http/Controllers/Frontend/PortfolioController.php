<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Media;
use App\Models\Backend\Portfolio;
use App\Models\Backend\PortfolioCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller {
    public function index() {
        $categories = PortfolioCategory::orderBy('ordering', 'asc')
                        ->get();

        $sql = "SELECT p.*, m.url AS featured_image_url, m.path AS featured_image_path
                FROM portfolios AS p
                LEFT JOIN media AS m ON m.id = p.featured_image AND m.temp = 0
                WHERE visibility = 1
                ORDER BY ordering ASC
                LIMIT 0, ?";
        $portfolios = DB::select($sql, [env('PORTFOLIO_COUNT_PER_PAGE')]);
        for ($i = 0; $i < count($portfolios); $i++) {
            $portfolio = &$portfolios[$i];

            $sql = "SELECT c.name, c.`slug`
                    FROM portfolio_categories AS c
                    INNER JOIN portfolio_category_relationships AS cr ON cr.`category_id`=c.`id`
                    WHERE cr.`portfolio_id` = ?";
            $p_categories = DB::select($sql, [$portfolio->id]);
            $portfolio->category_slugs = $portfolio->category_names = '';
            foreach($p_categories as $p_category) {
                if ($portfolio->category_names)
                    $portfolio->category_names .= ' / '. $p_category->name;
                else
                    $portfolio->category_names = $p_category->name;
                $portfolio->category_slugs .= ' '. $p_category->slug;
            }

            $path_parts = pathinfo($portfolio->featured_image_path);
            $path = 'portfolio_featured_images/'. $path_parts['filename'] .'_400x300.'. $path_parts['extension'];
            $portfolio->featured_image_thumbnail = Storage::url($path);
        }

        return view('frontend.portfolio', ['categories' => $categories, 'portfolios' => $portfolios]);
    }

    public function detail($id) {
        $portfolio = Portfolio::find($id);

        // Featured image
        $featured_image = Media::find($portfolio->featured_image);

        // Get portfolio images
        $sql = "SELECT m.*
                FROM `media` AS m
                INNER JOIN `portfolio_media_relationships` AS pmr ON m.id = pmr.`media_id`
                WHERE pmr.`portfolio_id` = ?";
        $images = DB::select($sql, [$portfolio->id]);

        // Get categories
        $sql = "SELECT c.name, c.`slug`
                    FROM portfolio_categories AS c
                    INNER JOIN portfolio_category_relationships AS cr ON cr.`category_id`=c.`id`
                    WHERE cr.`portfolio_id` = ?";
        $p_categories = DB::select($sql, [$portfolio->id]);
        $category_names = '';
        foreach($p_categories as $p_category) {
            if ($category_names)
                $category_names .= ', '. $p_category->name;
            else
                $category_names = $p_category->name;
        }

        // Get tags
        $sql = "SELECT t.name, t.`slug`
                    FROM portfolio_tags AS t
                    INNER JOIN portfolio_tag_relationships AS tr ON tr.`tag_id`=t.`id`
                    WHERE tr.`portfolio_id` = ?";
        $p_tags = DB::select($sql, [$portfolio->id]);
        $tag_names = '';
        foreach($p_tags as $p_tag) {
            if ($tag_names)
                $tag_names .= ', '. $p_tag->name;
            else
                $tag_names = $p_tag->name;
        }
        ?>
        <div class="portfolio-content">
            <div class="cbp-l-project-title"><?php echo $portfolio->title; ?></div>
            <!--<div class="cbp-l-project-subtitle">by Paul Flavius Nechita</div>-->
            <div class="cbp-slider">
                <ul class="cbp-slider-wrap">
                    <li class="cbp-slider-item">
                        <a href="<?php echo $featured_image->url; ?>" class="cbp-lightbox">
                            <img src="<?php echo $featured_image->url; ?>" alt=""> </a>
                    </li>
                    <?php
                    foreach ($images as $image) {
                        ?>
                        <li class="cbp-slider-item">
                            <a href="<?php echo $image->url; ?>" class="cbp-lightbox">
                                <img src="<?php echo $image->url; ?>" alt=""> </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="cbp-l-project-container">
                <div class="cbp-l-project-desc">
                    <div class="cbp-l-project-desc-title">
                        <span>Project Description</span>
                    </div>
                    <div class="cbp-l-project-desc-text"><?php echo $portfolio->overview; ?></div>
                </div>
                <div class="cbp-l-project-details">
                    <div class="cbp-l-project-details-title">
                        <span>Project Details</span>
                    </div>
                    <ul class="cbp-l-project-details-list">
                        <?php
                        if ($portfolio->client)
                            echo "<li><strong>Client</strong>{$portfolio->client}</li>";
                        if ($portfolio->completed_date)
                            echo "<li><strong>Date</strong>{$portfolio->completed_date}</li>";
                        ?>
                        <li><strong>Categories</strong><?php echo $category_names; ?></li>
                        <li><strong>Tags</strong><?php echo $tag_names; ?></li>
                    </ul>
                    <a href="<?php echo $portfolio->url; ?>" target="_blank" class="cbp-l-project-details-visit btn red uppercase">visit the site</a>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
        <?php
    }
}