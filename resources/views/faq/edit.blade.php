@extends('app')

@section('htmlheader_title')
   FAQ
@endsection


@section('main-content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Update FAQ: <strong>{{$model->question}}</strong></h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        @if (session('status'))
            <div class="alert alert-success">
                {{ session()->get('status') }}
            </div>
            @endif

                    <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{route('faq.update')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Question<span
                                    class="lable_red">*</span></label>
                        <div class="col-sm-10">
                            {!!Form::text('question',$model->question,['class'=>'form-control','placeholder'=>'Enter Question','maxlength'=>'350'])!!}

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Answer<span
                                    class="lable_red">*</span></label>
                        <div class="col-sm-10">
                            {!! Form::textarea('answer',$model->answer, array('class'=>'form-control', 'id' => 'answer',
                            'placeholder'=>'Enter Answer', 'value'=>Input::old('answer'))) !!}
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="form-group" align="center">
                            {!!Form::hidden('id',$model->id,['class'=>'form-control'])!!}
                            {!! Form::submit('Update FAQ',['class' => 'addBTCSubmitBtn']) !!}
                        </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </form>

    </div>

@endsection

@section('inpage-script')
    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function () {
            CKEDITOR.replace('answer');
        };
    </script>
@endsection