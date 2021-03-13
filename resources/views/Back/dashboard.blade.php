@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{count($products)}}</h3>

                            <p>Товарів на сайті</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('goods.view')}}" class="small-box-footer">До товарів <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{count($orders)}}</h3>

                            <p>Замовлень</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('orders.view')}}" class="small-box-footer">До замовлень <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{count($users)}}</h3>

                            <p>Зареєстрованих користувачів</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('users.view')}}" class="small-box-footer">До користувачів <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{count($contacts)}}</h3>

                            <p>Запитань від користувачів</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-question"></i>
                        </div>
                        <a href="{{route('contacts.view')}}" class="small-box-footer">До запитань <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1 pr"></i>
                                Статус замовлень
                            </h3>

                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div><!-- /.card-body -->
                    </div>


                </section>
                <section class="col-lg-5 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Останні додані товари</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach($latestGoods as $product)
                                    <li class="item">
                                        <div class="product-img">
                                            @if(explode(PHP_EOL, $product->images)[0] == "")
                                                <img src="dist/img/default-150x150.png" alt="Product Image"
                                                     class="img-size-50">
                                                @else
                                                <img src="{{url(explode(PHP_EOL, $product->images)[0])}}" alt="Product Image"
                                                     class="img-size-50">
                                                @endif
                                        </div>
                                        <div class="product-info">
                                            <a href="{{route('goods.show', $product->id)}}"
                                               class="product-title">{{$product->model}}
                                                <span
                                                    class="badge badge-warning float-right">{{$product->price}} ₴</span></a>
                                            <span class="product-description">
                        {{$product->manufacturer}}
                      </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Останні замовлення</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>№ замовлення</th>
                                        <th>Сума</th>
                                        <th>ID Користувача</th>
                                        <th>Статус</th>
                                        <th>Спосіб оплати</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latestOrders as $order)
                                        <tr>
                                            <td><a href="{{route('orders.show', $order->id)}}">{{$order->id}}</a></td>
                                            <td>{{$order->total_cost}} ₴</td>
                                            <td>
                                                @if(isset($order->user_id))
                                                    <a href="{{route('users.show', $order->user_id)}}">{{ $order->user_id}}</a>
                                                @else
                                                    Замовлення без облікового запису
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->status == "Нове замовлення")
                                                    <span class="badge badge-primary">Нове замовлення</span>
                                            @elseif($order->status == "Очікує оплати")
                                                <span class="badge badge-warning">Очікує оплати</span>
                                            @elseif($order->status == "Відправлене")
                                                <span class="badge badge-success">Відправлене</span>
                                            @elseif($order->status == "Відмінене")
                                                    <span class="badge badge-danger">Відмінене</span>
                                            @elseif($order->status == "Завершене")
                                                    <span class="badge badge-info">Завершене</span>
                                            @endif
                                            </td>
                                            <td>
                                              {{$order->paymentsystem}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </section>

            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
