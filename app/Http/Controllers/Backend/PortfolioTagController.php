<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioTag;
use Illuminate\Support\Facades\Input;

class PortfolioTagController extends Controller {
    /**
     * Show tags
     */
    public function showTags() {
        return view('backend.portfolio.tag.index');
    }

    /**
     * Save tag
     */
    public function saveTag() {

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $tagClass = PortfolioTag::find($id);
        } else {    // New
            $tagClass = new PortfolioTag();
        }

        $tagClass->name = Input::get('name');
        $slug = Input::get('slug') ? Input::get('slug') : Input::get('name');
        $tagClass->slug = str_slug($slug);
        $tagClass->description = Input::get('description');
        $tagClass->save();

        return redirect('admin_1lkh6x/portfolio/tags');
    }

    /**
     * Delete tag
     * @param int $id The tag id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTag($id) {
        PortfolioTag::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Edit tag
     */
    public function editTag($id) {
        $tag = PortfolioTag::find($id);

        return view('backend.portfolio.tag.edit', ['tag' => $tag]);
    }
}
