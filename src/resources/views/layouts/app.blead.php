
<ul class="header-nav">
@if (Auth::check())
    <li class="header-nav__item">
        <form action="/logout" method="post">
        @csrf
        <button class="header-nav__button">ログアウト</button>
        </form>
    </li>
@endif
</ul>