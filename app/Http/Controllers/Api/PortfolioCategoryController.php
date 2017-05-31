<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioCategory;

class PortfolioCategoryController extends Controller {
    /**
     * Show categories
     */
    public function getCategories() {
        $data = [];

        $categories = PortfolioCategory::orderBy('ordering', 'asc')
                        ->get();
        for ($i = 0; $i < count($categories); $i++) {
            $category = &$categories[$i];
            $category->DT_RowId = 'row_' . $category->id;
            $category->no = $i + 1;
            $category->DT_RowData = ['id' => $category->id];
        }
        $data['data'] = $categories;

        return response()->json($data);
    }
}
