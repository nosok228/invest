@extends('layouts.default')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Изменение Кошелька</h1>
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
                        <label>Пароль:</label>
                        <input type="password" class="form-control" name="password" required>
                        <p class="help-block"></p>
                    </div>
                    <div class="controls">
                        <label>Новый кошелек:</label>
                        <input type="password" class="form-control" name=" wallet" required>
                        <p class="help-block"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Изменить кошелек</button>
            </form>
        </div>
    </div>
</div>

@endsection