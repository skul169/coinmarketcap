@extends('app')

@section('htmlheader_title')
Quảng cáo
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Betting</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row table-responsive">
                        <div class="col-sm-12 col-xs-12">
                            <table class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">pair</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">openprice</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">expprice</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">amount</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">return</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">target</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">until</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">type</th>
                                        <th class="sorting" tabindex="0" rowspan="1" colspan="1">status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($betting as $betting)
                                    <tr role="row" class="odd">
                                        <td class="">{{ \SiteHelpers::getuser($betting->Uid) }}</td>
                                        <td class="">{{$betting->pair }}</td>
                                        <td class="">{{$betting->openprice }}</td>
                                        <td class="">{{$betting->expprice }}</td>
                                        <td class="">{{$betting->amount }} BTC</td>
                                        <td class="">{{$betting->bet_return_value }} BTC</td>
                                        <td class="">{{ \SiteHelpers::convertime($betting->bet_target) }}</td>
                                        <td class="">{{ \SiteHelpers::convertime($betting->bet_until) }}</td>
                                        <td class="">{{$betting->bet_side }}</td>
                                        <td class="">
                                            @if($betting->bet_status == 0)
                                                Close
                                            @elseif($betting->bet_status == 1)
                                                Open
                                            @endif
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                           
                        </div>
                        <div class="col-sm-7">
                            
                        </div>
                    </div>

            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
                </div>
                <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>
@endsection
@section('inpage-script')
<script>
    $(function () {
        $('#table_userads').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

    });

</script>
@endsection
