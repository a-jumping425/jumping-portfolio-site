<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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

        // Get portfolio images
        $sql = "SELECT m.*
                FROM `media` AS m
                INNER JOIN `portfolio_media_relationships` AS pmr ON m.id = pmr.`media_id`
                WHERE pmr.`portfolio_id` = ?";
        $images = DB::select($sql, [$portfolio->id]);

        ?>
        <div class="portfolio-content">
            <div class="cbp-l-project-title"><?php echo $portfolio->title; ?></div>
            <!--<div class="cbp-l-project-subtitle">by Paul Flavius Nechita</div>-->
            <div class="cbp-slider">
                <ul class="cbp-slider-wrap">
                    <li class="cbp-slider-item">
                        <a href="/assets/global/img/portfolio/1200x900/06.jpg" class="cbp-lightbox">
                            <img src="/assets/global/img/portfolio/1200x900/06.jpg" alt=""> </a>
                    </li>
                    <li class="cbp-slider-item">
                        <a href="/assets/global/img/portfolio/1200x900/08.jpg" class="cbp-lightbox">
                            <img src="/assets/global/img/portfolio/1200x900/08.jpg" alt=""> </a>
                    </li>
                    <li class="cbp-slider-item">
                        <a href="/assets/global/img/portfolio/1200x900/77.jpg" class="cbp-lightbox">
                            <img src="/assets/global/img/portfolio/1200x900/77.jpg" alt=""> </a>
                    </li>
                </ul>
            </div>
            <div class="cbp-l-project-container">
                <div class="cbp-l-project-desc">
                    <div class="cbp-l-project-desc-title">
                        <span>Project Description</span>
                    </div>
                    <div class="cbp-l-project-desc-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, cumque, earum blanditiis incidunt minus commodi consequatur provident quae. Nihil, alias, vel consequatur ab aliquam aspernatur optio harum facilis excepturi mollitia autem
                        voluptas cum ex veniam numquam quia repudiandae in iure. Assumenda, vel provident molestiae perferendis officia commodi asperiores earum sapiente inventore quam deleniti mollitia consequatur expedita quaerat natus praesentium beatae aut
                        ipsa non ex ullam atque suscipit ut dignissimos magnam!</div>
                </div>
                <div class="cbp-l-project-details">
                    <div class="cbp-l-project-details-title">
                        <span>Project Details</span>
                    </div>
                    <ul class="cbp-l-project-details-list">
                        <li>
                            <strong>Client</strong>John Doe</li>
                        <li>
                            <strong>Date</strong>22 December 2013</li>
                        <li>
                            <strong>Categories</strong>Logo, Graphic</li>
                    </ul>
                    <a href="#" target="_blank" class="cbp-l-project-details-visit btn red uppercase">visit the site</a>
                </div>
            </div>
            <div class="cbp-l-project-container">
                <div class="cbp-l-project-related">
                    <div class="cbp-l-project-desc-title">
                        <span>Related Projects</span>
                    </div>
                    <ul class="cbp-l-project-related-wrap">
                        <li class="cbp-l-project-related-item">
                            <a href="/assets/global/plugins/cubeportfolio/ajax/project1.html" class="cbp-singlePage cbp-l-project-related-link" rel="nofollow">
                                <img src="/assets/global/img/portfolio/600x600/1.jpg" alt="">
                                <div class="cbp-l-project-related-title">Speed Detector</div>
                            </a>
                        </li>
                        <li class="cbp-l-project-related-item">
                            <a href="/assets/global/plugins/cubeportfolio/ajax/project2.html" class="cbp-singlePage cbp-l-project-related-link" rel="nofollow">
                                <img src="/assets/global/img/portfolio/600x600/5.jpg" alt="">
                                <div class="cbp-l-project-related-title">World Clock Widget</div>
                            </a>
                        </li>
                        <li class="cbp-l-project-related-item">
                            <a href="/assets/global/plugins/cubeportfolio/ajax/project1.html" class="cbp-singlePage cbp-l-project-related-link" rel="nofollow">
                                <img src="/assets/global/img/portfolio/600x600/27.jpg" alt="">
                                <div class="cbp-l-project-related-title">To-Do Dashboard</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
        <?php
    }
}