<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\PortfolioSkill;

class PortfolioSkillController extends Controller {
    /**
     * Show skills
     */
    public function getSkills() {
        $data = [];

        $skills = PortfolioSkill::all();

        for ($i = 0; $i < count($skills); $i++) {
            $skill = &$skills[$i];
            $skill->DT_RowId = 'row_' . $skill->id;
            $skill->no = $i + 1;
        }
        $data['data'] = $skills;

        return response()->json($data);
    }
}
