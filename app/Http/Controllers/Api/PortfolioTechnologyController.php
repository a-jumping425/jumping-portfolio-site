<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioTechnology;

class PortfolioTechnologyController extends Controller {
    /**
     * Show technologies
     */
    public function getTechnologies() {
        $data = [];

        $technologies = PortfolioTechnology::all();

        for ($i = 0; $i < count($technologies); $i++) {
            $technology = &$technologies[$i];
            $technology->DT_RowId = 'row_' . $technology->id;
            $technology->no = $i + 1;
        }
        $data['data'] = $technologies;

        return response()->json($data);
    }
}
