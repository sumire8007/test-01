<!-- 管理画面 -->
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
            <form class="form" action="/logout" method="post">
            @csrf
            <button class="header-nav__button">ログアウト</button>
            </form>
        </div>

        </div>
    </header>

    <main>
        <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Admin</h2>
        </div>
    <div class="contact__content">
        <!-- 検索 -->
        <form class="search-form" action="" method="get">
            @csrf
            <!-- キーワードで検索 -->
            <div class="search-form__item">
                <input class="search-form__item-input" type="text" name="keyword" value="{{old('keyword')}}">
            </div>

            <!-- 性別で検索 -->
            <select class="search-form__item-select" name="gender">
                    <option value="">性別</option>
                <!-- @foreach ($contacts as $contact)
                    <option value="{{ $contact['gender'] }}">
                        {{ $contact['gender'] }}
                    </option>
                @endforeach -->
            </select>

            <!-- お問い合わせの種類で検索 -->
            <select class="search-form__item-select" name="category_id">
                    <option value="">お問い合わせの種類</option>
                <!-- @foreach ($categories as $category)
                    <option value="{{ $contact['category_id'] }}">
                        {{ $contact['category_id'] }}
                    </option>
                @endforeach -->
            </select>

            <!-- 年月日で検索(カレンダーを表示して検索) -->
            <select class="search-form__item-select" name="">
                    <option value="">年月日</option>
                <!-- @foreach ($contacts as $contact)
                    <option value="{{ $contact['created_at'] }}">
                        {{ $contact['created_at'] }}
                    </option>
                @endforeach -->
            </select>

            <!-- 検索ボタン -->
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>

            <!-- リセットボタン -->
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">リセット</button>
            </div>

        </form>

        <!-- ページネーション入れる -->
        <!-- 問い合わせ内容のリスト表示 -->
        <div class="contact-table">
            <table class="contact-table__inner">
                <tr class="contact-table__row">
                    <th>
                        <span class="contact-table__header-span">お名前</span>
                        <span class="contact-table__header-span">性別</span>
                        <span class="contact-table__header-span">メールアドレス</span>
                        <span class="contact-table__header-span">お問い合わせの種類</span>
                    </th>
                </tr>
                <!-- contactリストの表示 & 詳細でモーダルウィンドウを入れる -->
                @foreach ($contacts as $contact)
                <tr class="contact-table__row">
                    <!-- お名前の表示 -->
                    <td class="contact-table__item">
                        <div class="contact__item">
                            <p class="contact-form__item-p">{{ $contact['first_name'] }}</p>
                        </div>
                    </td>
                    <!-- 性別の表示 -->
                    <td class="contact-table__item">
                        <div class="contact__item">
                            <p class="contact-form__item-p">{{ $contact['gender'] }}</p>
                        </div>
                    </td>
                    <!-- メールアドレスの表示 -->
                    <td class="contact-table__item">
                        <div class="contact__item">
                            <p class="contact-form__item-p">{{ $contact['email'] }}</p>
                        </div>
                    </td>
                    <!-- お問い合わせ種類の表示 -->
                    <td class="contact-table__item">
                        <div class="contact__item">
                            <p class="contact-form__item-p">{{ $contact['category_id'] }}</p>
                        </div>
                    </td>
                    <!-- 詳細のボタン、モーダルウィンドウで詳細表示 -->
                    <td>
                        <form action="">
                        <div class="detail-form__button">
                            <button class="detail-form__button-submit" type="submit">詳細</button>
                        </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
