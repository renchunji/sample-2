<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class SessionsController extends Controller
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
        //返回文件视图
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证用户输入的数据是否有误
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
            ]);

        //将用户的请求数据放入数组
        $credentails = [
          'email' => $request-> email,
          'password' => $request->password
        ];

        //调用Auth类中的aaempt方法来验证请求数据和数据库数据是否完全一致,并开启记住我参数(布尔值)
        if (Auth::attempt($credentails, $request->has('remeber'))) {
            session() -> flash('success','欢迎回来!');
            //登录成功重定向用户个人信息页面时，用Auth类调用user方法来获取用户所有数据并返回给视图
            return redirect() -> route('users.show',[Auth::user()]);
        }else{
            session() -> flash('danger','你的邮箱和密码不正确');
            return redirect() -> back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy()
    {
        //注意destory本来是有$id参数的，这里因为Auth::logout()退出登录的方法没有传入参数，所以先删除参数。
        Auth::logout();
        session() -> flash('success','退出成功');
        return redirect('login');

    }
}
