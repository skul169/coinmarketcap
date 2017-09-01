@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Thêm mới cấu hình</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    {!! Form::open(array('route' => 'config.store', 'method' => 'POST')) !!}
    <div class="box-body">
        <div class="form-group">
            {!! Form::label('key', 'Key:', ['class' => 'control-label']) !!}
            {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'Enter key']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('value', 'Value:', ['class' => 'control-label']) !!}
            {!! Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'Enter value']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description:', ['class' => 'control-label']) !!}
            {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description']) !!}
        </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        {!! Form::submit('Thêm mới',['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection