<?php
/**
 * Created by PhpStorm.
 * User: chunjiren
 * Date: 2017/6/25
 * Time: 11:27
 */
?>
<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title','Sample App') -- laravel入门教程</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
      @include('layouts._header')

  <div class="container">
    <div class="cod-md-offset-1 cod-md-10">
      @include('shared.messages')
      @yield('content')
      @include('layouts._footer')
    </div>
  </div>

  </body>
</html>