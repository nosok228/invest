@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mb-4">
            @if(isset($error))
             <h1 style="color:red">{{ $error }}</h1>
            @elseif(isset($success))
            <h1 style="color:green">{{ $success }}</h1>
            @endif
            
        </div>
    </div>
</div>

@endsection