<?php
/**
 * Created by PhpStorm.
 * User: chunjiren
 * Date: 2017/6/25
 * Time: 13:35
 */
?>
@extends('layouts.default')
@section('title','注册')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h5>用户注册</h5>
            </div>

            <div class="panel-body">
                @include('shared.errors')
                <form method="POST" action="{{route('users.store')}}">
                    <!--修复防止跨站攻击的异常-->
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="texte" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('pasword_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">提交注册</button>

                </form>
            </div>
        </div>
    </div>
@stop