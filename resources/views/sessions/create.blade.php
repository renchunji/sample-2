<?php
/**
 * Created by PhpStorm.
 * User: chunjiren
 * Date: 2017/6/29
 * Time: 20:00
 */
?>
@extends('layouts.default')
@section('title','登录')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>用户登录</h5>
            </div>

            <div class="panel-body">
                @include('shared.errors')

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="panel-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="panel-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="panel-group">
                        <label><input type="checkbox" name="remeber">记住我</label>
                    </div>

                    <button type="submit" class="btn btn-primary"> 登录</button>
                </form>

                <hr>
                <P>还没账号？<a href="{{ route('signup') }}">现在注册</a></P>
            </div>
        </div>

    </div>
    @stop
