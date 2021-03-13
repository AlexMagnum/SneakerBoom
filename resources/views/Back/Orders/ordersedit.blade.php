@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Зміна статуса замовлення</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('orders.update', $order->id)}}" method="post">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Статус замовлення</label><br>
                            <select style="width: 50%;" name="order_status" class="ordersel" required id="order_status">
                                <option @if($order->status == "Нове замовлення") selected @endif>Нове замовлення</option>
                                <option @if($order->status == "Очікує оплати") selected @endif>Очікує оплати</option>
                                <option @if($order->status == "Відправлене") selected @endif>Відправлене</option>
                                <option @if($order->status == "Відмінене") selected @endif>Відмінене</option>
                                <option @if($order->status == "Завершене") selected @endif>Завершене</option>
                            </select>
                        </div>
                        <div class="form-group" id="TTN" style="display: none">
                            <label for="TTN">Номер накладної (ТТН): </label>
                            <input style="width: 50%;" type="text" class="form-control"  name="TTN" id="TTN_num"
                                   placeholder="Номер накладної" value="@if(isset($order->TTN)) {{$order->TTN}} @endif">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Оновити статус замовлення">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
