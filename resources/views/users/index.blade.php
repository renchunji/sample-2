<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/2 0002
 * Time: 20:29
 */
?>
@extends('layouts.default')
@section('title', '所有用户')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>用户列表</h1>
        <!--使用foreach将所有用户的头像和名称打印出来-->
        <ul class="users">
            <!--这个地方有个严重失误，遍历$users时不能赋值到同名的变量，这样会导致变量覆盖，从而导致后面的分页调用失败-->
            @foreach($users as $user)
                @include('users._user')
            @endforeach
        </ul>
        {!! $users->render() !!}
    </div>
@stop

