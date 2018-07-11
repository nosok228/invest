@extends('layouts.default')

@section('content')

<div class="container">
        <h1 class="mt-4 mb-3">История</h1>
        <div class="row">
            <div class="col-lg-12 mb-4">
                 @if(!$list)
                    <p>История пуста</p>
                
                    @elseif(isset($list['payments']))
                    <h1>Свои платежи</h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Начало инвестиции</th>
                                <th>Конец инвестиции</th>
                                <th>Инвестиция</th>
                                <th>Прибыль</th>
                                <th>Процент</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list['payments'] as $val)
                                <tr>
                                    <td>{{ $val->investStart }}</td>
                                    <td>{{ $val->investFinish }}</td>
                                    <td>{{ $val->sumin }}$</td>
                                    <td>{{ $val->sumout }}$</td>
                                    <td>{{ $val->percent }}%</td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                 @endif
            </div>
        </div>
    </div>

@endsection