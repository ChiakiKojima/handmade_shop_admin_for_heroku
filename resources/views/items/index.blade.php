@extends('layout')
@section('title', 'items')



@section('content')
     @include('flash::message')
    <h1>Items
        @auth
        <a href="items/create" class="btn btn-primary float-right">新規作成</a>
        @endauth
    </h1>
    <hr/>

    <div class="row">
        @foreach($items as $item)
            <div class="col-lg-4">
                <div class="card" style="width: 20rem;">
                    <img class="card-img-top" src="{{ $item->image }}" alt="イメージ画像">
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ url('items', $item->id) }}">{{ $item->name }}</a></h4>
                        <p class="card-text">{{ $item->comma_price }}円</p>
                        @auth
                            <a href="{{ action('ItemsController@edit', [$item->id]) }}" class="btn btn-primary">変更</a>
                            {!! delete_form(['items', $item->id]) !!}
                        @endauth
                    </div>
                </div>
            </div>

        @endforeach
    </div>


@endsection
