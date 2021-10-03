@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
<h1>{{ $title }}</h1>
<h2>ご購入ありがとうございました。</h2>
<p>商品名：{{$item->name}}</p>
<div class="img">
        @if($item->image !== '')
         <img src="{{ asset('storage/' . $item->image) }}">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
</div>
<p>カテゴリ：{{$item->category->name}}</p>
<p>価格：{{$item->price}}</p>
<p>説明：{{$item->description}}</p>
<a href="{{ route('items.index', $item) }}" class="btn btn-primary">トップに戻る</a>
</div>
@endsection