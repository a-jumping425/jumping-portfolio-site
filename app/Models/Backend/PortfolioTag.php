<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PortfolioTag extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_tags';

    /**
     * @var bool
     */
    public $timestamps = false;

}