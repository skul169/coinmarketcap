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
                                <span class="my_token_current"> <strong></strong>BÁO CÁO DOANH SỐ CHÁY </span>
                            </div>
                        </div>
                        <!--- Table data -->
                        <!-- /.box-header -->

                        <div class="row table-responsive">
                            <div class="col-sm-12 col-xs-12">
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
                                            <th class="col-md-2 col-sm-2 col-xs-3">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="col-md-1 col-sm-2 col-xs-2">{{$order->id }}</td>
                                            <td class="col-md-2col-sm-2 col-xs-2">{{$order->user->username }}</td>
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
                                                Start
                                                @elseif($order->status == 1)
                                                Trader
                                                @elseif($order->status == 2)
                                                Finish
                                                @elseif($order->status == 3)
                                                Rejected
                                                @endif
                                            </td>
                                            <td class="col-md-2 col-sm-2 col-xs-3">{{date('d/m/Y', strtotime($order->created_at)) }}</td>
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="2"><b>Tổng doanh thu cháy:</b></td>
                                            <td class="col-md-2col-sm-2 col-xs-2"><span class="btn-xs btn btn-danger"><b>{{$TotalBTC}}</b> Bit</span> </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng số Trader cháy: {{$orders->total()}}</div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                    {!! $orders->setPath('')->render() !!}
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