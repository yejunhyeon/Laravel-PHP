<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // seeder가 실행되면 작동할 코드 작성
    {
        /*
        App\User::create(
            [
                // 'name'=>sprintf('%s %s',str_random(3), str_random(4)),
                // 'email'=>str_random(10).'@test,com',
                // 'password'=>bcypt('password'),
                 
                // sprintf(형식문자열, 인수리스트): 
                //          형식 문자열에 지정한 형태로 문자열을 생성해서 반환
                // str_random(인자): 
                //          인자값의 갯수 만큼 길이의 문자열 랜덤 생성
                //           (도우미함수 5.7 이상에서는 없음)
                //            =>  Str::random()
                
                 'name'=>sprintf('%s %s',Str::random(3), Str::random(4)),
                // ==>    Str::random(3) . ' ' . Str:random(4)  // sprintf 안쓸경우

                'email'=>Str::random(10).'@test,com',
                'password'=>bcrypt('password'),
                 
            ]
        );*/
        factory(App\User::class,5)->create(); 
    }
}
