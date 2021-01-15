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
            <p class="card-text">{{ $question->body}}</p>
        </div>
        <div class="card-footer text-muted row">
        <div class="col-md-4">{{ $question->updated_at }}</div>
        <div class="col-md-2"><img src="/asset/answer2.png" width="30" height="30"/>{{ $question->answers_count }}</div>
            @if($question->bested_flg == 1)
                <div class="col-md-5"><img src="/asset/star_01.png" width="30" height="30"/>{{ __('messages.btn_label.bestanswerSubmit') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <div class="card my-4">
            <div class="card-header text-center bg-primary">{{ __('messages.label.registerAnswer') }}</div>

            <div class="card-body">
                <form method="POST" action="/answer">
                    @csrf

                    <div class="form-group row">
                        <label for="body" class="col-md-2 col-form-label text-md-right">{{ __('messages.label.body') }}</label>

                        <div class="col-md-10 my-2">
                            <textarea id="body" type="body" class="form-control @error('body') is-invalid @enderror" name="body"  required autocomplete="body" autofocus>{{ old('body') }}</textarea>

                            @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12 offset-md-5">
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.btn_label.register') }}
                            </button>
                            <a href="#" class="btn btn-dark" onclick="history.back();">{{ __('messages.btn_label.back') }}</a>
                        </div>
                    </div>

                    {{-- question id --}}
                    <input type="hidden" name="question_id" value="{{ $question_id }}" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
