@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageh2">Інформація про доставку</h2>
                <img src="{{asset('images/delivery.jpg')}}" alt="delivery" class="img-responsive" style="margin: auto">
                <div class="faq">
                    <p class="qustion">
                        Ми співпрацюємо з службою доставки "Нова пошта"
                    </p>
                    <p class="answer">
                        Оплата здійснюється готівкою/карткою у Відділенні Нова Пошта.<br>
                        Огляд товару і відмова від посилки згідно з діючими правилами Нової Пошти.<br>
                        Вартість доставки в Відділення Нова Пошта - 50 Грн + 2% від суми замовлення.<br>
                        При оплаті товару за реквізитами - доставка безкоштовна.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
