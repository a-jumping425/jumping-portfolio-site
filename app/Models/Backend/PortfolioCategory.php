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

}