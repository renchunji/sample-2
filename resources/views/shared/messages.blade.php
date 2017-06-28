<?php
/**
 * Created by PhpStorm.
 * User: chunjiren
 * Date: 2017/6/28
 * Time: 14:56
 */
?>
<!--使用foreach来把四个对应的关键字键遍历到$msg中，然后用has()来判断，键对应的值是否存在，存在就打印出值，空就不显示。
这样就能实现如果有对应的提示键就打印对应的提示语-->
@foreach(['danger', 'warning', 'success', 'info'] as $msg)
    @if(session() ->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{ $msg }}">
                {{ session() -> get($msg) }}
            </p>
        </div>
    @endif
@endforeach
