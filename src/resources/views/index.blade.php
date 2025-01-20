<!-- <お問い合わせフォーム入力ページ -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <div class="form__box">
        <form class="form" action="/confirm" method="post">
            @csrf
            <!-- お名前フォーム -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="first_name" placeholder="例:山田" value="{{ old('first_name') }}"/>
                <input type="text" name="last_name" placeholder="例:太郎" value="{{ old('last_name') }}"/>
                </div>
                <div class="form__error">
                    @error('first_name')
                    {{ $message }}
                    @enderror
                    @error('last_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            </div>
            <!-- 性別フォーム -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <label><input class="accented" type="radio" name="gender" value="男性" checked>男性</label>
                    <label><input class="accented" type="radio" name="gender" value="女性">女性</label>
                    <label><input class="accented" type="radio" name="gender" value="その他">その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            </div>
            <!-- メールアドレスのフォーム -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
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
            <!-- 電話番号フォーム -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}" /> -
                <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}"/> -
                <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}"/>
                </div>
                <div class="form__error">
                    @error('tel')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            </div>
            <!-- 住所フォーム -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            </div>
            <!-- 建物名フォーム -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') }}"/>
                </div>
            </div>
            </div>
            <!-- お問い合わせの種類＿選択 -->
            <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <select name="category_id">
                        <option value="{{ old('category_id') }}">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}">
                                {{ $category['content'] }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            </div>
            <!-- お問い合わせ内容フォーム -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <textarea name="detail" cols="120" rows="3" value="{{ old('detail') }}"></textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <!-- 確認ボタンをクリックすると確認画面に遷移 -->
            <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
</div>
@endsection
