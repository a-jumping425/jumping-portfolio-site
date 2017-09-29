<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PortfolioTechnology extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_technologies';

    /**
     * @var bool
     */
    public $timestamps = false;

}