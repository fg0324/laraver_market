@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  @if (count($like_items) ===0)
        <p>お気に入りの商品はありません。</p>
        
  @else
  <ul>
      @foreach ($like_items as $item)
      <a href ="{{route('items.show',$item)}}">
      <div class="img">
        @if($item->image !== '')
         <img src="{{ asset('storage/' . $item->image) }}">
        @else
         <img src="{{ asset('images/no_image.png') }}">
        @endif
      </div>
      </a>
        <li>商品名：{{$item->name}}</li>
        <li>{{$item->description}}</li>
        <li>カテゴリ：{{$item->category->name}} ({{$item->created_at}})</li>
        @if($item->isOrdered())
        <li class="badge badge-danger">売り切れ</li>
        @else
        <li class="badge badge-pill badge-primary">出品中</li>
        @endif
      @endforeach    
  </ul>
  @endif
</div>  
@endsection