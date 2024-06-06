@extends('layouts.layout')

@section('title')
    カレンダー
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset("css/calendar.css") }}">
@endsection
@section('content')
    <main id="main">
        <div class="month-navigation">
            <a class="month-back-next" href="{{ route("calendar.show",date("Y-m",strtotime($target_month . " -1 month"))) }}">&lt</a>
            <span class="month">{{ $target_month }}</span>
            <a class="month-back-next" href="{{ route("calendar.show",date("Y-m",strtotime($target_month . " +1 month"))) }}">&gt</a>
        </div>
        <div class="table__div">
            <table id="table">
                <tr>
                    <th>日</th>
                    <th>月</th>
                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                    <th>土</th>
                </tr>

                @for ($i = 0; $i < 5; $i++)
                    <tr>
                    @for ($j = 0; $j < 7; $j++)
                        <td><a href="{{ route("showList",$days[$i*7+$j]->format("Y-m-d")) }}">
                            {{ $days[$i*7+$j]->format("d") }}</a></td>
                    @endfor
                    </tr>
                @endfor
                @if (count($days) > 35)
                    <tr>
                        @for ($i = 0; $i < 7; $i++)
                        <td><a href="{{ route("showList",$days[35+$i]->format("Y-m-d")) }}">
                            {{ $days[35+$i]->format("d") }}</a></td>
                        @endfor
                    </tr>
                @endif
            </table>
        </div>
    </main>
@endsection
