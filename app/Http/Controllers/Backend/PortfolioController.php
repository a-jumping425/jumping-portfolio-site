<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Portfolio;

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
        $portfolioObj = new Portfolio();
        $portfolioObj->saveCategory();

        return redirect('portfolio/category');
    }
}