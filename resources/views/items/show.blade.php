@extends('layout')
@section('title', $item->name )

@section('content')
    @include('flash::message')
    <h1>{{ $item->name }}</h1>

    <hr/>
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ Cloudder::secureShow($item->image) }}" alt="イメージ画像" width="50%">
        </div>
        <div class="col-lg-6">
            <div class = "description">
                {{ $item->description }}<br>
                {{ $item->comma_price }}円<br>
                @if ($item->available === 1)
                在庫： あり
                @else
                在庫： なし
                @endif
            </div>

            <div>
                @auth
                    <a href="{{ action('ItemsController@edit', [$item->id]) }}" class="btn btn-primary">編集</a>

                    {!! delete_form(['items', $item->id]) !!}
                @endauth

                <a href="{{ action('ItemsController@index') }}" class="btn btn-secondary float-right">一覧へ戻る</a>
            </div>
        </div>
    </div>


@endsection
