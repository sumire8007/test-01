<!-- ユーザー登録画面 -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('nav')
    <div class="header__button">
        <a href="/login">login</a>
    </div>
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Register</h2>
    </div>
    <div class="contact-form__input">
    <form class="form" action="/register" method="post">
        @csrf
        <!-- お名前フォーム -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="name" placeholder="例:山田　太郎" value="{{ old('name') }}"/>
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- メールアドレスのフォーム -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- パスワードのフォーム -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="password" name="password" placeholder="例:coachtech1106" value="{{ old('password') }}"/>
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <!-- 登録ボタンをクリックするとログイン画面に遷移 -->
        <div class="form__button">
            <button class="form__button-submit" type="submit">登録</button>
        </div>
    </form>
    </div>
</div>

@endsection
