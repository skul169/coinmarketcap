@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Create New Member</h3>
        <div class="pull-right">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Thêm</a>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

            <div class="row">
                {!! Form::open(array('route' => ['user.index'], 'method' => 'GET')) !!}
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
    </div>
    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="{{ (app('request')->input('type') == null || app('request')->input('type') == 'user')?'active':'' }}"><a href="{{url('user?type=user')}}">Quản lý user</a></li>
            <li class="{{ (app('request')->input('type') == 'summary')?'active':'' }}"><a href="{{url('user?type=summary')}}">Thống kê user</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane {{ (app('request')->input('type') == null || app('request')->input('type') == 'user')?'active':'' }}" id="user">

                <div class="row">
                    <div class="col-sm-12">
                        <table id="table_investhistory" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Tên đăng nhập</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Tài khoản mail</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">SĐT</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr role="row" class="odd">
                                    <td class=""><a href="{{ route('member.show', $user->id) }}" class="btn-xs btn btn-info">{{$user->username }}</a></td>
                                    <td class="">{{$user->email }}</td>
                                    <td class="">{{$user->phone }}</td>
                                    <td>
                                        <a href="{{ route('user.show', $user->id) }}" class="btn-xs btn btn-info">Xem</a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn-xs btn btn-primary">Edit</a>
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
                            {!! $users->setPath('')->appends(['username' => old('username')])->appends(['type' => 'user'])->render() !!}
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
