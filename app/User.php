<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Log;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use EntrustUserTrait;

use Authenticatable,
    CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sponsor_id','name','username','phone','email',
        'password','remember_token','romancoin_wallet','amount_wallet','income_wallet','trader_wallet','address',
        'country','blockchain','peopleid','avatar','status',
        'created_at','updated_at',
        'level_buy','level_sell',
        'total_buy','total_sell','last_login', 'is_firsttime','level',
        'bitgo_receive_address', 'auth_code','active','api_key','api_secret','wait_disable','locale','package','package_date',
        'level_deposits','point_deposits','user_pointdeposits','income_deposits','deposits_wallet','trader_level'];

    const STATUS_ACTIVE   = '2';
    const STATUS_LOCKED   = '1';
    const STATUS_NOACTIVE = '0';
    
    
    const LEVEL_SELLER_BEGIN = '0';
    const LEVEL_SELLER_FAST   = '1';
    const LEVEL_SELLER_OFFEN   = '2';
    const LEVEL_SELLER_TRUST   = '3';
    
    const LEVEL_BUYER_BEGIN = '0';
    const LEVEL_BUYER_FAST   = '1';
    const LEVEL_BUYER_OFFEN   = '2';
    const LEVEL_BUYER_TRUST   = '3';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function sponsor() {
        return $this->belongsTo('App\User', 'sponsor_id');
    }
    
    public function bank() {
        return $this->belongsTo('App\Bank', 'bank_id')->first();
    }

    public function tranactions()
    {
        return $this->hasMany('App\Tranaction', 'user_id');
    }
    public function feedbacks()
    {
        return $this->hasMany('App\UserFeedback', 'user_id');
    }
    public function sumsales()
    {
        $package = $this->package > 0?$this->package:0;
        return $this->hasMany('App\Deposits', 'user_id')->sum('value')+$package;
    }
    public function sumsalestree(){
        $childrens = $this->allChildrenRecursive();
        $total = 0;
        foreach($childrens as $aChild){
            $total = $total+$aChild->sumsales();
        }
        return $total;
    }

    public function blacklists()
    {
        return $this->belongsToMany('App\User', 'user_blacklist', 'user_id', 'blacklist_id');
    }
    
    public function totalpoint(){
        
        $agv = 0;
        $count = UserFeedback::where('user_id',$this->id)->count();
        $total = UserFeedback::where('user_id',$this->id)->sum('point');

        if($count!=0)
        {
            $agv = $total/$count;
        }
        return $agv*10;
    }
    
    public function orders() {
        return $this->hasMany('App\Order', 'user_id');
    }

    public function orderhistorys() {
        return $this->hasMany('App\OrderHistory', 'user_id');
    }
    public function children() {
        return $this->hasMany('App\User', 'sponsor_id');
    }

    public function childrenRecursive() {
        return $this->children()->with('childrenRecursive');
    }

    // all ascendants
    public function sponsorRecursive() {
        return $this->sponsor()->with('sponsorRecursive');
    }

    public function allChildrenRecursive() {
        $retCollect = collect([]);
        foreach ($this->children()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->recursiveAddCollection($aChild));
        }
        return $retCollect;
    }

    public function allSponsorRecursive() {
        $retCollect = collect([]);
        foreach ($this->sponsor()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->sponsorAddCollection($aChild));
        }
        return $retCollect;
    }

    public function allMemberoftree() {
        $retCollect = collect([]);
        foreach ($this->sponsor()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->sponsorAddCollection($aChild));
        }

        foreach ($this->children()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->recursiveAddCollection($aChild));
        }
        return $retCollect;
    }

    private function sponsorAddCollection($aUser) {
        $retCollect = collect([]);
        $retCollect->push($aUser);
        foreach ($aUser->sponsor()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->sponsorAddCollection($aChild));
        }
        return $retCollect;
    }

    private function recursiveAddCollection($aUser) {
        $retCollect = collect([]);
        $retCollect->push($aUser);
        foreach ($aUser->children()->get() as $aChild) {
            $retCollect = $retCollect->merge($this->recursiveAddCollection($aChild));
        }
        return $retCollect;
    }

    public function haveTwoChildTraderroman(){
        $count = $this->children()->where('level', '>', 0)->count();
        return $count > 1;
    }
}