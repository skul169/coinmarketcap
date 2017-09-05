<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Cache;
use Validator, Input, Redirect ;
use DB;
use App\Events\EvtPushOD;
use App\StockPrice;

class IndexController extends \Illuminate\Routing\Controller {

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

        //global data
        $global = file_get_contents('https://api.coinmarketcap.com/v1/global/');
        $global = json_decode($global);


		 $allsymbol = StockPrice::query()
                        ->orderBy('sortOrder', 'ASC')
                        ->get();

        $list_all = file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=100');
        $list_all = json_decode($list_all);

        if (\Request::route()->getName() == 'topdown') {
            //top down
            usort($list_all, function($a, $b) {
                return $a->percent_change_24h > $b->percent_change_24h;
            });
        } elseif (\Request::route()->getName() == 'topup') {
            //top up
            usort($list_all, function($a, $b) {
                return $b->percent_change_24h > $a->percent_change_24h;
            });
        }

        $global->total_market_cap_usd = 0;
        $global->total_24h_volume_usd = 0;
        $index_name = '24h_volume_usd';
        foreach ($list_all as $coin) {
            $global->total_market_cap_usd += $coin->market_cap_usd;
            $global->total_24h_volume_usd += $coin->$index_name;
        }

		// Render into template
		return view('index')->with('allsymbol', $allsymbol)
            ->with('list_all', $list_all)
            ->with('global', $global);
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

	public function currencies($coinname) {
        //global data
        $global = file_get_contents('https://api.coinmarketcap.com/v1/global/');
        $global = json_decode($global);

        //coin detail
        $coin_detail = file_get_contents('https://api.coinmarketcap.com/v1/ticker/'. $coinname .'/');
        $coin_detail = json_decode($coin_detail);
        $coin_detail = $coin_detail[0];
        if ($coin_detail->rank > 100) {
            return redirect()->action('IndexController@index');
        }

	    $result_all = file_get_contents('https://files.coinmarketcap.com/generated/search/quick_search.json');
        $result_all = json_decode($result_all);

        $cache_result = Cache::get('coin_list_all');
        if (!$cache_result) {
            $cache_result = array();
            foreach ($result_all as $key => $value) {
                $cache_result[$value->slug] = $value;
            }
            Cache::forever('coin_list_all', $cache_result);
        }

        $result = file_get_contents('https://graphs.coinmarketcap.com/currencies/'. $coinname .'/');
        $result = json_decode($result);

        $list_all = file_get_contents('https://api.coinmarketcap.com/v1/ticker/?limit=100');
        $list_all = json_decode($list_all);
        $global->total_market_cap_usd = 0;
        $global->total_24h_volume_usd = 0;
        $index_name = '24h_volume_usd';
        foreach ($list_all as $coin) {
            $global->total_market_cap_usd += $coin->market_cap_usd;
            $global->total_24h_volume_usd += $coin->$index_name;
        }

        // Render into template
        return view('currencies')->with('coinname', $coinname)
            ->with('data_json' , json_encode($result->price_usd))
            ->with('coin_info', $cache_result[$coinname])
            ->with('coin_detail', $coin_detail)
            ->with('global', $global);
    }
}
