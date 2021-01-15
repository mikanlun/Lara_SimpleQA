<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\SessionManager;

use App\Question;
use App\Answer;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * 新しいQuestionControllerインスタンスの生成
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (session()->has('backPage')) {
            // 質問一覧へ戻る時の古いページ番号の削除
            session()->forget('backPage');
        }

        if (isset($request->page)) {
            // paginateの新ページ番号
            session(['backPage' => $request->page]);
        }

        $questions = Question::orderBy('updated_at', 'desc')->withCount('answers')->paginate(4);

        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        // 質問を登録
        $form = $request->all();
        unset($form['_token']);
        $form['user_id'] = Auth::id();
        // Quesitonインスタンス生成
        $question = new Question;
        $question->fill($form)->save();

        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::withCount('answers')->find($id);
        if (is_null($question)) {
            return redirect("/");
        }
        $answers = Answer::where('question_id', $id)->paginate(4);

        if (session()->has('backPage')) {
            // 質問一覧へ戻る時のリンク
            $backLink = '/?page=' . session('backPage'); // 質問一覧のページ番号あり
            session()->forget('backPage');
        } else {
            $backLink = '/'; // 質問一覧のページ番号なし
        }

        return view('question.show', compact('question', 'answers', 'backLink'));
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
        // 質問を削除
        Question::destroy($id);

        return back();
    }
}
