@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center bg-warning">{{ __('messages.label.registerQuestion') }}</div>

                <div class="card-body">
                    <form method="POST" action="/question">
                        @csrf

                        <div class="form-group row my-2">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('messages.label.title') }}</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-4">
                            <label for="body" class="col-md-2 col-form-label text-md-right">{{ __('messages.label.body') }}</label>

                            <div class="col-md-10">
                                <textarea id="body" type="body" class="form-control @error('body') is-invalid @enderror" name="body"  required autocomplete="body">{{ old('body') }}</textarea>

                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.btn_label.register') }}
                                </button>
                                <a href="#" class="btn btn-dark" onclick="history.back();">{{ __('messages.btn_label.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
