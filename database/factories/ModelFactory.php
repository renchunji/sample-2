<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    //对模型工厂进行修改，去掉密码加密操作，并生成假的日期对创建时间和更新时间赋值，有点看不懂代码，等后续来理解
    $date_time = $faker->date.''.$faker->time;
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'is_admin' => false,
        'password' => $password ?: $password = bcrypt('secrte'),
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time
    ];
});
