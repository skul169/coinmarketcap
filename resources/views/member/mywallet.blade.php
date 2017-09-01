@extends('app')

@section('htmlheader_title')
My Wallet
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">My Wallet</h3>
    </div><!-- /.box-header -->
    <div class="box-body">

        <div class="col-md-12">
            @include("member.wallet")
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('member/mywallet/preaddbtc') }}" class="btn btn-block btn-primary btn-lg">Deposit</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('member/mywallet/preexchange') }}" class="btn btn-block btn-primary btn-lg">Exchange</a>
                </div>
            </div>
        </div><!-- /.row -->

        <div class="col-md-12">
            <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 30%;">Quantity</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 20%;">Status</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 20%;">Type</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1"  style="width: 20%;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tranactions as $tranaction)
                        <tr role="row" class="odd">
                            <td class="">
                                {{$tranaction->value }} BTC
                            </td>
                            <td class="">
                                @if($tranaction->status == 0)
                                Pending
                                @elseif($tranaction->status == 1)
                                Accepted
                                @elseif($tranaction->status == 2)
                                Rejected
                                @endif
                            </td>
                            <td class="">{{$tranaction->paytype->name }}</td>
                            <td class="">{{date('d/m/Y', strtotime($tranaction->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$tranactions->total()}}</div>
            </div>
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    {!! $tranactions->setPath('')->render() !!}
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Image preview</h4>
            </div>
            <div class="modal-body">
                <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('inpage-script')


<script type="text/javascript">
    $(".img-button").on("click", function () {
        $('#imagepreview').attr('src', $(this).data('src')); // here asign the image to the modal when the user click the enlarge link
        $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
    });
</script>


@endsection