<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioTechnology;
use Illuminate\Support\Facades\Input;

class PortfolioTechnologyController extends Controller {
    /**
     * Show technologies
     */
    public function showTechnologies() {
        return view('backend.portfolio.technology.index');
    }

    /**
     * Save technology
     */
    public function saveTechnology() {

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $techClass = PortfolioTechnology::find($id);
        } else {    // New
            $techClass = new PortfolioTechnology();
        }

        $techClass->name = Input::get('name');
        $slug = Input::get('slug') ? Input::get('slug') : Input::get('name');
        $techClass->slug = str_slug($slug);
        $techClass->description = Input::get('description');
        $techClass->save();

        return redirect('admin_1lkh6x/portfolio/technologies');
    }

    /**
     * Delete technology
     * @param int $id The technology id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTechnology($id) {
        PortfolioTechnology::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Edit technology
     */
    public function editTechnology($id) {
        $technology = PortfolioTechnology::find($id);

        return view('backend.portfolio.technology.edit', ['technology' => $technology]);
    }
}
