@extends('layouts.default') 

@section('content')

<div class="container">
    <h1 class="mt-4 mb-3">Регистрация</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
           @if(count($errors) > 0)
              <h1 style="color:red">Ошибка при заполнении данных</h1>
           @endif
            <form method="post">
                {!! csrf_field() !!}
                <div class="control-group form-group">
                    <div class="controls">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
                @if(!is_null($ref))
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Пригласил:</label>
                        <input type="text" class="form-control" name="ref" value = {{ $ref }} readonly>
                    </div>
                </div>
                @else
                <input type = "hidden" name = "ref" value = "0">
                @endif
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Логин:</label>
                        <input type="text" class="form-control" name="login">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Номер кошелька:</label>
                        <input type="text" class="form-control" name="wallet">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Пароль</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Повторите Пароль</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <a href = "{{ route('login') }}">Зарегестрированы? Войти</a>
                
                <input type = "submit" class="btn btn-primary" value = "Регистрация">
            </form>
        </div>
    </div>
</div>

@endsection