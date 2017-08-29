<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class PortfolioController extends Controller {
    public function index() {
        return view('frontend.portfolio');
    }
}