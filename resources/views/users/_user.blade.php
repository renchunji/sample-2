<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3 0003
 * Time: 21:54
 */
?>
<li>
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="gravatar" />
    <a href="{{ route('users.show', $user->id) }}" class="username">{{ $user->name }}</a>

    <!--使用can关键字做授权判断，只有当前用户满足destroy的条件时才显示这段内容-->
    @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
    @endcan
</li>
