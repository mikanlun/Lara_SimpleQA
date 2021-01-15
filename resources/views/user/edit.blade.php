@extends('layouts.app')

@section('title', __('messages.label.editAccount'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.label.editAccount') }}</div>

                <div class="card-body">
                    <form method="POST" action="/user/{{ $user->id }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-7">
                                <small class="text-muted">( 30文字以内)</small><br>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback bg-warning" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-7">
                                <small class="text-muted">( 8文字以上)</small><br>
                                <small class="text-muted">(未入力の時は登録済のパスワードを流用)</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.confirmPassword') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.profile_image') }}</label>
                            <div class="col-md-8">
                               <input type="file" name="image"  class="form-control-file @error('image') is-invalid @enderror" id="image">
                               <small class="text-muted">(GIF, PNG, JPEG, JPG) 2MB以下</small><br />
                               <small class="text-muted">(未選択の時は現在の画像を流用)</small>
                               <br />
                               <small class="text-muted">現在の画像 : </small>
                               @if (is_null($user->image))
                                   <img src="/asset/default_icon.png" width="30" height="30" class="d-inline-block align-center" alt="{{ __('messages.label.profile_image') }}">
                               @else
                                   <img src="/storage/images/{{ $user->email }}-{{ $user->image }}" width="30" height="30" class="d-inline-block align-center" alt="{{ $user->image }}"> ( {{ $user->image }} )
                               @endif

                               @error('image')
                                   <span class="invalid-feedback bg-warning" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.btn_label.update') }}
                                </button>
                                <a class="btn btn-warning btn-mg mr-3" href="/user/{{ $user->id }}" role="button">{{ __('messages.btn_label.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
