<?php

use App\Models\Order_Product;
use App\Models\Product;

$items = Order_Product::select('*')->get();
$products = Product::select('*')->get();

?>

@extends('layouts.main')

@section('content')
    <div class="reg-form">
        <div class="container mtop">
            <div class="reg sorder">
                <div class="col-lg-3">
                    <div class="user_sidebar">
                        <a href="{{route('profile')}}"><span aria-hidden="true"
                                                             class="glyphicon glyphicon-user gir"></span>
                            Обліковий запис</a>
                        <a href="{{route('deliveryaddress')}}">
                            <span aria-hidden="true" class="glyphicon glyphicon-transfer gir"></span>
                            </i> Адреса доставки</a>
                        <a href="{{route('changepassword')}}">
                            <span aria-hidden="true" class="glyphicon glyphicon-lock gir"></span>
                            </i> Зміна пароля</a>
                        <a class="activeprofile" href="{{route('vieworders')}}">
                            <span aria-hidden="true" class="glyphicon glyphicon-shopping-cart gir"></span>
                            </i> Замовлення</a>
                        @if(Auth::user()->hasAnyRole(['admin', 'manager', 'redactor']))
                            <a href="{{route('dashboard')}}">
                                <span aria-hidden="true" class="glyphicon glyphicon-wrench gir"></span>
                                </i> Адмін панель</a>
                        @endif
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span aria-hidden="true" class="glyphicon glyphicon-off gir"></span>
                            Вихід</a>
                    </div>
                    <form id="logout-form" action="{{route('logout')}}" method="POST">
                        @csrf
                    </form>
                </div>
                <div class="col-lg-offset-1 col-lg-8">
                    <h2 class="user_profile_h">Ваші замовлення</h2>
                    @if(count($orders) < 1)
                        <p class="palrt">Замовлення відсутні!</p>
                    @else
                    <table class="table torders">
                        <thead>
                        <tr>
                            <th scope="col">№ замовлення</th>
                            <th scope="col">Дата замовлення</th>
                            <th scope="col">Сума</th>
                            <th scope="col">Статус</th>
                            <th scope="col">ТТН</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><a class="btn btn-primary" data-toggle="collapse"
                                       href="#collapseExample{{$order->id}}"
                                       role="button" aria-expanded="false"
                                       aria-controls="collapseExample"> {{$order->id}}
                                        <span class="glyphicon glyphicon-arrow-down prt" aria-hidden="true"></span> </a>
                                </td>
                                <td>{{date("Y-d-m", strtotime($order->created_at )) }}</td>
                                <td>{{$order->total_cost}} ₴</td>
                                @if($order->status == "Нове замовлення")
                                    <td class="order_new">Нове замовлення</td>
                                @elseif($order->status == "Очікує оплати")
                                    <td class="order_wait">Очікує оплати</td>
                                @elseif($order->status == "Відправлене")
                                    <td class="order_delivering">Відправлено</td>
                                @elseif($order->status == "Відмінене")
                                    <td class="order_cancel">Відмінено</td>
                                @elseif($order->status == "Завершене")
                                    <td class="order_final">Завершено</td>
                                @endif
                                <td>{{$order->TTN}}</td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div class="collapse" id="collapseExample{{$order->id}}">
                                        <div class="card card-body">
                                            <table class="table order_items">
                                                <thead>
                                                <th>Перегляд</th>
                                                <th>Виробник</th>
                                                <th>Модель</th>
                                                <th>Ціна</th>
                                                <th>Розмір</th>
                                                <th>Кількість</th>
                                                </thead>
                                                <tbody>
                                                @foreach($items as $item)
                                                    @if($order->id == $item->order_id)
                                                        @foreach($products as $product)
                                                            @if($product->id == $item->product_id)
                                                                <tr>
                                                                    <td class="tac"><a target="_blank" href="{{url('product/'.$product->id)}}">
                                                                            <span class="glyphicon glyphicon-eye-open"
                                                                                  aria-hidden="true"></span> </a></td>
                                                                    <td>{{$product->manufacturer}}</td>
                                                                    <td>{{$product->model}}</td>
                                                                    <td> {{$product->price}} ₴</td>
                                                                    @endif
                                                                    @endforeach
                                                                    <td> {{$item->size}}</td>
                                                                    <td> {{$item->quantity}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="paginate"> {{ $orders->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
