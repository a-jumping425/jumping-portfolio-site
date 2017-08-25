<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PortfolioMediaRelationships extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_media_relationships';

    /**
     * @var bool
     */
    public $timestamps = false;
}