@extends('app')

@section('htmlheader_title')
    TRANSACTION
@endsection

@section('main-content')
    <div class="box">
        <div class="box-body">
            <!-------->
            <div id="content">

                <div class="box-body">
                    <div class="row" style="margin-bottom: 15px">
                        <div class="col-sm-12" align="center">
                            <span class="my_token_current"> <strong></strong>QUẢN LÝ TRADER </span>
                        </div>
                    </div>
                    <!--- Table data -->
                    <!-- /.box-header -->

                    <div class="row table-responsive">
					
					
						<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
							<li class="{{ (app('request')->input('type') == null || app('request')->input('type') == 'naptrader')?'active':'' }}"><a href="{{url('member/order?type=naptrader')}}">Giao dịch nạp</a></li>
							<li class="{{ (app('request')->input('type') == 'trader')?'active':'' }}"><a href="{{url('member/order?type=trader')}}">Quản lý lệnh</a></li>
						</ul>
                        <div class="col-sm-12 col-xs-12">
							<div class="tab-content">
								<div class="tab-pane {{ (app('request')->input('type') == null || app('request')->input('type') == 'naptrader')?'active':'' }}" id="naptrader">
								
									<div class="row table-responsive">
										<div class="col-sm-12 col-xs-12">

											<table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
												<thead>
													<tr role="row">
														<th class="sorting" tabindex="0" rowspan="1" colspan="1">User</th>
														<th class="sorting" tabindex="0" rowspan="1" colspan="1">Số lượng</th>
														<th class="sorting" tabindex="0" rowspan="1" colspan="1">Ngày tạo</th>
													</tr>
												</thead>
												<tbody>
													@foreach($userNapTraders as $aUser)
													<tr role="row" class="odd">
														<td class="">
															{{$aUser->username }}
														</td>
														<td class="">{{$aUser->package }}</td>
														<td class="">{{date('d/m/Y H:i:s', strtotime($aUser->package_date)) }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-5">
											<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$userNapTraders->total()}}</div>
										</div>
										<div class="col-sm-7">
											<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
												{!! $userNapTraders->setPath('')->appends(['type' => 'naptrader'])->render() !!}
											</div>
										</div>
									</div>
								
								</div>
								<div class="tab-pane {{ (app('request')->input('type') == 'trader')?'active':'' }}" id="trader">
								
									
									<table id="example1" class="table table-bordered table-striped dataTable table-responsive" role="grid" aria-describedby="example1_info">
										<thead>
										<tr>
											<th class="col-md-1 col-sm-2 col-xs-2">ID</th>
											<th class="col-md-2 col-sm-2 col-xs-2">Tài khoản</th>
											<th class="col-md-2 col-sm-2 col-xs-2">Quantity</th>
											<th class="col-md-1 col-sm-2 col-xs-2">Lever</th>
											<th class="col-md-2 hidden-sm hidden-xs">Currency usd sell</th>
											<th class="col-md-2 hidden-sm hidden-xs">Currency usd buy</th>
											<th class="col-md-2 hidden-sm hidden-xs">Status</th>
											<th class="col-md-2 hidden-sm hidden-xs">Loại</th>
											<th class="col-md-2 col-sm-2 col-xs-3">Date</th>
										</tr>
										</thead>
										<tbody>
										@foreach($orders as $order)
											<tr>
												<td class="col-md-1 col-sm-2 col-xs-2">{{$order->id }}</td>
												<td class="col-md-2col-sm-2 col-xs-2">
													@if($order->user)
														{{$order->user->username }}
													@endif
												</td>
												<td class="col-md-2 col-sm-2 col-xs-2">{{$order->quantity }}</td>
												<td class="col-md-1 col-sm-2 col-xs-2">{{$order->lever }}</td>
												<td class="col-md-2 hidden-sm hidden-xs">
													{{$order->currencyusd_close }}
												</td>
												<td class="col-md-2 hidden-sm hidden-xs">
													{{$order->currencyusd_open }}
												</td>
												<td class="col-md-3 col-sm-3 col-xs-4">
													@if($order->status == 0)
													Đã đặt lệnh
													@elseif($order->status == 1)
													Bị cháy
													@elseif($order->status == 2)
													Đã hoàn thành
													@endif
												</td>
												<td class="col-md-3 col-sm-3 col-xs-4">
													@if($order->type == 1)
													Thuận
													@elseif($order->type == 2)
													Nghịch
													@endif
												</td>
												<td class="col-md-2 col-sm-2 col-xs-3">{{date('d/m/Y', strtotime($order->created_at)) }}</td>
											</tr>
										@endforeach
										<tr>
											<td colspan="2"><b>Tổng số Bit Trader:</b></td>
											<td class="col-md-2col-sm-2 col-xs-2"><span class="btn-xs btn btn-danger"><b>{{$TotalBTC}}</b> Bit</span> </td>
										</tr>
										<tr>
											<td colspan="2"><b>Tổng số Bit đang Trader:</b></td>
											<th class="col-md-2col-sm-2 col-xs-2"><span class="btn-xs btn btn-info"><b>{{$StartBTC}}</b> Bit</span> </td>

										</tr>
										<tr>
											<td colspan="2"><b>Doanh thu cháy:</b></td>
											<td class="col-md-2col-sm-2 col-xs-2"><span class="btn-xs btn btn-warning"><b>{{$FinishBTC}}</b> Bit</span> </td>
										</tr>
										</tbody>
									</table>
								
								
								</div>
		
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số Trader cháy: {{$orders->total()}}</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                {!! $orders->setPath('')->appends(['type' => 'trader'])->render() !!}
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div> <!---- close content-->
        </div><!-- /.box-body -->
    </div><!---- box -->
@endsection


@section('inpage-script')
    <script>
        $(function () {
            $('#table_faq').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "bUseRendered": false
            });

        });

    </script>

@endsection