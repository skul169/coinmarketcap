<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/static/compressed/base.min.css?da54f2db" rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="apple-touch-icon" href="/static/img/CoinMarketCap.png">
</head>
<body>
    @yield('main-content')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="/static/compressed/base.min.js?03648796"></script>
    <script src="{{ asset('plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('temp_coinmk/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('temp_coinmk/StockBoard.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.8/socket.io.min.js"></script>
    @yield('inpage-script')
    <script type="text/javascript">
        function formatNumber(num) {
            //return number = num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            return number = num.toFixed(3).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }
    </script>
    {{--<script src="https://stock.local/static/compressed/currencies_main.min.js?7ec58358"></script>--}}
</body>
</html>