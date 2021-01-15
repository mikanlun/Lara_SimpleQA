@extends('layouts.app')

@section('title', __('messages.label.account'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messages.label.account') }}</div>

                <div class="card-body">
                    <form method="">
                        <fieldset disabled>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.email') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('messages.label.noDisplay') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('messages.label.profile_image') }}</label>
                                <div class="col-md-5">
                                    @if (is_null($user->image))
                                        <input id="image" type="text" class="form-control" name="image" value="{{ __('messages.label.noSelected') }}">
                                        <br />
                                        <small class="text-muted">未選択時の画像 : </small>
                                        <img src="/asset/default_icon.png" width="30" height="30" class="d-inline-block align-center" alt="{{ __('messages.label.profile_image') }}">
                                    @else
                                        <img src="/storage/images/{{ $user->email }}-{{ $user->image }}" width="30" height="30" class="d-inline-block align-center" alt="{{ $user->image }}"> ( {{ $user->image }} )
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4">
                                <a class="btn btn-primary btn-mg mr-3" href="/user/{{ $user->id }}/edit" role="button">{{ __('messages.btn_label.edit') }}</a>
                                <a class="btn btn-warning btn-mg mr-3" href="/" role="button">{{ __('messages.btn_label.back') }}</a>
                                <a class="btn btn-danger btn-mg" id="delete_account" data-user_name="{{ $user->name }}" role="button">{{ __('messages.btn_label.resign') }}</a>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- 退会 --}}
                <form action="/user/{{ $user->id }}" method="post" id="delete_resign">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
