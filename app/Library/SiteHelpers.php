<?php
use App\Http\Controllers\Controller as Controller;
use App\Tranaction as Tranaction;
use App\PayType as PayType; 
use App\User;
use \Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Events\EvtPushOD;

class SiteHelpers
{
  public static function devCoinList()
	  {
      $client = new Client ; 

             $url_api = 'https://api.coinmarketcap.com/v1/ticker/?convert=USD';
             $res2Bet = $client->request('GET', $url_api);
          
             $prices = json_decode($res2Bet->getBody());

              $i = 0;
              // $gets = \DB::table('stock_info')->get();

              foreach($prices as $key) {
                     
                    $up = \DB::statement("UPDATE stock_info SET status = 1, sortOrder =".$key->rank." WHERE symbol = '".$key->symbol."'");
                    print_r($i.'# '.$key->symbol.'<br>') ;
                    if ($i++ == 100) break;
               }
               die();
      
	  	// http://coincap.io/front

        // $sas = \App\StockPrice::find('TELL');
        // print_r($sas) ;
         
         // $sas = \App\StockPrice::find('BTC');
         // print_r($sas->price) ; die();

	    	  
          
           $gets = \DB::table('stock_info')->get();

           foreach($gets as $v) {
             $url_api = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$v->symbol.'&tsyms=USD';
             $res2Bet = $client->request('GET', $url_api);
          
             $prices = json_decode($res2Bet->getBody());

             $keye = 'RAW';

             $checkkey= array_key_exists($keye, $prices) ;

             if($checkkey){
                foreach($prices->RAW as $key) {
                     $tbData = array(
                        'cap24hrChange' => $key->USD->CHANGE24HOUR,
                         'supply' => $key->USD->SUPPLY,
                         'price' => $key->USD->PRICE,
                         'volume' => $key->USD->VOLUME24HOUR, 
                         'mktcap' => $key->USD->MKTCAP,
                         'cap24hrChangePercent' => $key->USD->CHANGE24HOUR,
                         'capPercent' => $key->USD->CHANGEPCT24HOUR
                      );

                    \App\StockPrice::find($key->USD->FROMSYMBOL)->update($tbData); 

                    print_r($tbData) ;

               }

             }

          }
            
           // https://www.cryptocompare.com/api/data/toplistvolumesnapshot/?limit=ALL&symbol=usd
           

	        // foreach ($prices as $key) {

	        // 	// print_r($key->vwapDataBTC ? $key->vwapDataBTC : 1.' - '.$key->short.'<br>') ;

	        // 	if($key->published)  { $published = 1 ;} else { $published = 0 ;  }

         //    // if(in_array($key->vwapDataBTC, $key))  { $vwapDataBTC = $key->vwapDataBTC ;} else { $vwapDataBTC = 0 ;  }
         //    // if(in_array($key->cap24hrChange, $key))  { $cap24hrChange = $key->cap24hrChange ;} else { $cap24hrChange = 0 ;  }

	        // 	 $tbData = array(
         //      'vwapDataBTC' => 0,
         //      'vwapData' => $key->vwapData,
         //      'cap24hrChange' => 0,
         //       'perc' => $key->perc, 
         //       'supply' => $key->supply,
         //       'price' => $key->price,
         //       'volume' => $key->volume, 
         //       'mktcap' => $key->mktcap,
         //       'cap24hrChangePercent' => 0,
         //      'capPercent' => 0,
         //       'published'=> $published,
         //    );
         //  $schva = \App\StockPrice::find($key->short);
         //  if($schva){
         //    \App\StockPrice::find($key->short)->update($tbData);

         //    print_r($i.'#'.$key->long.' - '.$key->short.'<br>') ;

         //    $i++ ;
         //  }
  				
  				
          

	        // }
	        
	         
	         // $pairs = \DB::select("SELECT pair, asset FROM stockchart") ;
          $status = 1;
	    return $status; 
	  }

  public static function InsetCoinList()
	  {
	  	// chi chay 1 lan 

	    	$client = new Client ; 
	        $res2Bet = $client->request('GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=USD');
	        
	        $prices = json_decode($res2Bet->getBody());

	  		//print_r($prices) ; die();

	        foreach ($prices as $key) {

	         $data = array(
					'symbol'	=> $key->symbol,
					'coinname'		=> $key->name,
					'imageUrl'	=> '/media/coins/'.$key->name.'.png'
				);
				
				\DB::table( 'sestockinfo')->insert($data);
	        	
	        }
	        
	         
	         // $pairs = \DB::select("SELECT pair, asset FROM stockchart") ;
	        $sa = 'LOL';
	    return  $sa; 
	  }
	    
	public static function ReadpriceCoin()
	  {
	  	// doc gia, cap nhat, pusth khi thay doi
	    	  $client = new Client ; 
           $gets = \DB::table('stock_info')->where('status', '=', 1)->get();

         foreach($gets as $v) {
             $url_api = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$v->symbol.'&tsyms=USD';
             $res2Bet = $client->request('GET', $url_api);
          
             $prices = json_decode($res2Bet->getBody());

             $keye = 'RAW';

             $checkkey= array_key_exists($keye, $prices) ;

             if($checkkey){
                foreach($prices->RAW as $key) {

                  $schva = \App\StockPrice::find($key->USD->FROMSYMBOL);
                  

                     $tbData = array(
                        'cap24hrChange' => $key->USD->CHANGE24HOUR,
                         'supply' => $key->USD->SUPPLY,
                         'price' => $key->USD->PRICE,
                         'volume' => $key->USD->VOLUME24HOUR, 
                         'mktcap' => $key->USD->MKTCAP,
                         'cap24hrChangePercent' => $key->USD->CHANGE24HOUR,
                         'capPercent' => $key->USD->CHANGEPCT24HOUR,
                         'published' => 1
                      );

                    $schva->update($tbData); 

                    // push
                   $gets = \DB::table('sestockprice')
                    ->where('symbol', '=', $key->USD->FROMSYMBOL)
                    ->first(); 

                    $push_price = array($gets);
                    $push_pr = event(new EvtPushOD($push_price)); 

                  


                    
               }

             }

          }

	        
	        $last_bet = 1;
	         // $pairs = \DB::select("SELECT pair, asset FROM stockchart") ;

	    return $last_bet; 
	  }  




  public static function getPricetick()
  {
    $client = new Client ;//\GuzzleHttp\Client();   
    //------- beting --- //
        //https://poloniex.com/public?command=returnTicker
       $urlapi = "https://poloniex.com/public?command=returnTicker";
       //$pairg = strtoupper($pair);

        $res2Bet = $client->request('GET', 'https://poloniex.com/public?command=returnTicker');
        
        $prices = json_decode($res2Bet->getBody());

        $last_bet = $prices ;
         // $pairs = \DB::select("SELECT pair, asset FROM stockchart") ;

    return $last_bet; 
  }
    
  public static function stockPricepair($pair)
  {
    $client = new Client ;//\GuzzleHttp\Client();   
    //------- beting --- //
    if($pair == 'BTCUSD'){

      //$res2Bet = $client->request('GET', 'https://api.hitbtc.com/api/1/public/BTCUSD/ticker');
        $res2Bet = $client->request('GET', 'http://www.satoshioption.com/chart/BTCUSD');
        
        $respo_Bet = json_decode($res2Bet->getBody());
        
        $last_bet = $respo_Bet[0];

    }else{

        //https://poloniex.com/public?command=returnTicker
       $urlapi = "https://poloniex.com/public?command=returnTicker";
      
       $pairg = strtoupper($pair);

        $res2Bet = $client->request('GET', 'https://poloniex.com/public?command=returnTicker');
        
        $prices = json_decode($res2Bet->getBody());

        if($pairg == "ALL"){
          $last_bet = $prices ;

         // $pairs = \DB::select("SELECT pair, asset FROM stockchart") ;


        }else{

         $prg = $prices->$pairg;
        // print_r($prg->last); die();
         $last_bet = $prg->last;
        }

        
    }
    
   
  
    return $last_bet; 
  }


	public static function pushPricetime()
	{
		//cập nhật tỷ giá bitstamp
        $client = new Client ;//\GuzzleHttp\Client();
        $res2 = $client->request('GET', 'https://www.bitstamp.net/api/v2/ticker/btcusd/');
        $response2 = json_decode($res2->getBody());
        $updateDate2 = Carbon::createFromTimestamp($response2->timestamp);
        $pr_bitamp = $response2->last ;

        // gia bitpay
        //$client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://bitpay.com/api/rates/VND');
        $response = json_decode($res->getBody());
        $pr_bitpay = $response->rate ;

        /** gia mua ban tren he thong
        $get_sell = \DB::select("SELECT max(price_from) as maxprice FROM user_ads where status =1 AND type = 0") ; 
        $get_buy = \DB::select("SELECT max(price_from) as maxprice FROM user_ads where status =1 AND type = 1") ;
		
		$maxsell = $get_sell[0]->maxprice;
		$maxbuy = $get_buy[0]->maxprice;
        **/
		// VOLUMESYS
		$volume_fix = Controller::getConfigByKey('VOLUMESYS');
		$volume_sum = \DB::select("SELECT sum(value) as sumvalue FROM tranaction") ;
		$volumesys = $volume_fix + $volume_sum[0]->sumvalue ;
		
    //------- beting --- //
    $res2Bet = $client->request('GET', 'http://www.satoshioption.com/chart/BTCUSD');
    
    $respo_Bet = json_decode($res2Bet->getBody());

    $last_bet = $respo_Bet[0];
		// Push socket
            $key = "pushPricetime";
            $push_price = array(
                'pr_bitamp' => $pr_bitamp,
               // 'maxsell'   => $maxsell,
               // 'maxbuy'=> $maxbuy,
                'volumesys'=>$volumesys,
                'pr_bitpay'=>$pr_bitpay,
                'last_bet'=>$last_bet
                
            );
           // $push_pr = event(new EvtPushOD($key, $push_price)); 
	
		return $push_price;	
	}

	public static function convertime($time) {
        $time_date =  date("d F Y H:i:s", $time);
        return  $time_date;
    }

	static public function fieldLang( $fields ) 
	{ 
		$l = array();
		foreach($fields as $fs)
		{			
			foreach($fs as $f)
				$l[$fs['field']] = $fs; 									
		}
		return $l;	
	}	
	
	public static function infoLang( $label , $l , $t = 'title' )
	{
		$activeLang = Session::get('lang');
		$lang = (isset($l[$t][$activeLang]) ? $l[$t][$activeLang] : $label );
		return $lang; 
		
	}	

	public static function auditTrail( $request , $note )
	{
		$data = array(
			'module'	=> $request->segment(1),
			'task'		=> $request->segment(2),
			'user_id'	=> \Session::get('uid'),
			'ipaddress'	=> $request->getClientIp(),
			'note'		=> $note
		);
		
		\DB::table( 'tb_logs')->insert($data);		

	}
	 	

  static function storeNote( $args )
  {
      $args =  array_merge( array(
        'url'       => '#' ,
        'userid'    => '0' ,
        'title'     => '' ,
        'note'      => '' ,
        'created'   => date("Y-m-d H:i:s") ,
        'icon'      => 'fa fa-envelope',
        'is_read'   => 0   
        ), $args ); 


        \DB::table('tb_notification')->insert($args);   
  }	 

  static function ResumeUserStatus()
  {
  		$sql = 
  		"SELECT 
			SUM(CASE WHEN active ='1' THEN '1' ELSE '0' END) AS s_active ,
			SUM(CASE WHEN active ='0' THEN '1' ELSE '0' END) AS s_inactive ,
			SUM(CASE WHEN active ='2' THEN '1' ELSE '0' END) AS s_banned 

			FROM tb_users ";
  		 return \DB::select($sql)[0]; 
  }	
  
  public static function getType($type)
    {
      $tbalance =$type;
     
       return $tbalance;

    } 
 public static function devset($note )
	{
		$data = array(
			'module'	=> 'dev',
			'task'		=> 'save',
			'user_id'	=> '1',
			'ipaddress'	=> '127.0.0.1',
			'note'		=> $note
		);
		
		\DB::table( 'tb_logs')->insert($data);		

	}			

		
}
