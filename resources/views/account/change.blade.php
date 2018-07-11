@extends('layouts.default')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Изменение пароля</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            @if(session()->has('errors'))
             <h1 style="color:red">Данные введены неверно</h1>
            @elseif(isset($error))
            <h1 style="color:red">{{ $error }}</h1>
            @endif
            <form method="post">
                {{ csrf_field() }}
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Текущий пароль:</label>
                        <input type="password" class="form-control" name="old_password">
                        <p class="help-block"></p>
                    </div>
                    <div class="controls">
                        <label>Новый пароль:</label>
                        <input type="password" class="form-control" name="password">
                        <p class="help-block"></p>
                    </div>
                    <div class="controls">
                        <label>Повтор нового пароля:</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        <p class="help-block"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Изменить пароль</button>
            </form>
        </div>
    </div>
</div>

@endsection