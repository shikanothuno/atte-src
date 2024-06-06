@extends('layouts.layout')

@section('title')
    打刻ページ
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/stamping.css") }}">
@endsection
@section('content')
    <main id="main">
        <h2 class="message">{{ $user->name }}さんお疲れ様です！</h2>
        <div class="link-container">
            <table class="link__table">
                <tr>
                    <th>
                        @if ($user->working == 1)
                        <a class="link link-disenable" href="{{ route("startAttendance") }}">勤務開始</a>
                        @else
                        <a class="link link-enable" href="{{ route("startAttendance") }}">勤務開始</a>
                        @endif
                    </th>
                    <th>
                        @if ($user->working == 0 || $user->breaking == 1)
                        <a class="link link-disenable" href="{{ route("endAttendance") }}">勤務終了</a>
                        @else
                        <a class="link link-enable" href="{{ route("endAttendance") }}">勤務終了</a>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th>
                        @if ($user->working == 0 || $user->breaking == 1)
                        <a class="link link-disenable" href="{{ route("startBreakTime") }}">休憩開始</a>
                        @else
                        <a class="link link-enable" href="{{ route("startBreakTime") }}">休憩開始</a>
                        @endif
                    </th>
                    <th>
                        @if ($user->working == 0 || $user->breaking == 0)
                        <a class="link link-disenable" href="{{ route("endBreakTime") }}">休憩終了</a>
                        @else
                        <a class="link link-enable" href="{{ route("endBreakTime") }}">休憩終了</a>
                        @endif
                    </th>
                </tr>
            </table>
        </div>
    </main>
@endsection
