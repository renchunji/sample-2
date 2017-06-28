<?php
/**
 * Created by PhpStorm.
 * User: chunjiren
 * Date: 2017/6/28
 * Time: 13:59
 */
?>
<!--判断闪存变量$errors中是否有值，有值就通过foreach来将所有值（$errors->all()）遍历并打印出来-->
@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

