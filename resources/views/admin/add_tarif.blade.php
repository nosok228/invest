@extends('layouts.default')

@section('content')

<form method="POST">
    {{ csrf_field() }}
        <div class="form-group">
          <label for="title">Заголовок</label>
          <input type="text" class="form-control" id="title" name = "title" required>
        </div>
        <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name = "description" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="hour">Продолжительность тарифа</label>
          <input type="number"class="form-control" id="hour" name = "hour" required>
          </input>
        </div>
        <div class="form-group">
                <label for="percent">Процент</label>
                <input type="number"class="form-control" id="percent" name = "percent" required>
                </input>
              </div>
              <div class="form-group">
                    <label for="min">Минимальный платеж</label>
                    <input type="number"class="form-control" id="min" name = "min" required>
                    </input>
                </div>
            <div class="form-group">
                        <label for="max">Максимальный платеж</label>
                        <input type="number"class="form-control" id="max" name = "max" required>
                        </input>
                      </div>
                      <input class="btn btn-primary" type="submit" value="Добавить">
      </form>

@endsection
