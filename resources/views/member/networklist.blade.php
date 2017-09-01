@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<style>
    .profile-user-img {
        margin: 0 auto;
        padding: 1px;
        width: 40px;
        border: 1px solid #d2d6de;
    }

</style>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Users List</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

            <div class="row" style="overflow-x: scroll;">
                <div id="treeDiv" style="overflow: hidden; height: 10px;margin: auto;">
                    @foreach($tree as $user)
                    <div style="border-style: inset;" class="text-center">
                        <span>
                            <a href="{{ url('member/networklist') }}?deep=all&tree_parent_id={{$user->id}}">
                                @if ($user->username != '')
                                    @if ($user->level == 0)
                                        {!! HTML::image('img/Member.png', '', array('width' => 40 )) !!}
                                    @else
                                        {!! HTML::image('img/Up'.$user->level.'.png', '', array('width' => 40 )) !!}
                                    @endif
                                @endif
                                <br />
                                <b>{{ $user->username }}</b>
                                @if ($user->sponsor())
                                <br/>
                                <span style="font-size: 10px">({{ $user->sponsor()->username }})</span>
                                @endif
                            </a>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Users List</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

            <div class="row" style="margin-top: 30px;">
                {!! Form::open(array('url' => 'member/networklist', 'method' => 'GET')) !!}
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Filter username</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" placeholder="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Filter name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label></label>
                        <input type="hidden" class="form-control" name="deep" id="deep" value="{{ Request::query('deep') }}" placeholder="">
                        <input class="btn btn-primary" type="submit" value="Filter">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" data-tabs="tabs">
            <li class="{{Request::input('deep') == 'f1'?'active':''}}"><a href="{{ url('member/networklist') }}?deep=f1">F1</a></li>
            <li class="{{Request::input('deep') == 'f2'?'active':''}}"><a href="{{ url('member/networklist') }}?deep=f2">F2</a></li>
            <li class="{{Request::input('deep') == 'all'?'active':''}}"><a href="{{ url('member/networklist') }}?deep=all">All</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Username</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Sponsor</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Deposit</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Deposit of team</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Status</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Date created</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr role="row" class="odd">
                            <td class="">
                                <a href="{{ route('member.networklist', ['parentid' => $user->id]) }}" class="btn-xs btn btn-info">{{$user->username }}</a>
                            </td>
                            <td class="">{{ $user->sponsor()->username}}</td>
                            <td class="">{{ number_format($user->totaldeposit(),8, '.', ',') }}</td>
                            <td class="">{{ number_format($user->totaldepositteam(),8, '.', ',') }}</td>
                            <td class="">
                                @if ($user->level == 0)
                                Non Active
                                @elseif ($user->level == 1)
                                Up 1
                                @elseif ($user->level == 2)
                                Up 2
                                @elseif ($user->level == 3)
                                Up 3
                                @elseif ($user->level == 4)
                                Up 4
                                @elseif ($user->level == 5)
                                Up 5
                                @elseif ($user->level == 6)
                                Up 6
                                @endif
                            </td>
                            <td class="">{{date('d/m/Y', strtotime($user->created_at)) }}</td>
                            <td class="">
                                <a href="{{ route('member.show', $user->id) }}" class="btn-xs btn btn-info">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Number of records: {{$users->total()}}</div>
                </div>
                <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        {!! $users->setPath('')->appends(['deep' => old('deep'),'name' => old('name'),'username' => old('username')])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- /.box-body -->
@endsection

@section('inpage-script')
<script>
    var myTree;
    $(function () {
        myTree = $("#treeDiv").btree({
            branchColor: '#000000',
            branchStroke: 2,
            hSpace: 10,
            vSpace: 10,
            borderWidth: 0,
            horizontal: false,
            flip: true
        })[0];
    });
</script>
@endsection