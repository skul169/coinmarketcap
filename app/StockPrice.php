<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class StockPrice extends Model {

    protected $table = 'sestockprice';
    public $timestamps = true;
    protected $primaryKey = 'symbol';
    
    protected $fillable = ['codeid', 'symbol', 'vwapDataBTC', 'vwapData', 'cap24hrChange', 'perc', 'supply', 'price', 'volume', 'mktcap', 'cap24hrChangePercent', 'capPercent', 'txdate','updated_at', 'published','sortOrder', 'status'];

   
    public function stockinfo() {
        return $this->hasOne('App\Stockinfo', 'symbol', 'symbol');
    }
}
