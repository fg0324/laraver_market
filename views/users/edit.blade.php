@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="container">
  <h1>{{ $title }}</h1>
  <form method="post" action ="{{route('users.update')}}">
  @csrf
  @method('patch')
  <div>
      <label>
          名前：<br>
              <input type="text" name="name" value="{{$user->name}}" placeholder="test2">
      </label>
  </div>
  <div>
      <label>
        プロフィール：<br>
          <textarea type="text" name="profile" value="{{$user->profile}}" rous="10" cols="80">{{$user->profile}}</textarea>
      </label>
  </div>
  <input type="submit" class="btn btn-primary" value="更新">
  </form>
</div>
@endsection