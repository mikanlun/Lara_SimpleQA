<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Question;
use App\Answer;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{
    /**
     * 新しいAnswerControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy', 'bestanswer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect("/");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $question_id = $request->question_id;
        $question = Question::withCount('answers')->find($question_id);

        return view('answer.create', compact('question_id', 'question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        // 回答を登録
        $form = $request->all();
        unset($form['_token']);
        $form['user_id'] = Auth::id();
        $question_id = $request->question_id;
        // Ansertインスタンス生成
        $answer = new Answer;
        $answer->fill($form)->save();

        return redirect("/question/" . $question_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect("/");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect("/");
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
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 回答を削除
        Answer::destroy($id);

        return back();
    }

    /**
     * BestAnswer the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function bestanswer($id)
    {
        // Answer インスタンス生成
        $answer = Answer::find($id);
        $question_id = $answer->question_id;
        $answer->best_flg = 1;
        $answer->save();

        $question = Question::find($question_id);
        $question->bested_flg = 1;
        $question->save();

        return back();
    }
}
