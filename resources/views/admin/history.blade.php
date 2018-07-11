@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><h1>История</h1></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                         @if(!$history)
                            <p>История пуста</p>
                         @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Логин</th>
                                        <th>E-mail</th>
                                        <th>Инвестиция</th>
                                        <th>Прибль</th>
                                        <th>Процент</th>
                                        <th>Начало инвестиции</th>
                                        <th>Конец инвестиции</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history as $val)
                                     @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->login }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $val->sumin }}$</td>
                                            <td>{{ $val->sumout }}$</td>
                                            <td>{{ $val->percent }}%</td>
                                            <td>{{ $val->created_at }}</td>
                                            <td>{{ $val->investFinish }}</td>
                                        </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection