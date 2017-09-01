@extends('app')

@section('htmlheader_title')

@endsection


@section('main-content')
<div class="row">
   <div class="box">
   
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

            <div class="row">
            	<div class="col-md-4">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Tổng Stock <span class="pull-right badge bg-blue">{{$total_sock}}</span></a></li>
                                </ul>
                 </div>
				<div class="col-md-8">
					<div style="width: 90%;float: left;" >
		                {!! Form::open(array('route' => ['member.dashboard'], 'method' => 'GET')) !!}
		                <div class="col-md-8">
		                    <div class="form-group">
		                        <label>Filter Symbol</label>
		                        <input type="text" class="form-control" name="symbol" id="symbol" value="{{ old('symbol') }}" placeholder="">
		                    </div>
		                </div>
		                <div class="col-md-4">
		                    <div class="form-group">
		                        <label></label>
		                        <input class="btn btn-primary" type="submit" value="Filter">
		                    </div>
		                </div>
		                {!! Form::close() !!}
		            </div>    	
	                <a href="{{URL::to('stockinfo/add')}}" class="btn-xs btn btn-danger">Add Stock</a>
	            </div>
            </div>
        </div>
    </div> 
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
       
        <div class="tab-content">
            <div class="tab-pane  {{ (app('request')->input('type') == null || app('request')->input('type') == 'user')?'active':'' }}" id="user">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Symbol</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Coin name</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Algorithm</th>
                                    
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Sort Order	</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Status</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Type</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stockinfo as $key)
                                <tr role="row" class="odd">
                                    <td class=""><img src="{{URL::to($key->imageUrl)}}" class="currency-logo" alt="{{ $key->coinname    }}" width="25px"> {{$key->symbol }}</td>
                                    <td class="">{{$key->coinname }}</td>
                                    <td class="">{{$key->algorithm }}</td>
                                    <td class="">{{$key->sortOrder }}</td>
                                    <td class="">
                                    		@if($key->status == 0)
                                                Deactive
                                            @elseif($key->status == 1)
                                                Active
                                            @endif
                                    </td>
                                    <td class="">{{$key->type }}</td>
                                    <td>
                                    	@if($key->status == 0)
                                         <a href="{{URL::to('stockinfo/'.$key->symbol.'/acstatus')}}" class="btn-xs btn btn-primary">Active</a>
                                        @elseif($key->status == 1)
                                          <a href="{{URL::to('stockinfo/'.$key->symbol.'/acstatus')}}" class="btn-xs btn btn-primary">Deactive</a>
                                        @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$stockinfo->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $stockinfo->setPath('')->appends(['symbol' => old('symbol')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            

		</div>
    </div>
</div>

</div>
@endsection

@section('inpage-script')
@endsection