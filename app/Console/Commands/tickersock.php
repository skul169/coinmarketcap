<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Events\EvtPushOD;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class tickersock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickersock:cron';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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
                  if($schva->price != $key->USD->PRICE){

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

                    $getvolume = \DB::select("SELECT sum(mktcap) as summktcap, sum(volume) as summ24volume FROM sestockprice") ;

                    $push_price = array(
                        'stockprice'=> $gets,
                        'all24volume'=> $getvolume[0]
                        );
                    $push_pr = event(new EvtPushOD($push_price)); 

                  }else{
                    $schva->update(['published' => 0]); 
                  }


                    
               }

             }

          }
            
            $this->info('Cron Cummand Run') ;





        }



    }
       

       
        

        

    
