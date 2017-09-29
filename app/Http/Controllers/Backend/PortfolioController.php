<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Media;
use App\Models\Backend\Portfolio;
use App\Models\Backend\PortfolioCategoryRelationships;
use App\Models\Backend\PortfolioMediaRelationships;
use App\Models\Backend\PortfolioTagRelationships;
use App\Models\Backend\PortfolioTechnologyRelationships;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller {
    /**
     * Show all portfolios
     */
    public function showPortfolios() {
        return view('backend.portfolio.index');
    }

    /**
     * Get the portfolios in API
     */
    public function getPortfoliosAPI() {
        $data = [];

        $sql = "
        SELECT p.*, m.path AS file_path, (
          SELECT GROUP_CONCAT(`name` SEPARATOR ', ') FROM portfolio_categories WHERE id IN (SELECT category_id FROM portfolio_category_relationships WHERE portfolio_id=p.id)
        ) AS categories, (
          SELECT GROUP_CONCAT(`name` SEPARATOR ', ') FROM portfolio_tags WHERE id IN (SELECT tag_id FROM portfolio_tag_relationships WHERE portfolio_id=p.id)
        ) as tags
        FROM portfolios AS p
        LEFT JOIN media AS m ON m.id=p.featured_image
        ORDER BY p.ordering
        ";
        $rows = DB::select($sql, []);

        for ($i = 0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $row->DT_RowId = 'row_' . $row->id;
            $row->no = $i + 1;
            $row->DT_RowData = ['id' => $row->id];

            if ($row->file_path) {
                $path_parts = pathinfo($row->file_path);
                $row->thumbnail = '<img class="thumbnail" src="'. url('storage/portfolio_featured_images/'. $path_parts['filename'] .'_400x300.'. $path_parts['extension']) .'" />';
            } else {
                $row->thumbnail = '';
            }

            $row->visibility = $row->visibility ? '<span class="label label-sm label-success"> Show </span>' : '<span class="label label-sm label-danger"> Hidden </span>';

            if ($row->url)
                $row->title = '<a href="'. $row->url .'" target="_blank">'. $row->title .'</a>';

            $row->design_level = config('constants.design_levels')[$row->design_level];
        }
        $data['data'] = $rows;

        return response()->json($data);
    }

    /**
     * Reorder portfolio
     */
    public function reorderPortfolio() {
        $portfolioClass = new Portfolio();
        $portfolioClass->reOrder();

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * New portfolio
     */
    public function newPortfolio() {
        $categories = DB::table('portfolio_categories')->orderBy('ordering', 'asc')->get();
        $tags = DB::table('portfolio_tags')->get();
        $technologies = DB::table('portfolio_technologies')->get();

        return view('backend.portfolio.new', ['categories' => $categories, 'tags' => $tags, 'technologies' => $technologies]);
    }

    /**
     * Edit portfolio
     */
    public function editPortfolio($id) {
        $portfolio = Portfolio::find($id);

        // Featured image
        $featured_image = Media::find($portfolio->featured_image);
        $portfolio->thumbnail = url('storage/'. $featured_image->path);

        // Categories
        $selected_categories = DB::table('portfolio_category_relationships')->where('portfolio_id', $portfolio->id)->pluck('category_id')->toArray();

        // Tags
        $selected_tags = DB::table('portfolio_tag_relationships')->where('portfolio_id', $portfolio->id)->pluck('tag_id')->toArray();

        // Technologies
        $selected_technologies = DB::table('portfolio_technology_relationships')->where('portfolio_id', $portfolio->id)->pluck('tech_id')->toArray();

        $categories = DB::table('portfolio_categories')->orderBy('ordering', 'asc')->get();
        $tags = DB::table('portfolio_tags')->get();
        $technologies = DB::table('portfolio_technologies')->get();

        return view('backend.portfolio.edit', ['portfolio' => $portfolio, 'categories' => $categories, 'tags' => $tags, 'technologies' => $technologies, 'selected_categories' => $selected_categories, 'selected_tags' => $selected_tags, 'selected_technologies' => $selected_technologies]);
    }

    /**
     * Save portfolio
     */
    public function savePortfolio(Request $request) {
        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $portfolioClass = Portfolio::find($id);
        } else {    // New
            $portfolioClass = new Portfolio();
            $portfolioClass->ordering = 99999999;
        }

        /**
         * Save thumbnail
         */
        if ($request->file('thumbnail')) {
            if ($id)
                Storage::delete($portfolioClass->featured_image);

            $mediaObj = new Media();
            $mid = $mediaObj->generatePortfolioThumbnail($request);

            $portfolioClass->featured_image = $mid;
        }

        $portfolioClass->title = Input::get('title');
        $portfolioClass->overview = Input::get('overview');
        $portfolioClass->url = Input::get('url');
        $portfolioClass->completed_date = Input::get('completed_date');
        $portfolioClass->design_level = Input::get('design_level');
        $portfolioClass->client = Input::get('client');
        $portfolioClass->visibility = Input::get('visibility');
        $portfolioClass->save();

        $portfolioClass->updateOrder();

        /**
         * Remove temp flag for featured image
         */
        $mediaClass = Media::find($portfolioClass->featured_image);
        $mediaClass->temp = 0;
        $mediaClass->save();

        /**
         * Save category relationships
         */
        $category_ids = Input::get('category');
        $exist_category_ids = DB::table('portfolio_category_relationships')->where('portfolio_id', $portfolioClass->id)->pluck('category_id')->toArray();
        // Add new categories
        $diff_category_ids = array_diff($category_ids, $exist_category_ids);
        foreach ($diff_category_ids as $cid) {
            $CRClass = new PortfolioCategoryRelationships();
            $CRClass->portfolio_id = $portfolioClass->id;
            $CRClass->category_id = $cid;
            $CRClass->ordering = 999999;
            $CRClass->save();
        }
        // Remove deleted categories
        $diff_category_ids = array_diff($exist_category_ids, $category_ids);
        DB::table('portfolio_category_relationships')
            ->where('portfolio_id', $portfolioClass->id)
            ->whereIn('category_id', $diff_category_ids)
            ->delete();

        /**
         * Save media relationships
         */
        $media_ids = explode(',', Input::get('portfolio_files'));
        $exist_media_ids = DB::table('portfolio_media_relationships')->where('portfolio_id', $portfolioClass->id)->pluck('media_id')->toArray();
        // Add new medias
        $diff_media_ids = array_diff($media_ids, $exist_media_ids);
        foreach ($diff_media_ids as $mid) {
            if (!$mid) continue;

            $MRClass = new PortfolioMediaRelationships();
            $MRClass->portfolio_id = $portfolioClass->id;
            $MRClass->media_id = $mid;
            $MRClass->ordering = 999999;
            $MRClass->save();

            $mediaClass = Media::find($mid);
            $mediaClass->temp = 0;
            $mediaClass->save();
        }
        // Remove deleted medias
        $diff_media_ids = array_diff($exist_media_ids, $media_ids);
        DB::table('portfolio_media_relationships')
            ->where('portfolio_id', $portfolioClass->id)
            ->whereIn('media_id', $diff_media_ids)
            ->delete();

        /**
         * Save tag relationships
         */
        $tag_ids = Input::get('tags');
        $exist_tag_ids = DB::table('portfolio_tag_relationships')->where('portfolio_id', $portfolioClass->id)->pluck('tag_id')->toArray();
        // Add new tags
        $diff_tag_ids = array_diff($tag_ids, $exist_tag_ids);
        foreach ($diff_tag_ids as $tid) {
            $TRClass = new PortfolioTagRelationships();
            $TRClass->portfolio_id = $portfolioClass->id;
            $TRClass->tag_id = $tid;
            $TRClass->ordering = 999999;
            $TRClass->save();
        }
        // Remove deleted tags
        $diff_tag_ids = array_diff($exist_tag_ids, $tag_ids);
        DB::table('portfolio_tag_relationships')
            ->where('portfolio_id', $portfolioClass->id)
            ->whereIn('tag_id', $diff_tag_ids)
            ->delete();

        /**
         * Save technology relationships
         */
        $technology_ids = Input::get('technologies');
        $exist_technology_ids = DB::table('portfolio_technology_relationships')->where('portfolio_id', $portfolioClass->id)->pluck('tech_id')->toArray();
        // Add new technologies
        $diff_technology_ids = array_diff($technology_ids, $exist_technology_ids);
        foreach ($diff_technology_ids as $tid) {
            $TRClass = new PortfolioTechnologyRelationships();
            $TRClass->portfolio_id = $portfolioClass->id;
            $TRClass->tech_id = $tid;
            $TRClass->ordering = 999999;
            $TRClass->save();
        }
        // Remove deleted technologies
        $diff_technology_ids = array_diff($exist_technology_ids, $technology_ids);
        DB::table('portfolio_technology_relationships')
            ->where('portfolio_id', $portfolioClass->id)
            ->whereIn('tech_id', $diff_technology_ids)
            ->delete();

        return redirect('admin_1lkh6x/portfolios');
    }

    /**
     * Delete portfolio
     */
    public function deletePortfolio(Request $request, $id) {
        // Get the portfolio in the database
        $portfolioObj = Portfolio::find($id);

        // Remove the data in portfolio table
        Portfolio::destroy($id);

        // Remove featured image
        $featuredImageObj = Media::find($portfolioObj->featured_image);
        if (isset($featuredImageObj->id)) {
            Storage::delete($featuredImageObj->path);
            $path_parts = pathinfo($featuredImageObj->path);
            Storage::delete('portfolio_featured_images/'. $path_parts['filename'] .'_400x300.'. $path_parts['extension']);

            Media::destroy($featuredImageObj->id);
        }

        // Remove files
        $sql = "SELECT m.*
                FROM portfolio_media_relationships AS r
                INNER JOIN media AS m ON m.id=r.`media_id`
                WHERE r.`portfolio_id` = ?
                ORDER BY r.`ordering`";
        $rows = DB::select($sql, [$portfolioObj->id]);
        foreach ($rows as $row) {
            Storage::delete($row->path);

            Media::destroy($row->id);
        }

        // Remove the data in relationships tables
        DB::table('portfolio_media_relationships')->where('portfolio_id', $portfolioObj->id)->delete();
        DB::table('portfolio_category_relationships')->where('portfolio_id', $portfolioObj->id)->delete();
        DB::table('portfolio_tag_relationships')->where('portfolio_id', $portfolioObj->id)->delete();
        DB::table('portfolio_technology_relationships')->where('portfolio_id', $portfolioObj->id)->delete();

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Uploaded files in API
     */
    public function uploadedFilesAPI($portfolio_id) {
        $files = [ 'files' => [] ];

        $sql = "SELECT m.*
                FROM portfolio_media_relationships AS r
                INNER JOIN media AS m ON m.id=r.`media_id`
                WHERE r.`portfolio_id` = ?
                ORDER BY r.`ordering`";
        $rows = DB::select($sql, [$portfolio_id]);

        foreach ($rows as $row) {
            $file_data = [
                'id' => $row->id,
                'name' => $row->file_name,
                'size' => $row->file_size,
                'url' => $row->url,
                'deleteType' => 'GET',
                'deleteUrl' => url('/admin_1lkh6x/portfolio/delete_file?mid='. $row->id .'&pid='. $portfolio_id)
            ];
            $image_extensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
            if (in_array(strtolower($row->file_extension), $image_extensions)) {
                $file_data['is_image'] = 1;
            }

            $files['files'][] = $file_data;
        }

        return response()->json($files);
    }

    /**
     * Upload file
     */
    public function uploadFile(Request $request) {
        set_time_limit(7200);

        $files = [ 'files' => [] ];

        $mediaObj = new Media();
        $file = $mediaObj->uploadPortfolioFile($request);
        if ($file)
            $files['files'][] = $file;

        return response()->json($files);
    }

    /**
     * Delete file
     */
    public function deleteFile() {
        $mid = Input::get('mid', 0);
        $pid = Input::get('pid', 0);

        // Get data in database
        $obj = Media::find($mid);

        // Remove file
        if ($obj->path) {
            Storage::delete($obj->path);
        }

        // Remove data in media table
        Media::destroy($mid);

        // Remove data in portfolio_media_relationships table
        DB::table('portfolio_media_relationships')
            ->where('portfolio_id', $pid)
            ->where('media_id', $mid)
            ->delete();

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }
}