<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

	protected $table = 'log';
	public $timestamps = false;
        const CODE_LOGIN = 'LOGIN';
        const CODE_ASSIGN_DEVICE = 'ASSIGN_DEVICE';
        const CODE_UPDATE_DEVICE = 'UPDATE_DEVICE';
        const CODE_REMOVE_DEVICE = 'REMOVE_DEVICE';
        const CODE_CREATE_USER = 'CREATE_USER';
        const CODE_UPDATE_USER = 'UPDATE_USER';
        const CODE_REMOVE_USER = 'REMOVE_USER';
        const CODE_CREATE_ADS = 'CREATE_ADS';
        const CODE_EDIT_ADS = 'EDIT_ADS';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'code', 'browser', 'ip', 'description', 'create_date'];

}