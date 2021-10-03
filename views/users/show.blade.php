@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <div class="post_body_main_img">
  <a href ="{{route('users.edit_image',$user)}}">
    @if($user->image !== '')
    <img src="{{\Storage::url($user->image) }}">
    @else
    <img src="{{ asset('images/no_image.png') }}">
    @endif
    </a>

  <p>{{ Auth::user()->name }}</p>
  <p>{{ Auth::user()->profile }}</p>
  <p>出品数：{{count($user->items)}}</p>
  
  <h2>購入履歴</h2>
  <ul>
  @forelse($orders as $order)
  <li>{{$order->item->name}}:{{$order->item->price}}円 出品者 {{$order->user->name}}さん</li>
  @empty
  <li>購入履歴はありません</li>
  @endforelse
  </ul>
  [<a href="{{ route('users.edit') }}">プロフィール編集</a>]
</div>
  
@endsection