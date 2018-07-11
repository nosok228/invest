@extends('layouts.default')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Забыли пароль?</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            @if(isset($error))
             <h1 style="color:red">{{ $error }}</h1>
            @elseif(isset($success))
            <h1 style="color:green">{{ $success }}</h1>
            @endif
            <form method="post">
                {{ csrf_field() }}
                <div class="control-group form-group">
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
                <button type="submit" class="btn btn-primary">Поменять пароль</button>
            </form>
        </div>
    </div>
</div>

@endsection