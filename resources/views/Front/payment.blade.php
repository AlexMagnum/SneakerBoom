@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageh2">Оплата за товар</h2>
                <img src="{{asset('images/pay.jpg')}}" alt="payment" class="img-responsive" style="margin: auto">
                <div class="faq">
                    <p class="qustion">
                        Оплата банківською картою за реквізитами:
                    </p>
                    <p class="answer">
                        Можете оплатити замовлення карткою Visa, Mastercard.
                        За умови оплати банківською картою Ваше замовлення буде оброблено миттєво, що допоможе нам якомога швидше Вам його вислати, а доставка буде безкоштовною.
                        Зверніть увагу, розмір комісії - відповідно до тарифів Вашого банку.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Оплата при отриманні (післяплата, накладений платіж):
                    </p>
                    <p class="answer">
                        За фактом отримання, оплата готівкою кур'єру або у відділенні Нова Пошта за доставку (вартість доставки 50 Грн + 2% від суми замовлення) та за товар.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
