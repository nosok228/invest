@extends('layouts.default')
<style>
        /* CSS */
        .list-counter-circle {
          list-style: none;
          counter-reset: list;
          margin: 0;
          padding: 0;
          overflow: hidden;
        }
        .list-counter-circle>li {
          position: relative;
          display: block;
          height: 2rem;
          line-height: 2rem;
          margin-left: 1.75rem;
          margin-bottom: .25rem;
          padding-left: 1rem;
          padding-right: .5rem;
          color: #fff;
          background: #7b1fa2;
          white-space: nowrap;
          border-radius: .25rem
        }
        .list-counter-circle>li:last-child {
          margin-bottom: 0;
        }
        .list-counter-circle>li::before {
          content: counter(list);
          counter-increment: list;
          position: absolute;
          left: -2rem;
          top: -.25rem;
          bottom: -.25rem;
          width: 2.5rem;
          line-height: 2rem;
          border-radius: 1.25rem;
          border: .25rem solid #fff;
          text-align: center;
          color: #fff;
          background: #7b1fa2;
        }
        </style>

@section('content')

<div class="container">
        <h1 class="mt-4 mb-3">Ваши рефералы</h1>
        <div class="row">
            <div class="col-lg-12 mb-4">
                 @if($referals)
                    <ol class="list-counter-circle">
                        @foreach($referals as $ref)
                            <li> {{ $ref->login }} </li>
                        @endforeach
                          </ol>
                        <h3>Заработанно на рефералах: {{ $user->refBalance }}$</h3>
                    @else 
                      <p>У вас нет рефералов</p>
                    @endif
                    
            </div>
        </div>
    </div>

@endsection