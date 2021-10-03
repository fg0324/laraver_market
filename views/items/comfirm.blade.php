@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
<h1>{{ $title }}</h1>
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
<a href="{{ route('items.finish', $item) }}" class="btn btn-primary">内容を確認し、購入する</a>
</div>
@endsection