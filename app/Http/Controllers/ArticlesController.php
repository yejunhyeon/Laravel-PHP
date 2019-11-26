<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticlesRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $articles = \App\Article::latest()->paginate(3);

      return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('articles.create');
        // resources/view/articles/create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



      public function store(\App\Http\Requests\ArticlesRequest $request)
    {
       
       $article = \App\User::find(1)->articles()->create($request->all());

        if(! $article){
            return back()->with('flash_message','글이 저장되지 않았습니다.')->withInput();
        };
      event(new \App\Events\ArticlesEvent($article));
      return redirect(route('articles.index'))->with('flash_message','작성하신 글이 저장되었습니다.');
        $rules=[    // 유효성 체크 필드 설정 룰 저장 
            'title'=>['required'],
            'content'=>['required','min:10'], // '필드' => '검사조건'
        ];
 /*
        $validator = \Validator::make($request->all(), $rules);
        
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $article = \App\User::find(1)->articles()->create($request->all());

        

        return redirect(route('articles.index'))->with('flash_message','작성하신 글이 저장되었습니다.');
        // 1

        // 2
        $rules=[    // 유효성 체크 필드 설정 룰 저장 
            'title'=>['required'],
            'content'=>['required','min:10'], // '필드' => '검사조건'
        ];
*/
        $messages = [
            'title.required' => '제목은 필수 입력 항목',
            'content.required' => '본문은 필수 입력 항목',
            'content.min' => '본문은 최소 :min 글자 이상이 필요합니다.'
        ];  //  :   placeholder  위치지정자 

         $validator = \Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }  
        // 3
        $this->validate($request, $rules, $messages); 
        // 3
        $article = \App\User::find(1)->articles()->create($request->all());

       /* if(! $article){
            return back()->with('flash_message','글이 저장되지 않았습니다.')->withInput();
        }

        return redirect(route('articles.index'))->with('flash_message','작성하신 글이 저장되었습니다.');
        */
    } 
/*
    public function store(ArticlesRequest $request){
        $article = \App\User::find(1)->articles()->create($request->all());

        if(! $article){
            return back()->with('flash_message','글이 저장되지 않았습니다.')->withInput();
        }
        //return redirect(route('articles.index'))->with('flash_message','작성하신 글이 저장되었습니다.');
        var_dump('이벤트 발생');
        event('article.created',[$article]);
        var_dump('이벤트 발생완료');
    }

*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $id는 URL에서 넘겨지는 리소스ID
        //return view('articles show', compact('article'));
        return __METHOD__ . '은 다음 기본키를 가진 article 모델을 조회합니다'. $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return __METHOD__ . "{$id} 번째 리소스 수정을 위한 폼뷰 기능" . $id;
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
        return __METHOD__ . " {$id}번째 Article모델을 수정하는 기능" .$id;
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
        return __METHOD__ . " {$id}번째 리소스 삭제 기능" .$id;
    }
}
