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
    <!-- CSS file -->
    <link rel="stylesheet" href="/static/compressed/easyautocomplete/easy-autocomplete.min.css">
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
    <!-- JS file -->
    <script src="/static/compressed/easyautocomplete/jquery.easy-autocomplete.min.js"></script>
    @yield('inpage-script')
    <script type="text/javascript">
        function formatNumber(num) {
            //return number = num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            return number = num.toFixed(3).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }
    </script>
    {{--<script src="https://stock.local/static/compressed/currencies_main.min.js?7ec58358"></script>--}}
    <script>
        $(document).ready(function () {
            myVar = setInterval(callAjaxForMarketCap, 60000);
            myvar2 = setInterval(callAjaxForTotalVolume, 30000);
            function callAjaxForMarketCap() {
                $.ajax({
                    dataType: 'json',
                    url: "http://coincap.io/global",
                    type: 'get',
                    success: function(data)
                    {
                        $("#total_market_cap_header_id").html('$' + formatNumber(data.totalCap));

                        var percent = (data.btcCap / (data.btcCap + data.altCap)) * 100;
                        $("#btc_dominance_header").html(formatNumber(percent) + '%');

                    },
                    error: function()
                    {

                    },
                });
            }
            
            function callAjaxForTotalVolume() {
                $.ajax({
                    dataType: 'json',
                    url: "http://coincap.io/front",
                    type: 'get',
                    success: function(data)
                    {
                        var volume = 0;
                        jQuery.each( data, function( i, val ) {
                            volume = volume + val.usdVolume;
                        });

                        $("#total_24h_volume_usd_header").html('$' + formatNumber(volume));

                    },
                    error: function()
                    {

                    },
                });
            }

            var options = {
                url: "/static/countries.json",
                getValue: "name",
                list: {
                    match: {
                        enabled: true
                    },
                    maxNumberOfElements: 8
                },
                template: {
                    type: "custom",
                    method: function(value, item) {
                        return "<a href='/currencies/"+ item.id +"/'>"+ value +"</a>";
                    }
                },
                theme: "round"
            };

            $("#quick-search-box").easyAutocomplete(options);
        });
    </script>
</body>
</html>