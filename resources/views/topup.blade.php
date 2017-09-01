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
                <?php $i = 0 ?>
                @foreach($allsymbol as $symbol)
                    <?php $i++ ?>
                      <tr id="id-{{ $symbol->symbol }}" class="odd" role="row">
                        <td class="text-center sorting_1">{{ $i }}</td>
                        <td class="no-wrap currency-name">
                            <img src="{{URL::to($symbol->stockinfo->imageUrl)}}" class="currency-logo" alt="{{ $symbol->stockinfo->coinname    }}" width="25px"> {{ $symbol->symbol }} - {{ $symbol->stockinfo->coinname}}
                        </td>
                        
                        <td class="no-wrap price text-right"> 
                            $ {{number_format($symbol->price,2, '.', ',')}}
                        </td>
                        <td class="no-wrap text-right market-cap">
                          $ {{number_format($symbol->mktcap,0, '.', ',')}}
                        </td>
                        <td class="no-wrap supply text-right">
                             {{ $symbol->symbol }} {{number_format($symbol->supply,0, '.', ',')}} 
                        </td>
                        <td class="no-wrap text-right volume"> 
                            $ {{number_format($symbol->volume,0, '.', ',')}} 
                        </td>         
                          @if($symbol->capPercent > 0)
                                <td class="no-wrap percent-24h  positive_change  text-right upPrice">
                                 {{number_format($symbol->capPercent,2, '.', ',')}} % <span class="glyphicon glyphicon-chevron-up"></span>
                                </td> 
                          @elseif($symbol->capPercent < 0)
                                 <td class="no-wrap percent-24h  positive_change  text-right downPrice">
                                 {{number_format($symbol->capPercent,2, '.', ',')}} % <span class="glyphicon glyphicon-chevron-down"></span>
                                </td>
                          @else
                                 <td class="no-wrap percent-24h  positive_change  text-right nochang">
                                  {{number_format($symbol->capPercent,2, '.', ',')}} % 
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
