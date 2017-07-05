<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //使用factroy辅助函数来生成假数据的用户对象，并使用insert方法来批量导入数据到数据库
        $users = factory(User::class)->times(50)->make();
        User::insert($users->toArray());

        //更新第一个用户的值，方便我们登录
        $user = User::find(1);
        $user->name = 'Aufree';
        $user->email = 'aufree@estgroupe.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->save();
    }
}
