<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model {

	protected $table = 'tickers';
	public $timestamps = true;
        
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['content', 'created_at'];

}