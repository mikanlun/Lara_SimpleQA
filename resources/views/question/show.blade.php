@extends('layouts.app')

@section('content')
<div class="container">
    {{-- 質問内容 --}}
    <div class="card-header text-center bg-warning">
        <h4>{{ __('messages.label.question')}}</h4>
    </div>
    <div class="card my-2">
        <h5 class="card-header">
            @if (is_null($question->user->image))
                <img src="/asset/default_icon.png" width="30" height="30" class="d-inline-block align-center" alt="{{ __('messages.label.profile_image') }}">
            @else
                <img src="/storage/images/{{ $question->user->email }}-{{ $question->user->image }}" width="30" height="30" class="d-inline-block align-center" alt="{{ $question->user->image }}">
            @endif
            {{ $question->user->name }}
        </h5>
        <div class="card-body">
            <strong class="card-title">NO : {{ $question->id }}</strong>
            <h5 class="card-title">{{ $question->title }}</h5>
            <p class="card-text">{!! nl2br(e($question->body)) !!}</p>
        </div>
        <div class="card-footer text-muted row">
        <div class="col-md-4">{{ $question->updated_at }}</div>
        <div class="col-md-2"><img src="/asset/answer2.png" width="30" height="30"/>{{ $question->answers_count }}</div>
            @if($question->bested_flg == 1)
                <div class="col-md-5"><img src="/asset/star_01.png" width="30" height="30"/>{{ __('messages.btn_label.bestanswerSubmit') }}</div>
            @endif
        </div>
    </div>
    <div class="text-right my-2">
        <a href="{{ $backLink }}" class="btn btn-dark">{{ __('messages.btn_label.back') }}</a>
    </div>

    {{-- 回答一覧 --}}
    <div class="card-header text-center bg-info">
        <h4>{{ __('messages.label.answer')}}</h4>
    </div>
    <div class="text-right my-2">
        @if(Auth::check() && (Auth::user()->id != $question->user_id) && ($question->bested_flg != 1))
            <a href="/answer/create?question_id={{ $question->id }}" class="btn btn-info">{{ __('messages.btn_label.answerRegister') }}</a>
        @endif
    </div>
    @if ($question->answers_count != 0)
        @foreach ($answers as $answer)
        <div class="card my-2">
            <h5 class="card-header">
                @if (is_null($answer->user->image))
                    <img src="/asset/default_icon.png" width="30" height="30" class="d-inline-block align-center" alt="{{ __('messages.label.profile_image') }}">
                @else
                    <img src="/storage/images/{{ $answer->user->email }}-{{ $answer->user->image }}" width="30" height="30" class="d-inline-block align-center" alt="{{ $answer->user->image }}">
                @endif
                {{ $answer->user->name }}
                @if ($answer->best_flg == 1)
                    <button type="button" class="btn btn-success">{{ __('messages.btn_label.bestanswer') }}</button>
                @endif
            </h5>
            <div class="card-body">
                <strong class="card-title">NO : {{ $answer->id }}</strong>
                <p class="card-text">{!! nl2br(e($answer->body)) !!}</p>
            </div>
            <div class="card-footer text-muted row">
                <div class="col-md-4">{{ $answer->updated_at }}</div>
                {{-- ベストアンサーボタン --}}
                @if(Auth::check() && (Auth::user()->id != $answer->user_id) && (Auth::user()->id == $question->user_id) && ($question->bested_flg != 1))
                    <a href="/answer/bestanswer/{{ $answer->id }}" class="btn btn-success" id="bestanswer">{{ __('messages.btn_label.bestanswerSelect') }}</a>
                @endif
                {{-- 削除ボタン --}}
                @if(Auth::check() && (Auth::user()->id == $answer->user_id))
                    <a href="#" class="btn btn-danger delete_answer" data-id="{{ $answer->id }}">{{ __('messages.btn_label.delete') }}</a>
                @endif
            </div>
        </div>

        {{-- 回答削除 --}}
        <form action="/answer/{{ $answer->id }}" method="post" id="delete_answer_submit_{{ $answer->id }}">
            {{ method_field('delete') }}
            {{ csrf_field() }}
        </form>
        @endforeach

        {{ $answers->links() }}

        <div class="text-right my-2">
            <a href="{{ $backLink }}" class="btn btn-dark">{{ __('messages.btn_label.back') }}</a>
        </div>

    @else
        <div class="card my-2">
            <h5 class="card-header">
                {{ __('messages.unAnswered.caption') }}
                {{ __('messages.unAnswered.comment') }}
            </h5>
            @if(Auth::check() && (Auth::user()->id != $question->user_id))
                <div class="card-footer">
                <a href="/answer/create?question_id={{ $question->id }}" class="btn btn-primary">{{ __('messages.btn_label.answerRegister') }}</a>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
