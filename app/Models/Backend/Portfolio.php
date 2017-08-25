<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Portfolio extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolios';

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

    /**
     * Reorder
     */
    public function reOrder() {
        $orders = Input::get('orders', []);

        for($i = 0; $i < count($orders); $i++) {
            $order = $orders[$i];
            $portfolio = $this->find($order['id']);
            $portfolio->ordering = $order['pos'] + 1;
            $portfolio->save();
        }
    }
}