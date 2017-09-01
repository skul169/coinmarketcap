<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = 'messages';
    public $timestamps = true;

    protected $fillable = ['message','type','user_id','username','transaction_id','created_at'];
    public function transaction() {
        return $this->hasMany('App\Transaction', 'transaction_id', 'id');
    }
    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}


