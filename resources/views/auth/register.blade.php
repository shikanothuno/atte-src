@extends('layouts.layout')

@section('title')
    会員登録
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/register.css") }}">
@endsection
@section('content')
    <main id="main">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <div class="parent">

            <form action="{{ route("register") }}" method="POST">
                @csrf
                <h2>会員登録</h2>
                <input class="child__input" type="text" name="name" placeholder="名前">
                <input class="child__input" type="text" name="email" placeholder="メールアドレス">
                <input class="child__input" type="password" name="password" placeholder="パスワード">
                <input class="child__input" type="password" name="password_confirmation" placeholder="確認用パスワード">
                <button class="child__button">会員登録</button>
                <p class="child__p">アカウントをお持ちの方はこちらから</p>
                <a class="child__a" href="{{ route("login") }}">ログイン</a>
            </form>
        </div>
    </main>
@endsection
