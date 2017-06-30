<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证用户注册时输入的数据，这里使用来validate做验证方法，第一个参数是输入的数据，第二个参数是验证规则
        //required验证不能为空，email验证邮箱格式，uniques验证是否唯一，confirmed验证是否匹配
        $this -> validate ($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed'
            ]);

        //使用User模型将接收到的数据进行数据库写入操作，实例后得到用户所有信息返回给$user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        //认证通过并注册成功后让用户自动登录
        Auth::login($user);
        //使用session()来定制提示消息，flash()的作用是将消息存入会话缓存，但只在下一次请求前有效
        session() -> flash('success','注册成功！欢迎你在这里开启一段新的旅程~');
        //通过路由将$user的数据绑定到视图文件上，以直接调用
        return redirect() -> route('users.show',[$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //用户模型查询数据并实例为一个对象，再将对象的数据用compact转出关联数组，并用视图返回到页面
        $user = User::findOrFail($id);
        return view('users.show',compact('user'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
