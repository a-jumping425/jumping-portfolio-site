<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Portfolio;
use App\Models\Backend\PortfolioCategory;

class PortfolioController extends Controller {
    /**
     * Show categories
     */
    public function showCategories() {
        $data = [];

        $categories = PortfolioCategory::orderBy('ordering', 'asc')
                        ->get();
        for ($i = 0; $i < count($categories); $i++) {
            $category = &$categories[$i];
            $category->DT_RowId = 'row_' . $category->id;
            $category->no = $i + 1;
            $category->DT_RowData = ['id' => $category->id, 'ordering' => $category->ordering];
        }
        $data['data'] = $categories;

        return response()->json($data);
    }
}
