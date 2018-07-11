@extends('layouts.default')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Восстановить пароль</h1>
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
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email">
                        <p class="help-block"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Восстановить пароль</button>
            </form>
        </div>
    </div>
</div>

@endsection