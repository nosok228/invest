@extends('layouts.default')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Аккаунт></h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
        @if(isset($notice))
           <h2 style="color:red">{{ $notice }}
        @endif
        @if(isset($success))
           <h2 style="color:green">{{ $success }}</h2>
        @endif
        </div>
        @if(\Illuminate\Support\Facades\Auth::user()->status)
        <h3>Ваша ссылка для приглашения рефералов: {{ route('register', ['id' => \Illuminate\Support\Facades\Auth::user()->login]) }}
            <br> <br> <br> <br> <br> <br>
            <p> Настройки аккаунта <br> <br>
                <a class="btn btn-primary" href = "{{ route('changePassword') }}">Изменить пароль</a>
                <a class="btn btn-primary" href = "{{ route('changeWallet') }}">Изменить кошелек</a>
            </p>
            <br> <br> <br> <br> <br> <br>
               <form method="POST">
                   {{ csrf_field() }}
                   <label for = "sum">Средства которые вы можете вывести</label>
                   <br>
                   <input type = "text" value = "{{ $wallet }}" readonly id = "sum" name = "sum">
                   <button type="submit" class="btn btn-primary">Запросить вывод денег</button>
               </form>
        @endif
    </div>
</div>

@endsection