@extends('layout')
@section('title', '商品登録')
 
@section('content')
    <h1>商品登録</h1>
 
    <hr/>
    
    @include('errors.form_errors')
 
    {!! Form::open(['url' => 'items', 'files' => true]) !!}
        @include('items.form')
    {!! Form::close() !!}
@endsection
