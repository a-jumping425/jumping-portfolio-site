<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PortfolioTechnologyRelationships extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_technology_relationships';

    /**
     * @var bool
     */
    public $timestamps = false;
}