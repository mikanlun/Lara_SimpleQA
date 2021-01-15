@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header text-center bg-warning">
        <h3>{{ __('messages.label.questionList')}}</h3>
    </div>
    @if(Auth::check())
        <div class="text-right my-2">
            <a href="/question/create" class="btn btn-warning">{{ __('messages.btn_label.questionRegister') }}</a>
        </div>
    @endif
    @if (count($questions))
        @foreach ($questions as $question)
            <div class="card my-2">
                <h5 class="card-header">
                    @if (is_null($question->user->image))
                        <img src="/asset/default_icon.png" width="30" height="30" class="d-inline-block align-center" alt="{{ __('messages.label.profile_image') }}">
                    @else
                        <img src="/storage/images/{{ $question->user->email }}-{{ $question->user->image }}" width="30" height="30" class="d-inline-block align-center" alt="{{ $question->user->image }}">
                    @endif
                    {{ $question->user->name }}
                    @if($question->bested_flg == 1)
                        <img src="/asset/star_01.png" width="30" height="30"/>
                    @endif
                </h5>
                <div class="card-body">
                    <strong class="card-title">NO : {{ $question->id }}</strong>
                    <h5 class="card-title">{{ $question->title }}</h5>
                    <p class="card-text">{!! nl2br(e($question->body)) !!}</p>
                </div>
                <div class="card-footer text-muted row">
                    <div class="col-md-4">{{ $question->updated_at }}</div>
                    <div class="col-md-2"><img src="/asset/answer2.png" width="30" height="30"/>{{ $question->answers_count }}</div>
                    <div class="col-md-3 offset-md-3">
                        <a href="/question/{{ $question->id }}" class="btn btn-primary">{{ __('messages.btn_label.detail') }}</a>
                        @if(Auth::check() && (Auth::user()->id == $question->user_id))
                            <a href="#" class="btn btn-danger delete_question" data-id="{{ $question->id }}">{{ __('messages.btn_label.delete') }}</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 質問削除 --}}
            <form action="/question/{{ $question->id }}" method="post" id="delete_question_submit_{{ $question->id }}">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            </form>
        @endforeach

        {{ $questions->links() }}

    @else
        <div class="card my-2">
            <h5 class="card-header">
                {{ __('messages.unQuestioned.caption') }}
                {{ __('messages.unQuestioned.comment') }}
            </h5>
            @if(Auth::check())
                <div class="card-body">
                    {{ __('messages.wwllcome.caption') }}
                    {{ Auth::user()->name }} {{ __('messages.wwllcome.comment') }}
                    <a href="/question/create" class="btn btn-warning">{{ __('messages.btn_label.questionRegister') }}</a>
                </div>
            @endif
        </div>
    @endif

</div>
@endsection
