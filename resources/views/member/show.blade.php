@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">User Information</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                <div class="col-sm-10">
                    {{ $user->username }}
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                    {{ $user->email }}
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>

                <div class="col-sm-10">
                    {{ $user->phone }}
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Blockchain</label>

                <div class="col-sm-10">
                    {{ $user->blockchain }}
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Level</label>

                <div class="col-sm-10">
                    
                    @if ($user->level == 0)
                    Member
                    @elseif ($user->level == 1)
                    S1
                    @elseif ($user->level == 2)
                    S2
                    @elseif ($user->level == 3)
                    S3
                    @elseif ($user->level == 4)
                    S4
                    @elseif ($user->level == 5)
                    S5
                    @elseif ($user->level == 6)
                    S6
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Total Childs</label>

                <div class="col-sm-10">
                    {{ $user->allMemberoftree()->count() }}
                </div>
            </div>
            <hr>
            <a href="{{ route('member.networklist') }}" class="btn btn-info">Back</a>
        </div>
    </form>
</div>

@endsection
