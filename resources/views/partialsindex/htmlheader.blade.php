<head>
<title>Coin Market Capitalisation lists of Crypto Currencies and prices , Lives streaming Bitcoin &amp; Ethereum Market Cap and all other crypto currencies.</title>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Coin Market Capitalisation lists of Crypto Currencies and prices , Lives streaming Bitcoin &amp; Ethereum Market Cap and all other crypto currencies."/>
<meta name="keywords" content="Bitcoin, bitcoin exchange, bitcoins, free bitcoin, bitcoin card, bitcoin debit card"/>
<script>
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini/i.test(navigator.userAgent)) {
            //document.querySelector('meta[name="twitter:card"]').setAttribute("content", "app");
        }

      
    </script>

<link rel="stylesheet" media="screen" href="{{ asset('temp_coinmk/style.css') }}"> 

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('temp_coinmk/bootstrap/css/bootstrap.min.css') }}" >

<!-- <script src="{{ asset('temp_coinmk/Bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('temp_coinmk/s.js') }}" type="text/javascript"></script> -->


<!-- jQuery 2.1.4 -->
<script src="{{ asset('plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('temp_coinmk/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('temp_coinmk/StockBoard.js') }}"></script>
</head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.8/socket.io.min.js"></script>

    <script>
         var url = 'http://localhost:9099';
         var socket = io(url, {
             'secure': true,
             'reconnect': true,
             'reconnection delay': 500,
             'max reconnection attempts': 10
          });
        // var chosenEvent = 'pushPricestock';
        //     socket.on(chosenEvent, function (data) {
        //         console.log(data);
                                
        //     });     
        var chosenEvent = 'EvtPushOD';
            socket.on(chosenEvent, function (data) {
                UpdateImmediately(data.stockprice) ;

                $("#indexmrk").html(formatNumber(data.all24volume.summktcap));
                $("#indexvol24").html(formatNumber(data.all24volume.summ24volume));                
            });         
    </script>
    <script type="text/javascript">
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }
    </script>
