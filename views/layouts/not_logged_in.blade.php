@extends('layouts.default')
@section('header')
<header>
    <ul>
        <li>
            <a href="{{ route('register') }}">
            サインアップ
          </a>
        </li>
        <li>
          <a href="{{ route('login') }}">
            ログイン
          </a>
        </li>
    </ul>
</header>
@endsection