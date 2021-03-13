@extends('layouts.main')

@section('content')
    <div class="reg-form">
        <div class="container">
            <div class="reg sorder">
                <form method="post" action="{{route('sucseccorder')}}">
                    @csrf
                    <div class="col-md-6 order_info">
                        <h2>Контактна інформація</h2>
                        <ul>
                            @if(Auth::user())
                                <li class="text-info">Прізвище, ім'я, по-батькові*:</li>
                                <li><input id="order_name" type="text" name="order_name" value="{{Auth::user()->pip }}"
                                           required autocomplete="order_name" autofocus>
                            @else
                                <li class="text-info">Прізвище, ім'я, по-батькові*:</li>
                                <li><input id="order_name" type="text" name="order_name" required
                                           autocomplete="order_name"
                                           autofocus>
                            @endif
                        </ul>
                        <ul>
                            @if(Auth::user())
                                <li class="text-info">Email*:</li>
                                <li><input id="order_email" type="email" name="order_email"
                                           value="{{Auth::user()->email }}"
                                           required autocomplete="order_email">
                            @else
                                <li class="text-info">Email*:</li>
                                <li><input id="order_email" type="text" name="order_email" required
                                           autocomplete="order_email"
                                    >
                            @endif
                        </ul>
                        <ul>
                            @if(Auth::user())
                                <li class="text-info">Телефон*:</li>
                                <li><input id="order_phone" type="tel" name="order_phone"
                                           value="{{Auth::user()->phone }}"
                                           required autocomplete="order_phone">
                            @else
                                <li class="text-info">Телефон*:</li>
                                <li><input id="order_phone" type="text" name="order_phone" required
                                           autocomplete="order_phone"
                                    >
                            @endif
                        </ul>
                        <ul>
                            <li class="text-info">Коментар до замовлення:</li>
                            <li><textarea id="order_note" name="order_note"></textarea>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="delivery_address">
                            <h2>Доставка "Нова пошта"</h2>
                            <ul>
                                @if(Auth::user())
                                    <li class="text-info">Область*:</li>
                                    <li><input id="post_obl" type="text" name="post_obl"
                                               value="{{Auth::user()->region }}" required autocomplete="post_obl">
                                @else
                                    <li class="text-info">Область*:</li>
                                    <li><input id="post_obl" type="text" name="post_obl" required
                                               autocomplete="post_obl">
                                @endif
                            </ul>
                            <ul>
                                @if(Auth::user())
                                    <li class="text-info">Місто (населений пункт)*:</li>
                                    <li><input id="post_city" type="text" name="post_city" required
                                               autocomplete="post_city" value="{{Auth::user()->city }}">
                                @else
                                    <li class="text-info">Місто (населений пункт)*:</li>
                                    <li><input id="post_city" type="text" name="post_city" required
                                               autocomplete="post_city">
                                @endif
                            </ul>
                            <ul>
                                @if(Auth::user())
                                    <li class="text-info">№ Відділення*:</li>
                                    <li><input id="post_num" type="text" name="post_num" required
                                               autocomplete="post_num" value="{{Auth::user()->number_department }}">
                                @else
                                    <li class="text-info">№ Відділення*:</li>
                                    <li><input id="post_num" type="text" name="post_num" required
                                               autocomplete="post_num">
                                @endif
                            </ul>
                        </div>
                        <div class="payment">
                            <h2>Оплата</h2>
                            <div></div>
                            <label class="container_pay">Оплата готівкою при отриманні
                                <input type="radio" checked="checked" name="payment[]" required
                                       value="Оплата готівкою при отриманні">
                                <span class="checkmark"></span>
                            </label>
                            <label class="container_pay">Оплата за реквізитами
                                <input type="radio" name="payment[]" required value="Оплата за реквізитами">
                                <span class="checkmark"></span>
                            </label>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <input class="suc_order" type="submit" value="Підтвердити замовлення">
                    </div>
                </form>
            </div>
        </div>
@endsection

