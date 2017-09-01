@extends('app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')
<h1>{!! $transaction->transactionid !!}</h1>
<hr>

<a href="{{ route('transaction.index') }}" class="btn btn-info">Quay lại danh sách</a>
@endsection
