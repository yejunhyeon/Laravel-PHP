<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|--------------------------------------------------------------------------
*/

/* Route::get('/',     // 요청 경로(URL), GET /
    function () {     // 요청 처리 함수, 콜백, 클로저
    return view('welcome');     // view() : 뷰객체를 만들어 응답
//         // 인자: 뷰파일 지정
//         // resources/views/뷰파일명.blade.php
//         // resources/views/welcom.blade.php
});

Route::get('/yju',     // 요청 경로(URL), GET /
    function () {     // 요청 처리 함수, 콜백, 클로저
    return view('yju-com');     // view() : 뷰객체를 만들어 응답
        // 인자: 뷰파일 지정
        // resources/views/뷰파일명.blade.php
        // resources/views/welcom.blade.php
});

Route::get('/{tParam?}', // URL 파라미터 처리 
    function($tParam = '이게 디폴트 값이여'){
        return "<h1> {$tParam}을 URL로부터 받음 </h1>";
    }
);

Route::get('/{tParam?}/test', // URL 파라미터 처리 
    function($tParam = '이게 두번째 디폴트 값이여'){
        return "<h1> {$tParam}을 두번째 URL로부터 받음 </h1>";
    }
);
 */
// Route::pattern('rich','[0-9a-zA-Z!]{4}');

/* Route::get(
    '/{rich?}',
    function($rich='돈'){
        return "{$rich} 부자";
    }
)->where('rich','[0-9a-zA-Z!]{3}');
 */
/* Route::get('/',[
    "as"=>'alias',  // 라우트 이름부여
    function(){
        return '여긴 다른 라우팅인데 이름이 \'alias\'';
    }
]);

Route::get('/wdj',function(){
    return redirect(route('alias'));
}); */

/* Route::get('/',
    function(){
        return view('errors.503');      
        #return view('errors/503'); 둘다 됨
    }
);
Route::get('/databind',
    function(){         
        // view 함수는 view객체를 리턴
        // view단에서  $name 으로 뽑아 쓸 수 있음.  
        $fruits = ['레몬','수박','딸기','민준'];
        return view('yju-com',
        ['name'=>'hongildong','greeting'=>'어서와!','items'=>$fruits]);
        
        //return view('yju-com')->with('name','honggildong');
        //이렇게도 가능
    }
);

Route::get('/inherit', function (){
    return view('yju-wm');

}); */

// Route::get('/', function(){});  ==>
                    // 클로저 (Closure)    
//Route::get('/','컨트롤명@메소드')

Route::get('/', 'WelcomeController@index');

Route::get('auth/login', function () {
    $credentials = [
        'email' => 'john@example.com',
        'password' => 'password'
    ];

    if(! auth()->attempt($credentials)) {
        return '로그인 정보가 정확하지 않습니다.';
    }
    return redirect('protected');
});

Route::get('protected', function () {
    dump(seesion()->all());

    if(! auth()->check()) {
        return '누구세요?';
    }

    return '어서오세요' .auth()->user()->name;
});

Route::get('auth/logout', function () {
    auth()->logout();

    return '또 봐요~';
});

Route::resource('articles','ArticlesController');

/*Route::get('/{foo?}', function ($foo = 'bar') {
    return $foo;
})->where('foo', '[0-9a-zA-Z]{3}');
*/
/*
Route::get('/', [
    'as' => 'home',
    function () {
        return '제 이름은 "home" 입니다.';
    }
]);

Route::get('/home', function () {
    return redirect(route('home'));
});
*/

Route::get('/', function () {
    return view('welcome', [
        'name' => 'foo',
        'greeting' => '안녕하세요?',
    ]);
});

Route::get('auth/login',function(){
    $credentials = [    //로그인 기능 : 입력 구현 하는 걸 권장
        'email'=>'changyj@yju.ac.kr',
        'password'=>'password',
    ];

    if(!auth()->attempt($credentials)){
        // auth() -> attempt($credentials)
        // 인증시도 : 로그인 시도 ($credentials 값을 이용)
        // return : true - 로그인 성공
        //          false - 로그인 실패    

        return '로그인 실패함';
    }
    // 로그인 성공시
    return redirect('protected');

});

/* Route::get('protected',function(){
    dump(session()->all());  // session 객체의 all  
        // 모든 세션을 가져와서 화면에 나타내라.

    if(!auth()->check()) return 'だれ?ログインしてください。';
        // auth()->check()    로그인 상태인지 확인
        //  return true - 로그인 상태
        //  return false - 로그아웃 상태

        return 'いらっしゃいませ'.auth()->user()->name.'님';
        // auth()->user()->name : User모델의 객체, 로그인한 사용자 객체 
}); */

Route::get('protected',             // 주소
        ['middleware'=>'auth',      // 미들웨어
        function(){                 
            dump(session()->all());  // session 객체의 all  
            // 모든 세션을 가져와서 화면에 나타내라.
            return 'いらっしゃいませ'.auth()->user()->name.'님';
            // auth()->user()->name : User모델의 객체, 로그인한 사용자 객체 
}]);
Route::get('auth/logout',function(){
    auth()->logout();
    return 'また、後に';

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* DB::listen(function($query){
    var_dump($query->sql);
});  */    // db에 이벤트가 발생하면 이 클로저를 실행
        // query 는 이벤트를 발생시킨 쿼리객체를 가져옴

Route::get('json',function(){
    // 모델 연결하여 요청한 결과를 뷰로 보내지만
    // 뷰가 아니라 json으로 응답하기
    $datas=['name'=>'김영진', 'age'=>'24','grade'=>'4.0'];
    return response()->json($datas);
});

Event::listen('article.created',function($article){
    var_dump('이벤트 수령');
    var_dump($article->toArray());

});

DB::listen(function ($query) {
    var_dump($query->sql);
});