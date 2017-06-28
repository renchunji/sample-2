<?php
/**
 * Created by PhpStorm.
 * User: chunjiren
 * Date: 2017/6/28
 * Time: 10:09
 */
?>
<!--这句A标签的作用就是点击用户头像进入用户个人信息页面，第一个参数是跳转到用户显示页面，第二个参数是显示对应用户的信息-->
<a href="{{ route('users.show',[$user -> id]) }}">
    <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar">
</a>
<h1>{{ $user->name }}</h1>
