@extends('app')

@section('htmlheader_title')
    CMS
@endsection


@section('main-content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">ADD Stock</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        @if (session('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
            @endif

                    <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('member.storestock')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Titles<span
                                    class="lable_red">*</span></label>
                        <div class="col-sm-10">
                            {!!Form::text('titles',Input::old('titles'),['class'=>'form-control','placeholder'=>'Enter titles','maxlength'=>'950'])!!}

                        </div>
                    </div>
					<div class="form-group">
                        <label for="slug" class="col-sm-2 control-label">Slug<span
                                    class="lable_red">*</span></label>
                        <div class="col-sm-10">
                            {!!Form::text('slug',Input::old('slug'),['class'=>'form-control','placeholder'=>'Enter slug','maxlength'=>'950'])!!}

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Content<span
                                    class="lable_red">*</span></label>
                        <div class="col-sm-10">
                            {!! Form::textarea('content',null, array('class'=>'form-control', 'id' => 'content',
                            'placeholder'=>'Enter content', 'value'=>Input::old('content'))) !!}
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group" align="center">
                            {!! Form::submit('Creat Content',['class' => 'addBTCSubmitBtn']) !!}
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <div class="col-md-6">
                lol
                </div>
                </div>
            </form>

    </div>

@endsection
@section('inpage-script')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function () {
            CKEDITOR.replace('content');
        };
    </script>
@endsection