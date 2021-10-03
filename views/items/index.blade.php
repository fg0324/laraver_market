@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
　<div class="container">
  <h1>{{ $title }}</h1>
  <a href="{{route('items.create')}}">新規出品</a>
  <ul>
      @forelse($items as $item)
      <a href ="{{route('items.show',$item)}}">
      <div class="card-img-top" src="/images/pathToYourImage.png" alt="Card image cap">
        @if($item->image !== '')
         <img src="{{ asset('storage/' . $item->image) }}">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
      </div>
      </a>
        <li>商品名：{{$item->name}}</li>
        <li>商品説明：{{$item->description}}</li>
        <li>価格：{{$item->price}}円</li>
        <li>カテゴリ：{{$item->category->name}} ({{$item->created_at}})</li>
        <div class="post_body_footer">
    <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
    <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
      @csrf
      @method('patch')
      <button>お気に入り</button>
    </form>
    @if($item->isOrdered())
    <p class="badge badge-danger">売り切れ</p>
    @else
    <p class="badge badge-pill badge-primary">出品中</p>
    @endif
      @empty
        <li>商品はありません。</li>
    　@endforelse    
  </ul>
</div>
@endsection
