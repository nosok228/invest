@extends('layouts.default')
@section('content')

<div class="container">
    <h1 class="mt-4 mb-3">{{ $tariff->title }}</h1>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <form action="https://perfectmoney.is/api/step1.asp" method="post" target="_blank" id="no_ajax">				
				<div class="control-group form-group">
                    <div class="controls">
                        <label>Название тарифа:</label>
                        <input type="text" class="form-control" value="{{ $tariff->title }}" disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Период инвестиции:</label>
                        <input type="text" class="form-control" value="{{ $tariff->hour }} ч." disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Процентная ставка:</label>
                        <input type="text" class="form-control" value="{{ $tariff->percent }} %" disabled>
                    </div>
                </div>
				<input type="hidden" name="PAYEE_ACCOUNT" value="U17905778">
				<input type="hidden" name="PAYEE_NAME" value="Оплата тарифа # {{ $tariff->id }}">
				<div class="control-group form-group">
                    <div class="controls">
                        <label>Сумма:</label>
                        <input type="number" min="{{ $tariff->min }}" class="form-control" value="{{ $tariff->min }}" name="PAYMENT_AMOUNT">
                    </div>
                </div>
                
                <input type="hidden" name="PAYMENT_UNITS" value="USD">
                <input type="hidden" name="STATUS_URL" value={{ route('perfectMoney') }}>
                <input type="hidden" name="PAYMENT_URL" value="https://www.myshop.com/cgi-bin/chkout1.cgi">
                <input type="hidden" name="NOPAYMENT_URL"  value="https://www.myshop.com/cgi-bin/chkout2.cgi">
                <input type="hidden" name="PAYMENT_ID" value="{{ $tariff->id }}','{{ $userId }}">
				<button type="sumbit" class="btn btn-primary">Перейти к оплате</button>
			</form>
        </div>
        
    </div>
</div>
@endsection