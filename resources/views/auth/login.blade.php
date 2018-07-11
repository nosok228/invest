@extends('layouts.default')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Вход</h1>
    <div class="row">
        <div class="col-lg-8 mb-4">
            @if(isset($error))
             <h1 style="color:red">Неверный логин или пароль</h1>
          @endif
            <form method="post">
                {{ csrf_field() }}
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Пароль</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <a href = "{{ route('forget') }}">Забыли пароль?</a>
                <button type="submit" class="btn btn-primary">Вход</button>
            </form>
        </div>
    </div>
</div>

@endsection