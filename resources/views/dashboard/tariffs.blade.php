@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4">
            @if(empty($list))
            	<p>Список инвестиций пуст</p>
             @else
            	<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>Дата старта</th>
            				<th>Дата завершения</th>
            				<th>Сумма</th>
            				<th>Получаете</th>
            				<th>Процент</th>
                            <th>Статус</th>
            			</tr>
            		</thead>
            		<tbody>
		            	@foreach ($list as $val)
		            		<tr>
								{{ $val }}
							</tr>
						@endforeach
					
				@endif
        </div>
    </div>
</div>
@endsection