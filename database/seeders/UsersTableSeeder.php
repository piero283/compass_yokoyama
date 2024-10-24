<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // サンプルユーザー1
            [
                'over_name' => '国語',
                'under_name' => '太郎',
                'over_name_kana' => 'コクゴ',
                'under_name_kana' => 'タロウ',
                'mail_address' => 'taro@test.com',
                'sex' => 1, // 1→男性、2→女性、3→その他
                'birth_day' => '2000-01-01',
                'role' => 1, // 1→教師（国語）、2→教師（数学）、3→教師（英語）、4→生徒
                'password' => Hash::make('taro1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            // サンプルユーザー2
            [
                'over_name' => '生徒',
                'under_name' => '花子',
                'over_name_kana' => 'セイト',
                'under_name_kana' => 'ハナコ',
                'mail_address' => 'hanako@test.com',
                'sex' => 2, // 1→男性、2→女性、3→その他
                'birth_day' => '2020-02-10',
                'role' => 4, // 1→教師（国語）、2→教師（数学）、3→教師（英語）、4→生徒
                'password' => Hash::make('hanako1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
