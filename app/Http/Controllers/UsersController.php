<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class UsersController extends Controller
{
    //创建一个构造函数，调用来进行用户过滤。调用middleware方法（第一个参数：指定要用的中间件过滤方法；第二个参数：指定要进行过滤的动作）进行过滤处理
    public function __construct() {
      $this->middleware('auth', [
          'only' => ['show','edit', 'update','destroy']
      ]);

      //只让未注册用户访问注册页面
       $this -> middleware('guest', [
           'only' => ['create']
       ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //将数据库中所有数据调用，并绑定到返回的视图上
        $users = User::Paginate(15);
        return view('users.index', compact('users'));
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
        //根据传过来的id值到数据中查找，查找到返回给$user,并绑定到视图上
        $user = User::findOrFail($id);
        //为用户进行授权限制,如果数据库中查找出来的数据与当前登录数据不匹配则返回一个错误提示
        $this -> authorize('update', $user);
        return view('users.edit', compact('user'));
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
        //调用validate方法来做数据验证
        $this -> validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);

        //从数据库调出用户对象数据，并使用update方法来做数据更新
        $user = User::findOrFail($id);
        //为用户进行授权限制,如果数据库中查找出来的数据与当前登录数据不匹配则返回一个错误提示
        $this -> authorize('update', $user);
        $date = [];
        $date['name'] = $request->name;
        //为了增加用户体验，这里判断如果密码栏为空即代表用户不想改密码，不作处理，填写密码才做修改
        if ($request->password) {
            $date['password'] = bcrypt($request->password);
        }
        $user->update($date);

        //更新成功返回提示
        session() -> flash('success','资料修改成功');
        //修改完成后重定向到个人信息页面
        return redirect() -> route('users.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除用户动作
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user);
        $user->delete();
        session()-> flash('success', '删除成功！');
        return back();
    }

}
