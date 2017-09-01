@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<h1>{{ $notification->name }}</h1>
<hr>

<a href="{{ route('notification.index') }}" class="btn btn-info">Back</a>
@endsection
