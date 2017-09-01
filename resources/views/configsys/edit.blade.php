@extends('app')

@section('htmlheader_title')
    Home
@endsection


@section('main-content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Config</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        {!! Form::open(array('route' => ['configsys.update', $config->id], 'method' => 'PUT', 'files'=>true)) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('key', 'Key:', ['class' => 'control-label']) !!}
                {!! Form::text('key', $config->key, ['class' => 'form-control', 'placeholder' => 'Enter key', 'readonly' => 'readonly']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
                {!! $config->description !!}
            </div>
            <div class="form-group">
                @if ($config->type == 1)
                    {!! Form::label('value', 'Value:', ['class' => 'control-label']) !!}
                    {!! Form::text('value', $config->value, ['class' => 'form-control', 'placeholder' => 'Enter value']) !!}

                @elseif ($config->type == 2)
                    {!! Form::label('value', 'Value:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('value', $config->value, ['id' => 'content', 'class' => 'form-control', 'placeholder' => 'Enter value']) !!}

                @elseif ($config->type == 3)

                    <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0px;"><strong>Image
                            Value:</strong></label>
                    <div class="col-sm-8">
                        {!! Form::file('value') !!}
                    </div>
                    <br>
                    <br>
                    <br>
                    {{--<div class="col-sm-1">--}}
                    {{--<div class="fileUpload btn btn-primary">--}}
                    {{--<span>Upload</span>--}}
                    {{--<input id="uploadBtn3" type="file" class="upload" name="Upload"/>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    @if($config->value!="")

                        <label for="inputEmail3" class="col-sm-2 control-label" style="padding-left: 0px;"><strong>Images:</strong>
                        </label>
                        <div class="col-sm-8">
                            {!! HTML::image('uploads/images/avatar/'.$config->value, 'value', array('class' => 'thumb')) !!}
                        </div>

                    @endif

                @elseif ($config->type == 4)
                    {!! Form::label('value', 'Value:', ['class' => 'control-label']) !!}
                    {!! Form::text('value', $config->value, ['class' => 'form-control datepicker', 'placeholder' => 'Enter value']) !!}

                @else
                    {!! Form::label('value', 'Value:', ['class' => 'control-label']) !!}
                    {!! Form::text('value', $config->value, ['class' => 'form-control', 'placeholder' => 'Enter value']) !!}
                @endif
            </div>


        </div><!-- /.box-body -->

        <div class="box-footer">
            {!! Form::submit('Cập nhật',['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('inpage-script')
    <script src="{{ asset('plugins/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $(".datepicker").datepicker({
                format: 'dd/mm/yyyy',
            });
        });
        window.onload = function () {
            CKEDITOR.replace('content', {
                "filebrowserBrowseUrl": "{!! url('filemanager/show') !!}",
            });
        };
    </script>
@endsection