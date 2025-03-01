<!-- 管理画面 -->
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('nav')
    <div class="header__button">
        @if(Auth::check())
        <form class="form" action="/logout" method="post">
        @csrf
        <button class="header__button">logout</button>
        </form>
        @endif
    </div>
@endsection

@section('content')
<div class="admin-form__content">
    <div class="admin-form__heading">
        <h2>Admin</h2>
    </div>
<div class="contact__content">
    <!-- 検索 -->
    <form class="search-form" action="/contacts/search" method="get">
    @csrf
        <!-- キーワードで検索 -->
        <div class="search-form__item">
            <input class="search-form__item-input" placeholder="名前やメールアドレスを入力してください"type="text" name="keyword" value="{{old('keyword')}}">
        </div>

        <!-- 性別で検索 -->
        <select class="search-form__item-select" name="gender">
                <option disabled selected>性別</option>
                <option value="1" @if( request('gender') ==1 ) selected @endif>男性</option>
                <option value="2" @if( request('gender') ==2 ) selected @endif>女性</option>
                <option value="3" @if( request('gender')==3 ) selected @endif>その他</option>
        </select>

        <!-- お問い合わせの種類で検索 -->
        <select class="search-form__item-select" name="category_id">
                <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">
                    {{ $category['content'] }}
                </option>
            @endforeach
        </select>

        <!-- 年月日で検索(カレンダーを表示して検索) -->
        <input class="search-form__item-select" type="date" name="created_at" value="{{old('created_at')}}"></input>

        <!-- 検索ボタン -->
        <div class="search-form__button">
            <button class="search-form__button-submit" type="submit">検索</button>
        </div>
    </form>
        <!-- リセットボタン -->
    <form class="" action="/admin" method="get">
        <div class="search-form__button">
            <button class="search-form__button-submit--reset">リセット</button>
        </div>
    </form>
    <!-- エクスポート -->
    <div class="export">
        <form action="{{'/export?'.http_build_query(request()->query())}}" method="post">
        @csrf
        <input class="export__btn btn" type="submit" value="エクスポート">
        </form>
        {{ $contacts->appends(request()->query())->links('.default-copy') }}
    </div>
    <!-- ページネーション -->
    <div>
    {{ $contacts->links('.default-copy') }}
    </div>
    <!-- 問い合わせ内容のリスト表示 -->
    <div class="admin-table">
        <table class="admin-table__inner">
            <tr class="admin-table__row-title">
                    <th><span class="contact-table__header-span">お名前</span></th>
                    <th><span class="contact-table__header-span">性別</span></th>
                    <th><span class="contact-table__header-span">メールアドレス</span></th>
                    <th><span class="contact-table__header-span">お問い合わせの種類</span></th>
            </tr>
            <!-- contactテーブルリストの表示 & 詳細でモーダルウィンドウを入れる -->
            @foreach ($contacts as $contact)
            <tr class="admin-table__row">
                <!-- お名前の表示 -->
                <td class="admin-table__item">
                    <div class="admin__item">
                        <p class="admin-form__item-p">{{ $contact['first_name'] }}</p>
                        <p class="admin-form__item-p">{{ $contact['last_name'] }}</p>
                    </div>
                </td>
                <!-- 性別の表示 -->
                <td class="admin-table__item">
                    <div class="admin__item">
                        <p class="admin-form__item-p">
                            @if($contact->gender == 1)
                            男性
                            @elseif($contact->gender == 2)
                            女性
                            @else
                            その他
                            @endif
                        </p>
                    </div>
                </td>
                <!-- メールアドレスの表示 -->
                <td class="admin-table__item">
                    <div class="admin__item">
                        <p class="admin__item-p">{{ $contact['email'] }}</p>
                    </div>
                </td>
                <!-- お問い合わせ種類の表示 -->
                <td class="admin-table__item">
                    <div class="admin__item">
                        <p class="admin-form__item-p" value="{{ $contact['category_id'] }}">{{$contact['category']['content']}}
                        </p>
                    </div>
                </td>
                <!-- 詳細のボタン、モーダルウィンドウで詳細表示 -->
                <td>
                <form class="delete-form" action="/delete" method="post">
                @csrf
                @method('DELETE')
                <div class="detail-form__button">
                    <a href="#modal" class="modal-open-button">詳細</a>
                        <div class="modal" id="modal">
                        <div class="modal-wrapper">
                            <a href="#" class="close">&times;</a>
                            <div class="modal-content">
                                <div class="confirm-table">
                                <table class="confirm-table__inner">
                                    <!-- 名前 -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">お名前</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">{{ $contact['first_name'] }}</p>
                                            <p class="contact-form__item-p">{{ $contact['last_name'] }}</p>
                                        </td>
                                    </tr>
                                    <!-- 性別 -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">性別</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">
                                            @if($contact->gender == 1)
                                            男性
                                            @elseif($contact->gender == 2)
                                            女性
                                            @else
                                            その他
                                            @endif
                                            </p>
                                        </td>
                                    </tr>
                                    <!-- メールアドレス -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">メールアドレス</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">{{ $contact['email'] }}</p>
                                        </td>
                                    </tr>
                                    <!-- 電話番号 -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">電話番号</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">{{ $contact['tell'] }}</p>
                                        </td>
                                    </tr>
                                    <!-- 住所 -->
                                    <tr class="confirm-table__row">
                                    <th class="confirm-table__header">住所</th>
                                    <td class="confirm-table__text">
                                        <p class="contact-form__item-p">{{ $contact['address'] }}</p>
                                    </td>
                                    </tr>
                                    <!-- 建物名 -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">建物名</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">{{ $contact['building'] }}</p>
                                        </td>
                                    </tr>
                                    <!-- お問い合わせ種類 -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">お問い合わせの種類</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">{{$contact['category']['content']}}</p>
                                        </td>
                                    </tr>
                                    <!-- お問い合わせ内容 -->
                                    <tr class="confirm-table__row">
                                        <th class="confirm-table__header">お問い合わせ内容</th>
                                        <td class="confirm-table__text">
                                            <p class="contact-form__item-p">{{ $contact['detail'] }}</p>
                                        </td>
                                    </tr>
                                </table>
                                </div>
                                <div class="form__button">
                                    <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                    <button class="form__button-submit" type="submit">削除</button>
                                </div>
                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                </div>
                </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection