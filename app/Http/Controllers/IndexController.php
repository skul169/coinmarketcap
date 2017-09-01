<?php namespace App\Http\Controllers;

use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 
use DB;
use App\Events\EvtPushOD;
use App\StockPrice;
class IndexController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 *
	public function __construct()
	{
		$this->middleware('auth');
	}
   */
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{


		// $gets = \DB::table('stock_info')->get();
  //           foreach ($gets as $k) {
  //             $up = \DB::statement("UPDATE sestockprice SET sortOrder = ".$k->sortOrder." WHERE symbol = '".$k->symbol."'");
  //           }

		// $allsymbol = \DB::table('stock_info')
		// 			->orderBy('sortOrder', 'ASC')
		// 			->get();

		 $allsymbol = StockPrice::query()
                        ->orderBy('sortOrder', 'ASC')
                        ->get();

		// Render into template
		return view('index')->with('allsymbol', $allsymbol);
	}

	public function topup()
	{

		 $allsymbol = StockPrice::query()
		 				->where('capPercent', '>', 1)
                        ->orderBy('sortOrder', 'ASC')
                        ->get();

		// Render into template
		return view('topup')->with('allsymbol', $allsymbol);
	}
	public function topdown()
	{

		 $allsymbol = StockPrice::query()
		 				->where('capPercent', '<', 0)
                        ->orderBy('sortOrder', 'ASC')
                        ->get();

		// Render into template
		return view('topdown')->with('allsymbol', $allsymbol);
	}

	public function indexdev()
	{
		// $p_getpo = \SiteHelpers::devCoinList(); 
		
		$getvolume_up = \DB::select("SELECT sum(mktcap) as summktcap, sum(volume) as summ24volume FROM sestockprice") ;
		print_r($getvolume_up[0]) ;
		die();
		 $gets = \DB::table('stock_info')
						 ->where('status', '=', 1)
						 ->get();

         foreach($gets as $key) {

                      $data = array(
					'codeid'	=> $key->id,
					'sortOrder'		=> $key->sortOrder,
					'symbol'	=> $key->symbol
				);
				
				\DB::table( 'sestockprice')->insert($data);
				
                    // $up = \DB::statement("UPDATE sestockprice SET codeid =".$key->id.", sortOrder =".$key->sortOrder.", symbol = '".$key->symbol."'");
                   // print_r($i.'# '.$key->symbol.'<br>') ;
                    //if ($i++ == 100) break;
               }

		 die();
		$gets = \DB::table('sestockprice')
				->where('symbol', '=', 'BTC')
				->first();
				
    
        $push_price = array( $gets );
        $push_pr = event(new EvtPushOD($push_price)); 

        print_r($push_price) ;
        die();
	}
}
