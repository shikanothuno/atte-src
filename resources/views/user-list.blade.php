@extends('layouts.layout')

@section('title')
    ユーザ一覧
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/user-list.css") }}">
@endsection
@section('content')
    <main id="main">
        <div class="table__div">
            <table id="table">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a class="user-name" href="{{ route("userDetail",["user" => $user,"month" => date("Y-m")]) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $users->links("pagination.pagination-design") }}
    </main>
@endsection
