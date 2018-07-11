@extends('layouts.default')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Заявки на вывод по тарфиам</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if (!$requests)
                            <p>Список заявок на вывод по тарфиам пуст</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Номер вклада</th>
                                        <th>Дата</th>
                                        <th>Сумма</th>
                                        <th>Логин</th>
                                        <th>Email</th>
                                        <th>Кошелек</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>{{ $request->id }}</td>
                                            <td>{{ $request->created_at }}</td>
                                            <td>{{ $request->sum }}$</td>
                                            <td>{{ $request->login }}</td>
                                            <td>{{ $request->email }}</td>
                                            <td>{{ $request->wallet }}</td>
                                            <td>
                                                <form method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="type" value="tariff">
                                                    <input type="hidden" name="id" value="{{ $request->user_id }}">
                                                    <button type="submit" class="btn btn-success">Выплатить</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         @endif
                    </div>
                </div>
            </div>
        </div>
         
@endsection