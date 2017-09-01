<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class Stockinfo extends Model {

    protected $table = 'stock_info';
    public $timestamps = true;
    protected $primaryKey = 'symbol';
    
    protected $fillable = ['symbol', 'coinname', 'algorithm', 'imageUrl', 'sortOrder', 'status','type','updated_at'];

   

}
