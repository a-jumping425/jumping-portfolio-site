<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioTag;

class PortfolioTagController extends Controller {
    /**
     * Show tags
     */
    public function getTags() {
        $data = [];

        $tags = PortfolioTag::all();

        for ($i = 0; $i < count($tags); $i++) {
            $tag = &$tags[$i];
            $tag->DT_RowId = 'row_' . $tag->id;
            $tag->no = $i + 1;
        }
        $data['data'] = $tags;

        return response()->json($data);
    }
}
