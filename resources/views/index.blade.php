@extends('layouts.default')

@section('content')

<div class="container">
    <h1 class="my-4">Тарифы</h1>
    <div class="row">
        @foreach($tarifs as $tarif)
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h3 class="card-header">{{ $tarif->title }}</h3>
                    <div class="card-body">
                        <div class="display-4"> {{ $tarif->percent }}%</div>
                        <div class="font-italic">{{ $tarif->description }}</div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Минимальная инвестиция:  {{ $tarif->min }}$</li>
                        <li class="list-group-item">Максимальная инвестиция:  {{ $tarif->max }}$</li>
                        <li class="list-group-item">Период инвестиции:  {{ $tarif->hour }}ч.</li>
                        <li class="list-group-item">
                            @if(\Illuminate\Support\Facades\Auth::user())
                              <a href="{{ route('buy', ['id' => $tarif->id]) }}" class="btn btn-primary">Инвестировать</a>
                            @else
                               <p style="color:red">* Для покупки этого тарифа необходима авторизация</p>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
       
    </div>
</div>



@endsection