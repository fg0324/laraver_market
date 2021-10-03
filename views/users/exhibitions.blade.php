@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <a href="{{route('items.create')}}">新規出品</a>
  <ul>
      @forelse($items as $item)
      <a href ="{{route('items.show',$item)}}">
      <div class="img">
        @if($item->image !== '')
         <img src="{{ asset('storage/' . $item->image) }}">
        @else
          <img src="{{ asset('images/no_image.png') }}">
        @endif
      </a>  
      </div>
        <li>商品名：{{$item->name}}</li>
        <li>{{$item->description}}</li>
        <li>カテゴリ：{{$item->category->name}} ({{$item->created_at}})</li>
        <a href="{{ route('items.edit', $item) }}" class="btn btn-info">編集</a>
        <a href="{{ route('items.edit_image',$item) }}" class="btn btn-info">画像を変更</a>
        <form method="post" class="delete" action="{{ route('items.destroy', $item) }}">
        @csrf
        @method('delete')
        
        <input type="submit" class="btn btn-danger" value="削除">
        </form>
        @if($item->isOrdered())
        <p>売り切れ</p>
        @else
        <p>出品中</p>
        @endif
      @empty
        <li>商品はありません。</li>
    　@endforelse    
  </ul>
</div>
@endsection