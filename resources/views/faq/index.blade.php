@extends('app')

@section('htmlheader_title')
FAQ
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">LIST FAQ</h3>
        <div class="pull-right">
            <a href="{{ route('faq.create') }}" class="btn btn-primary">Add FAQ</a>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12">
                    <table id="table_faq" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th class="col-sm-2 col-xs-2">#</th>
                                <th class="col-sm-4 col-xs-5">Question</th>
                                <th class="col-sm-3 hidden-xs">Created</th>
                                <th class="col-sm-3 col-xs-5"></th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($faq as $index=>$value)
                            <tr role="row" class="odd">
                                <td class="col-sm-2 col-xs-2">{{$index+1}}</td>
                                <td class="col-sm-4 col-xs-5">{{$value->question}}</td>
                                <td class="col-sm-3 hidden-xs">{{$value->created_at}}</td>
                                <td class="col-sm-3 col-xs-5" align="right">
                                    <a href="{{URL::to('faq/'.$value->id.'/edit')}}" class="btn btn-primary">Edit</a>
                                    <a href="{{URL::to('faq/destroy/'.$value->id)}}" class="btn btn-danger">Delete</a>
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
        $('#table_faq').DataTable({
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
