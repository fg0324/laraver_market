@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form class="mx-auto" style="width: 200px;" method="post" action="{{route('items.store')}}" enctype="multipart/form-data">
      @csrf
        <div class ="form-group mt-3">
          <lavel>
            商品名：<br>
              <input class="form-control" type="text" name="name" placeholder="テスト１">
          </lavel>
        </div>  
        <div>
          <lavel>
            商品説明：<br>
              <textarea type="text" name="description" placeholder="テスト出品１です。" rous="130" cols="80"></textarea>
          </lavel>
        </div>
        <div>
            <lavel>
            価格：<br>
              <input type="number" name="price">
            </lavel>
        </div>
        <div class="dropdown">
            <lavel>
              カテゴリー:
             <select name="category">
             @foreach($categories as $category)  
             <option value="{{$category->id}}">{{$category->name}}</option>
             @endforeach
             </select>
            </lavel>
        </div>
        <div>
          <label>
            画像を選択:
            <input type="file" name="image">
          </label>
         </div>
        <input type="submit" class="btn btn-primary" value="出品">
  </form>
</div>  
@endsection