@extends('layouts.app')

@section('title-block')Курсы валют@endsection

@section('content')
    @if (isset($usd) && isset($eur)) 
        <h4>Курс доллара</h4>
        <table>
            <tr>
                <th>Дата</th>
                <th>Курс в рублях</th>
            </tr>
            @foreach ($usd as $key => $item)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item }}</td>
                </tr>
            @endforeach
        </table>        
        <h4>Курс евро</h4>
        <table>
            <tr>
                <th>Дата</th>
                <th>Курс в рублях</th>
            </tr>
            @foreach ($eur as $key => $item)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item }}</td>
                </tr>
            @endforeach
        </table>
    @endif
    <form action="{{ route('get-form') }}" method="post">
        @csrf 

        <div>
            <label for="peroid">Выберите период:</label>
            <label for="date_begin">c </label>
            <input type="date" name="date_begin" id="date_begin">
            <label for="date_end"> по </label>
            <input type="date" name="date_end" id="date_end">
        </div>
        <button type="submit">Показать курс</button>
    </form>
    <form action="{{ route('home') }}" method="get">
        <button type="submit">Выйти</button>
    </form>
@endsection