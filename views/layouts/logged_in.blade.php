@extends('layouts.default')
 
@section('header')
<div class="container">
<header>
    <ul class="list-inline">
        <li class="list-inline-item">
          <a href="{{route('items.index')}}">
            Market
          </a>
        </li>
        
        <li class="list-inline-item">
          <a href="{{ route('users.show',auth()->user()->id)}}">
            プロフィール
          </a>
        </li>
        <li class="list-inline-item">
          <a href="{{ route('likes.index') }}">
            お気に入り一覧
          </a>
        </li>
        <li class="list-inline-item">
          <a href="{{ route('users.exhibitions',auth()->user()->id)}}">
              出品商品一覧
          </a>    
        </li>
        <li class="list-inline-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" class="btn btn-primary" value="ログアウト">
            </form>
        </li>
    </ul>
    <div>{{ Auth::user()->name }}さん、こんにちは！</div>
</header>
</div>
@endsection