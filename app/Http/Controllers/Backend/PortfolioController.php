<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Media;
use App\Models\Backend\Portfolio;
use App\Models\Backend\PortfolioMediaRelationships;
use App\Models\Backend\PortfolioTagRelationships;
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
     * New portfolio
     */
    public function newPortfolio() {
        $categories = DB::table('portfolio_categories')->orderBy('ordering', 'asc')->get();
        $tags = DB::table('portfolio_tags')->get();

        return view('backend.portfolio.new', ['categories' => $categories, 'tags' => $tags]);
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

        // Save thumbnail
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

        // Remove temp flag for featured image
        $mediaClass = Media::find($portfolioClass->featured_image);
        $mediaClass->temp = 0;
        $mediaClass->save();


        // Save media relationships
        $media_ids = explode(',', Input::get('portfolio_files'));
        $exist_media_ids = DB::table('portfolio_media_relationships')->where('portfolio_id', $portfolioClass->id)->pluck('media_id')->toArray();
        $diff_media_ids = array_diff($media_ids, $exist_media_ids);
        foreach ($diff_media_ids as $mid) {
            $MRClass = new PortfolioMediaRelationships();
            $MRClass->portfolio_id = $portfolioClass->id;
            $MRClass->media_id = $mid;
            $MRClass->ordering = 999999;
            $MRClass->save();

            $mediaClass = Media::find($mid);
            $mediaClass->temp = 0;
            $mediaClass->save();
        }

        // Save tag relationships
        $tag_ids = Input::get('tags');
        $exist_tag_ids = DB::table('portfolio_tag_relationships')->where('portfolio_id', $portfolioClass->id)->pluck('tag_id')->toArray();
        $diff_tag_ids = array_diff($tag_ids, $exist_tag_ids);
        foreach ($diff_tag_ids as $tid) {
            $TRClass = new PortfolioTagRelationships();
            $TRClass->portfolio_id = $portfolioClass->id;
            $TRClass->tag_id = $tid;
            $TRClass->ordering = 999999;
            $TRClass->save();
        }

        return redirect('portfolios');
    }

    /**
     * Uploaded files in API
     */
    public function uploadedFilesAPI($id) {
        $files = [ 'files' => [] ];

        $files = [];
        foreach ($files as $file) {
            $files['files'][] = [
                'id' => $file->id,
                'name' => $file->file_name,
                'size' => $file->file_size,
                'url' => $file->url,
                'deleteType' => 'GET',
                'deleteUrl' => url('/portfolio/delete_file/'. $file->id)
            ];
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
}