@extends('layouts.main')
@section('content')
    <div class="check">

        <div class="container">
            <div class="col-md-3 cart-total">
                <a class="continue" href="{{route('products')}}">Продовжити покупки</a>
                <div class="price-details">
                    <h3>Розрахунок</h3>
                    @if(isset($products) && count($products) > 0)
                        <?php $countProduct = 1;?>
                        @foreach($products as $product)
                            <span>Разом за {{$countProduct}}-ий  товар: {{$product['price']}} ₴</span><br>
                            <?php $countProduct++; ?>
                        @endforeach
                    @endif
                    <div class="clearfix"></div>
                </div>
                <hr class="featurette-divider">
                <ul class="total_price">
                    <li class="last_price"><h4 class="lp">ДО СПЛАТИ</h4></li>
                    @if(isset($totalPrice))
                        <li class="last_price"><span>{{$totalPrice}} ₴</span></li>
                    @else
                        <li class="last_price"><span>0 ₴</span></li>
                    @endif
                    <div class="clearfix"></div>
                </ul>
                <div class="clearfix"></div>
                <a class="order" href="{{route('order')}}">Оформити замовлення</a>
            </div>
            <div class="col-md-9 cart-items">
                @if(Session::has('cart'))
                    <h1>Корзина ({{Session::has('cart') ? Session::get('cart')->totalQty : ''}})</h1>
                    @foreach($products as $product)
                        <div class="cart-header">
                            <div class="close1"><a href="{{route('removeall',['id' => $product['item']['id']])}}"><span
                                        class="glyphicon glyphicon-remove rem" aria-hidden="true"></span></a></div>
                            <div class="cart-sec simpleCart_shelfItem">
                                @if($product['item']['discount'] > 0 && $product['item']['discount'] )
                                    <div class="sale">
                                        <span class="sale_value">-{{$product['item']['discount'] }}%</span>
                                    </div>
                                @endif
                                <div class="cart-item cyc">
                                    <?php $productId = \App\Models\Product::find($product['item']['id'])?>
                                    <img src="{{url(explode(PHP_EOL,$productId->images)[0])}}" class="img-responsive"
                                         alt=""/>
                                </div>
                                <div class="cart-item-info">
                                    <ul class="qty">
                                        <li><p>Розмір: {{$product['size']}}</p></li>
                                        <li><p>Кількість: {{$product['qty']}}</p></li>
                                        <li><p>Ціна товару: {{$product['item']['price']}} ₴</p>
                                        </li>
                                    </ul>
                                    <div class="delivery">
                                        <p>
                                            <a href="{{route('increseitems',['id'=> $product['item']['id']])}}"
                                               class="item-add"><span class="glyphicon glyphicon-plus"
                                                                      aria-hidden="true"></span></a>
                                            <a href="{{route('reduceone',['id' => $product['item']['id']])}}"
                                               class="item-reduce"><span class="glyphicon glyphicon-minus gminus"
                                                                         aria-hidden="true"></span></a>
                                        </p>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                    <a class="clear_cart" href="{{route('clearcart')}}"><span class="glyphicon glyphicon-trash gir"
                                                                              aria-hidden="true"></span>Очистити корзину</a>
                @else
                    <div class="noitems"><h2>Ваш кошик порожній</h2>
                        <p>Подивіться наші актуальні пропозиції. Ми впевнені, Ви знайдете щось цікаве!</p></div>
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
