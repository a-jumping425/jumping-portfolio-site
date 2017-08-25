<?php
namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PortfolioTagRelationships extends Model {
    /**
     * @var string
     */
    protected $table = 'portfolio_tag_relationships';

    /**
     * @var bool
     */
    public $timestamps = false;
}