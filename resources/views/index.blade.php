@extends('appindex')

@section('htmlheader_title')
Home
@endsection


@section('main-content')



<div class="box box-primary">
    <div class="box-header with-border">
        <div id="currencies_wrapper" class="dataTables_wrapper no-footer">
        	<table class="table dataTable no-footer" id="currencies" role="grid">
            <thead>
                <tr role="row" style="background:#e7e7e7">
                	<th class="text-center sorting_asc" rowspan="1" colspan="1" aria-label="#" style="width: 23px;">#</th>
                	<th id="th-name" class="sortable sorting" tabindex="0"  rowspan="1" colspan="1">Name</th>
                	<th id="th-marketcap" class="sortable text-right sorting" tabindex="0" rowspan="1" colspan="1" >Price</th>
                	<th id="th-price" class="sortable text-right sorting" tabindex="0" rowspan="1" colspan="1" >Market Cap</th>
                	<th id="th-totalsupply" class="sortable text-right sorting" tabindex="0"  rowspan="1" colspan="1">Circulating  Supply</th>
                	<th id="th-volume" class="sortable text-right sorting" tabindex="0" rowspan="1" colspan="1">Volume (24h)</th>
                	<th id="th-change" class="sortable text-right sorting" tabindex="0" rowspan="1" colspan="1">% Change (24h)</th>
                	
                </tr>
            </thead>
            <tbody>
                @foreach($list_all as $key => $coin)
                    <tr id="id-{{ $coin->symbol }}" class="odd" role="row">
                        <td class="text-center sorting_1">{{ ($key + 1) }}</td>
                        <td class="no-wrap currency-name">
                            <a href="/currencies/{{$coin->id}}" style="text-decoration: underline; color: blue;">
                            <img src="https://files.coinmarketcap.com/static/img/coins/32x32/{{$coin->id}}.png" class="currency-logo" alt="{{ $coin->name }}" width="25px">
                            {{ $coin->symbol }} - {{ $coin->name}}
                            </a>
                        </td>

                        <td class="no-wrap price text-right">
                            $ {{number_format($coin->price_usd,5, '.', ',')}}
                        </td>
                        <td class="no-wrap text-right market-cap">
                            $ {{number_format($coin->market_cap_usd,0, '.', ',')}}
                        </td>
                        <td class="no-wrap supply text-right">
                            {{number_format($coin->total_supply,0, '.', ',')}} {{ $coin->symbol }}
                        </td>
                        <td class="no-wrap text-right volume">
                            <?php $index_name = '24h_volume_usd'; ?>
                            $ {{number_format($coin->$index_name,0, '.', ',')}}
                        </td>
                        @if($coin->percent_change_24h > 0)
                            <td class="no-wrap percent-24h  positive_change  text-right upPrice">
                            {{number_format($coin->percent_change_24h,2, '.', ',')}} % <span class="glyphicon glyphicon-chevron-up"></span>
                            </td>
                        @elseif($coin->percent_change_24h < 0)
                            <td class="no-wrap percent-24h  positive_change  text-right downPrice">
                            {{number_format($coin->percent_change_24h,2, '.', ',')}} % <span class="glyphicon glyphicon-chevron-down"></span>
                            </td>
                        @else
                            <td class="no-wrap percent-24h  positive_change  text-right nochang">
                            {{number_format($coin->percent_change_24h,2, '.', ',')}} %
                            </td>
                        @endif
                    </tr>
                @endforeach


            	
           </tbody>
           </table>
        </div>  <!-- END :currencies_wrapper --> 









    </div>
</div>
@endsection
