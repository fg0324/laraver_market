<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    @yield('header')
    
    @foreach($errors->all() as $error)
      <p class="error">{{ $error }}</p>
    @endforeach
    
    @if (\Session::has('success'))
        <div class="success">
            {{ \Session::get('success') }}
        </div>
    @endif

    @yield('content')
</body>
</html>