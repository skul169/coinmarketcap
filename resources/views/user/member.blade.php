@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box">
   <!--
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

            <div class="row">
                {!! Form::open(array('route' => ['user.member'], 'method' => 'GET')) !!}
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Filter name</label>
                        <input type="text" class="form-control" name="username" id="name" value="{{ old('username') }}" placeholder="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label></label>
                        <input class="btn btn-primary" type="submit" value="Filter">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div> -->
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
       <!-- <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="{{ (app('request')->input('type') == null || app('request')->input('type') == 'user')?'active':'' }}"><a href="{{url('user/member?type=user')}}">Quản lý user</a></li>
        </ul> -->
        <div class="tab-content">
            <div class="tab-pane  {{ (app('request')->input('type') == null || app('request')->input('type') == 'user')?'active':'' }}" id="user">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Email</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Phone</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Wallet</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Bet wallet</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr role="row" class="odd">
                                    <td class="">{{$user->username }}</td>
                                    <td class="">{{$user->email }}</td>
                                    <td class="">{{$user->phone }}</td>
                                    <td class="">{{$user->amount_wallet }}</td>
                                    <td class="">{{$user->trader_wallet }}</td>
                                    <td>
                                        <a href="{{ route('user.edit2', $user->id) }}" class="btn-xs btn btn-primary">Edit</a>
                                        <a href="{{ route('user.destroy', $user->id) }}" class="btn-xs btn btn-danger">Delete</a>
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
                        <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$users->total()}}</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $users->setPath('')->appends(['username' => old('username')])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane {{ (app('request')->input('type') == 'summary')?'active':'' }}" id="summary">
                <div class="box login-pass">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-header with-border">
                                <h3 class="box-title">SUMMARY</h3>
                            </div>

                            <div class="box-footer no-padding">
                                <ul class="nav nav-stacked">
                                    <li><a href="#">Tổng số user <span class="pull-right badge bg-blue">{{$total_user}}</span></a></li>
                                </ul>
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
