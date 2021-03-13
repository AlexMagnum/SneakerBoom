@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(session()->has('alert-abort'))
                        <div class="alert alert-warning">
                            {{ session()->get('alert-abort') }}
                        </div>
                    @endif
                    <h1 class="m-0">Детальна інформація замовлення</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>
                                    <a href="{{ route('orders.edit', $order->id)}}" class="btn btn-info"><i
                                            class="fas fa-edit pr"></i>
                                        Редагувати замовлення</a>
                                </td>
                                <td>
                                    <form action="{{route('invoice', $order->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-success"> <i class="far fa-envelope pr"></i>
                                            Відправити підтвердження замовлення з номером накладної клієнту </button>
                                    </form>
                                 </td>
                            </tr>
                            <tr>
                                <td><b>№ замовлення:</b></td>
                                <td>
                                    {{$order->id}}
                                </td>
                            </tr>
                            @if($user != null)
                                <tr>
                                    <td><b>Користувач:</b></td>
                                    <td>
                                        <a href="{{route('users.show', $user->id)}}">
                                        Id: {{$user->id}}<br>
                                        Нікнейм: {{$user->name}}
                                        <i style="padding-left: 10px;" class="fas fa-external-link-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td><b>Користувач:</b></td>
                                    <td>
                                        Замовлення зроблено без облікового запису
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Адреса доставки:</b></td>
                                <td>
                                    <b> <i><u>Область:</u></i></b> {{explode("->", $order->destination_address)[0]}}<br>
                                    <b><i><u>Місто (населений
                                                пункт):</u></i></b> {{explode("->", $order->destination_address)[1]}}
                                    <br>
                                    <b> <i><u>№
                                                відділення:</u></i></b> {{explode("->", $order->destination_address)[2]}}
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Загальна вартість замовлення:</b></td>
                                <td>
                                    {{$order->total_cost}} ₴
                                </td>
                            </tr>
                            <tr>
                                <td><b>Статус:</b></td>
                                @if($order->status == "Нове замовлення")
                                    <td class="order_new">Нове замовлення</td>
                                @elseif($order->status == "Очікує оплати")
                                    <td class="order_wait">Очікує оплати</td>
                                @elseif($order->status == "Відправлене")
                                    <td class="order_delivering">Відправлене</td>
                                @elseif($order->status == "Відмінене")
                                    <td class="order_cancel">Відмінене</td>
                                @elseif($order->status == "Завершене")
                                    <td class="order_final">Завершене</td>
                                @endif
                            </tr>
                            @if(isset($order->created_at))
                                <tr>
                                    <td><b>Дата оформлення:</b></td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                </tr>
                            @endif
                            @if(isset($order->updated_at))
                                <tr>
                                    <td><b>Дата останнього редагування:</b></td>
                                    <td>
                                        {{$order->updated_at}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Прізвище, ім'я, по-батькові:</b></td>
                                <td>
                                    {{$order->name}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>E-mail:</b></td>
                                <td>
                                    {{$order->email}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Телефон:</b></td>
                                <td>
                                    {{$order->phone}}
                                </td>
                            </tr>
                            @if(isset($order->note))
                                <tr>
                                    <td><b>Коментар до замовлення:</b></td>
                                    <td>
                                        {{$order->note}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Тип оплати:</b></td>
                                <td>
                                    {{$order->paymentsystem}}
                                </td>
                            </tr>
                            @if(isset($order->TTN))
                                <tr>
                                    <td><b>ТТН:</b></td>
                                    <td>
                                        {{$order->TTN}}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <h3 class="orh3">Товари у замовленні:</h3>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <th>Виробник</th>
                            <th>Модель</th>
                            <th>Ціна</th>
                            <th>Розмір</th>
                            <th>Кількість</th>
                            <th>Сторінка з товаром</th>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                @if($order->id == $item->order_id)
                                    @foreach($products as $product)
                                        @if($product->id == $item->product_id)
                                            <tr>
                                                <td>{{$product->manufacturer}}</td>
                                                <td>{{$product->model}}</td>
                                                <td> {{$product->price}} ₴</td>
                                                <td> {{$item->size}}</td>
                                                <td> {{$item->quantity}}</td>
                                                <td style="text-align: center; font-size: 20px"><a target="_blank"
                                                                                                   href="{{url('product/'. $product->id)}}">
                                                        <i class="fas fa-eye"></i> </a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
