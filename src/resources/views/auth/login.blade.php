<!-- ログイン画面 -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    </head>

    <body>
    <header class="header">
        <div class="header__inner">
        <h1>FashionablyLate</h1>
        <div class="header__button">
            <a href="/register">register</a>
        </div>

        </div>
    </header>

    <main>
        <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Login</h2>
        </div>
        <form class="form" action="/login" method="post">
            @csrf
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



            <!-- ログインをクリックすると管理画面に遷移 -->
            <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
        </div>
    </main>
</body>

</html>
