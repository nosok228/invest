@extends('layouts.default')

@section('content')

                 @if(!$tarifs)
                    <h3 style="color:red">Список тарифов пуст. <a href = "{{ route('addTarif') }}"> Добавить? </a></h3>

                 @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Заголовок</th>
                                <th>Описание</th>
                                <th>Количество часов</th>
                                <th>Процент</th>
                                <th>Минимальный платеж</th>
                                <th>Максимальный платеж</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarifs as $tarif)
                                <tr>
                                    <td>{{ $tarif->title }}</td>
                                    <td>{{ $tarif->description }}</td>
                                    <td>{{ $tarif->hour }}</td>
                                    <td>{{ $tarif->percent }}%</td>
                                    <td>{{ $tarif->min }}$</td>
                                    <td>{{ $tarif->max }}$</td>
                                    <td><a href = "{{ route('editTarif', ['id' => $tarif->id]) }}">Редактировать</a> || <a href = "{{ route('deleteTarif', ['id' => $tarif->id]) }}">Удалить</a></td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                @endif

@endsection