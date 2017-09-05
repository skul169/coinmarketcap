@extends('coinmarketcap')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
    <div id="top-nav-outer-container" role="navigation">
        <div class="row">
            <div id="top-nav-inner-container" class="container">
                <div class="hidden-xs col-sm-3">
                    <div id="global-stats-counts" class="small"></div>
                </div>
                <div class="col-xs-12 col-sm-7">
                    <div id="global-stats-values" class="small">
                        <ul class="list-inline stat-counters">
                            Market Cap: <strong><a href="/">${{number_format($global->total_market_cap_usd)}}</a></strong>
                            <li>
                                / 24h Vol: <strong><a href="/">${{number_format($global->total_24h_volume_usd)}}</a></strong>
                                / BTC Dominance: <strong><a href="/">{{$global->bitcoin_percentage_of_market_cap}}%</a></strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hidden-xs col-sm-2 text-right">
                    <div id="twitter-follow" class="pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">
                <h1 id="title"><a href="/">CryptoCurrency Market Capitalizations</a></h1>
                <hr/>
                <nav id="nav-main" class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li @if(\Request::route()->getName() == 'index') class="active" @endif>
                                <a href="/">Toplist</a>
                            </li>
                            <li @if(\Request::route()->getName() == 'topup') class="active" @endif>
                                <a href="/topuplist">TopUp</a>
                            </li>
                            <li @if(\Request::route()->getName() == 'topdown') class="active" @endif>
                                <a href="/topdownlist">TopDown</a>
                            </li>
                        </ul>
                        <form action="/currencies/search/" class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" id="quick-search-box" class="form-control js-quick-search"
                                       placeholder="Search Currencies" name="q">
                                <button class="btn btn-primary hidden-sm hidden-md hidden-lg" type="submit"><i
                                            class="glyphicon glyphicon-search"></i></button>
                            </div>
                            <button class="btn btn-primary hidden-xs" type="submit"><i
                                        class="glyphicon glyphicon-search"></i></button>
                        </form>
                        <div class="bottom-margin-1x hidden-sm hidden-md hidden-lg"></div>
                    </div>
                </nav>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-4">
                                <ul id="category-tabs" class="nav nav-tabs text-left" role="tablist">
                                    <li class="active">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> All <span
                                                    class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="/">Top 100</a></li>
                                            <li><a href="/">Full List</a></li>
                                        </ul>
                                    </li>
                                    <!--<li>-->
                                    <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#"> Currencies <span-->
                                    <!--class="caret"></span></a>-->
                                    <!--<ul class="dropdown-menu" role="menu">-->
                                    <!--<li><a href="/currencies/">Top 100</a></li>-->
                                    <!--<li><a href="/currencies/views/all/">Full List</a></li>-->
                                    <!--<li class="divider"></li>-->
                                    <!--<li><a href="/currencies/">Market Cap by Circulating Supply</a></li>-->
                                    <!--<li><a href="/currencies/views/market-cap-by-total-supply/">Market Cap by Total-->
                                    <!--Supply</a></li>-->
                                    <!--<li><a href="/currencies/views/filter-non-mineable/">Filter Non-Mineable</a>-->
                                    <!--</li>-->
                                    <!--<li><a href="/currencies/views/filter-premined/">Filter Premined</a></li>-->
                                    <!--<li><a href="/currencies/views/filter-non-mineable-and-premined/">Filter-->
                                    <!--Non-Mineable and Premined</a></li>-->
                                    <!--</ul>-->
                                    <!--</li>-->
                                    <!--<li>-->
                                    <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#"> Assets <span-->
                                    <!--class="caret"></span> </a>-->
                                    <!--<ul class="dropdown-menu" role="menu">-->
                                    <!--<li><a href="/assets/">Top 100</a></li>-->
                                    <!--<li><a href="/assets/views/all/">Full List</a></li>-->
                                    <!--<li class="divider"></li>-->
                                    <!--<li><a href="/assets/">Market Cap by Circulating Supply</a></li>-->
                                    <!--<li><a href="/assets/views/market-cap-by-total-supply/">Market Cap by Total-->
                                    <!--Supply</a></li>-->
                                    <!--</ul>-->
                                    <!--</li>-->
                                </ul>
                            </div>

                            <div class="col-xs-4 col-md-4 text-left">
                                <div id="currency-switch" class="btn-group"></div>
                            </div>
                            <div class="col-xs-8 col-md-4 text-right">
                                <div class="clear"></div>
                                <!--<div class="pull-right">-->
                                <!--<ul class="pagination top-paginator">-->
                                <!--<li><a href="2">Next 100 &rarr;</a></li>-->
                                <!--<li><a href="/all/views/all/">View All</a></li>-->
                                <!--</ul>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <table class="table" id="currencies">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th id="th-name" class="">Name</th>

                                <th id="th-marketcap" class=" text-right">Market Cap</th>
                                <th id="th-price" class=" text-right">Price</th>
                                <th id="th-totalsupply" class=" text-right"
                                    title="The number of coins in existence available to the public">Circulating Supply
                                </th>
                                <th id="th-volume" class=" text-right">Volume (24h)</th>
                                <th id="th-change" class=" text-right">% Change (24h)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($list_all as $key => $coin)
                                <tr id="id-{{ $coin->symbol }}" class="">
                                    <td class="text-center">{{ ($key + 1) }}</td>
                                    <td class="no-wrap currency-name">
                                        <img src="https://files.coinmarketcap.com/static/img/coins/16x16/{{ $coin->id }}.png" class="currency-logo" alt="{{ $coin->name }}">
                                        <a href="/currencies/{{ $coin->id }}/">{{ $coin->name}}</a>
                                    </td>
                                    <td class="no-wrap market-cap text-right">
                                        ${{number_format($coin->market_cap_usd,0, '.', ',')}}
                                    </td>
                                    <td class="no-wrap text-right">
                                        <a href="/currencies/{{ $coin->id }}/" class="price">${{number_format($coin->price_usd,5, '.', ',')}}</a>
                                    </td>
                                    <td class="no-wrap text-right">
                                        <a target="_blank">
                                            {{number_format($coin->total_supply,0, '.', ',')}} {{ $coin->symbol }}
                                        </a>
                                    </td>
                                    <td class="no-wrap text-right">
                                        <a href="/currencies/{{ $coin->id }}" class="volume">
                                            <?php $index_name = '24h_volume_usd'; ?>
                                            $ {{number_format($coin->$index_name,0, '.', ',')}}
                                        </a>
                                    </td>
                                    <td class="no-wrap percent-24h @if($coin->percent_change_24h > 0) positive_change @else negative_change @endif text-right">{{number_format($coin->percent_change_24h,2, '.', ',')}} %</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <!--<ul class="pagination bottom-paginator">-->
                            <!--<li><a href="2">Next 100 &rarr;</a></li>-->
                            <!--<li><a href="/all/views/all/">View All</a></li>-->
                            <!--</ul>-->
                        </div>
                    </div>
                </div>
                <div class="row text-center" id="total_market_cap">
                    <strong>Total Market Cap:
                        <span id="total-marketcap">${{number_format($global->total_market_cap_usd)}}</span>
                    </strong>
                </div>
                <hr/>
                <div id="footer" class="row">
                    <div class="col-xs-12 col-md-6">&copy; 2017 TotalCoinMarket
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
