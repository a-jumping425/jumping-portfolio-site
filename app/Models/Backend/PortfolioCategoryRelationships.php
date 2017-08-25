<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PortfolioCategoryRelationships extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_category_relationships';

    /**
     * @var bool
     */
    public $timestamps = false;
}