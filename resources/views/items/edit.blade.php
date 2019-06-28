@extends('layout')
@section('title', '商品編集')
 
@section('content')
    <h1>商品編集</h1>
 
    <hr/>
    
    @include('errors.form_errors')
 
    {!! Form::model($item, ['method' => 'PATCH', 'url' => ['items', $item->id], 'files' => true]) !!}
        @include('items.form')
    {!! Form::close() !!}
@endsection