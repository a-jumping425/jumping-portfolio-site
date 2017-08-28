<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioCategory;
use Illuminate\Support\Facades\Input;

class PortfolioCategoryController extends Controller {
    /**
     * Show categories
     */
    public function showCategories() {
        return view('backend.portfolio.category.index');
    }

    /**
     * Save category
     */
    public function saveCategory() {

        $id = Input::get('id', 0);
        if( $id ) {  // Update
            $categoryClass = PortfolioCategory::find($id);
        } else {    // New
            $categoryClass = new PortfolioCategory();
            $categoryClass->ordering = 9223372036854775807;
        }

        $categoryClass->name = Input::get('name');
        $slug = Input::get('slug') ? Input::get('slug') : Input::get('name');
        $categoryClass->slug = str_slug($slug);
        $categoryClass->description = Input::get('description');
        $categoryClass->save();

        $categoryClass->updateOrder();

        return redirect('admin_1lkh6x/portfolio/categories');
    }

    /**
     * Delete category
     * @param int $id The category id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCategory($id) {
        PortfolioCategory::destroy($id);

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }

    /**
     * Edit category
     */
    public function editCategory($id) {
        $category = PortfolioCategory::find($id);

        return view('backend.portfolio.category.edit', ['category' => $category]);
    }

    /**
     * Reorder category
     */
    public function reorderCategory() {
        $categoryClass = new PortfolioCategory();
        $categoryClass->reOrder();

        // result => 1: success, 0: error
        $data = ['result' => 1];

        return response()->json($data);
    }
}