<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PortfolioCategory extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Update order
     */
    public function updateOrder() {
        $rows = $this->orderBy('ordering', 'asc')->get();

        for($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            $row->ordering = $i + 1;
            $row->save();
        }
    }
}