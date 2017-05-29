<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Portfolio;
use App\Models\Backend\PortfolioCategory;
use Illuminate\Support\Facades\Input;

class PortfolioController extends Controller {
    /**
     * Show all portfolios
     */
    public function showPortfolios() {
        return view('backend.portfolio.index');
    }

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
        $categoryClass = new PortfolioCategory();
        $categoryClass->name = Input::get('name');
        $slug = Input::get('slug') ? Input::get('slug') : Input::get('name');
        $categoryClass->slug = str_slug($slug);
        $categoryClass->description = Input::get('description');
        $categoryClass->ordering = 9223372036854775807;
        $categoryClass->save();

        return redirect('portfolio/category');
    }
}