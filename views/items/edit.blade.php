@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.update', $item) }}">
      @csrf
      @method('patch')
      <div>
          <lavel>
              商品名：<br>
              <input type="text" name="name" value="{{$item->name}}" placeholder="テスト１">
          </lavel>
        </div>  
        <div>
          <lavel>
              商品説明：<br>
              <textarea type="text" name="description" value="{{$item->description}}" placeholder="テスト出品１です。" rous="10" cols="80">{{$item->description}}</textarea>
          </lavel>
        </div>
        <div>
            <lavel>
              価格：<br>
              <input type="number" name="price" value="{{$item->price}}">
            </lavel>
        </div>
        <div>
            <lavel>
              カテゴリー：
            　<select name="category_id">
              @foreach($categories as $category)  
              <option value="{{$category->id}}"
              @if($category->id==$item->category_id) selected @endif>
              {{$category->name}}</option>
              @endforeach
              </select>
            </lavel>
        </div>
        <input type="submit" class="btn btn-primary" value="出品">
  </form>     
</div>   
@endsection