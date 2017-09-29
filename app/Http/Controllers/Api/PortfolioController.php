<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

class PortfolioController extends Controller {
    /**
     * load more
     */
    public function loadMore() {
        $block = Input::get('block');
        $count_per_page = env('PORTFOLIO_COUNT_PER_PAGE');

        $sql = "SELECT COUNT(id) as total FROM portfolios";
        $total = DB::select($sql);
        $total = $total[0]->total;
        var_dump($total);

        $sql = "SELECT p.*, m.url AS featured_image_url, m.path AS featured_image_path
                FROM portfolios AS p
                LEFT JOIN media AS m ON m.id = p.featured_image AND m.temp = 0
                ORDER BY ordering ASC
                LIMIT ?, ?";
        $portfolios = DB::select($sql, [$count_per_page * $block, $count_per_page]);

        echo "<div class='cbp-loadMore-block{$block}'>";
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
            ?>
            <div class="cbp-item <?php echo $portfolio->category_slugs; ?>">
                <div class="cbp-caption">
                    <div class="cbp-caption-defaultWrap">
                        <img src="<?php echo $portfolio->featured_image_thumbnail; ?>" alt=""> </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignCenter">
                            <div class="cbp-l-caption-body">
                                <a href="portfolio/<?php echo  $portfolio->id; ?>" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" rel="nofollow">more info</a>
                                <a href="<?php echo $portfolio->featured_image_url; ?>" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="<?php echo $portfolio->title; ?>">view larger</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php echo $portfolio->title; ?></div>
                <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center"><?php echo $portfolio->overview; ?></div>
            </div>
            <?php
        }
        echo '</div>';

        if ($total > ($block + 1) * $count_per_page) {
            echo "<div class='cbp-loadMore-block". ($block + 1) ."'></div>";
        }
    }
}
