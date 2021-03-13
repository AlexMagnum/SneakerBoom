@extends('layouts.main')

@section('content')
    <script>
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>
    @if(session()->has('alert-abort'))
        <div class="alert alert-warning" style="width: 50%; margin: auto">
            {{ session()->get('alert-abort') }}
        </div>
    @endif
    @if(session()->has('alert-success'))
        <div class="alert alert-success" style="width: 50%; margin: auto">
            {{ session()->get('alert-success') }}
        </div>
    @endif
    <div class="showcase-grid">
        <div class="container">
            <div class="col-md-8 showcase">
                <div class="flexslider">
                    <ul class="slides">
                        @if(count($images) > 0)
                            @foreach($images as $image)
                                <li data-thumb="{{ url($image) }}">
                                    <div class="thumb-image"><img src="{{ url($image) }}" data-imagezoom="true"
                                                                  class="img-responsive"></div>
                            @endforeach
                        @else
                            @for($i = 1; $i <=4; $i++)
                                <li data-thumb="{{ url('images/no image product.jpg') }}">
                                    <div class="thumb-image"><img src="{{ url('images/no image product.jpg') }}"
                                                                  data-imagezoom="true"
                                                                  class="img-responsive"></div>
                            @endfor
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-md-4 showcase">
                <div class="showcase-rt-top">
                    <div class="pull-left shoe-name">
                        <h3>{{$product->manufacturer}} {{$product->model}}</h3>
                        <p></p>
                        @if($product->discount > 0 &&  $product->discount < 100)
                            <h4 class="discount_price">{{$product->price_without_discount}} ₴</h4>
                            <h4 class="item_price_discount">{{$product->price}} ₴</h4>
                        @else
                            <h4>{{$product->price}} ₴</h4>
                        @endif
                    </div>
                    <div class="pull-left rating-stars">
                        @if($raiting != null)
                            @php $rating = $raiting; @endphp

                            @foreach(range(1,5) as $i)
                                <span class="fa-stack" style="width:1em">
                    <i class="far fa-star fa-stack-1x"></i>

                    @if($rating >0)
                                        @if($rating >0.5)
                                            <span style="color: #fb4c29;"> <i
                                                    class="fas fa-star fa-stack-1x"></i></span>
                                        @else
                                            <span style="color: #fb4c29;">  <i
                                                    class="fas fa-star-half fa-stack-1x"></i></span>
                                        @endif
                                    @endif
                                    @php $rating--; @endphp
                </span>
                            @endforeach
                        @else
                            <span class="fa-stack" style="width:1em">  <i
                                    class="far fa-star fa-stack-1x"></i></span>
                            <span class="fa-stack" style="width:1em">  <i
                                    class="far fa-star fa-stack-1x"></i></span>
                            <span class="fa-stack" style="width:1em">  <i
                                    class="far fa-star fa-stack-1x"></i></span>
                            <span class="fa-stack" style="width:1em">  <i
                                    class="far fa-star fa-stack-1x"></i></span>
                            <span class="fa-stack" style="width:1em">  <i
                                    class="far fa-star fa-stack-1x"></i></span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
                <hr class="featurette-divider">
                <form action="{{route('addtocart',['id'=> $product->id])}}" method="get">
                    <div class="shocase-rt-bot">
                        <div class="float-qty-chart">
                            <ul>
                                <li class="qty">
                                    <h3 class="second_color">Розмір</h3>
                                    <select class="form-control siz-chrt" name="product_size[]">
                                        @if(isset($sizearr))
                                            @foreach($sizearr as $size)
                                                <option>{{$size}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </li>
                                <li class="qty">
                                    <h4 class="second_color">Кількість</h4>
                                    <select class="form-control qnty-chrt" name="product_count[]">
                                        @for($i =1; $i <= $productCount->count; $i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <ul>
                            <li class="ad-2-crt simpleCart_shelfItem">
                                <input class="btn add_product" type="submit" value="Додати в корзину">
                            </li>
                        </ul>
                    </div>
                </form>
                <div class="showcase-last">
                    <h3>Характеристики</h3>
                    <ul>
                        <li><span class="characteristics_h">Код товару: </span>
                            <span class="characteristics_p second_color">{{$product->code}}</span></li>
                        <li><span class="characteristics_h ">Бренд: </span>
                            <span class="characteristics_p second_color">{{$product->manufacturer}}</span></li>
                        <li><span class="characteristics_h">Модель: </span><span
                                class="characteristics_p second_color">{{$product->model}}</span></li>
                        <li><span class="characteristics_h">Розіміри в наявності: </span><span
                                class="characteristics_ p second_color">
                              @if(isset($sizearr))
                                    @foreach($sizearr as $size)
                                        {{$size}}
                                    @endforeach
                                @endif
                            </span></li>
                        <li><span class="characteristics_h">Колір: </span>
                            <span class="characteristics_p second_color">{{$product->color}}</span></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="specifications">
        <div class="container">
            <h3>Детальна інформація</h3>
            <div class="detai-tabs">
                <!-- Nav tabs -->
                <ul class="nav nav-pills tab-nike" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                              data-toggle="tab">Основне</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Опис
                            товару</a>
                    </li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Відгуки</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active second_color" id="home">
                        <p>{!! $product->highlights !!}
                        </p>
                    </div>
                    <div role="tabpanel" class="tab-pane second_color" id="profile">
                        <p>{!!$product->description!!}</p>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <div class="raiting_respond">
                                <form action="{{route('productraiting', $product->id)}}" method="get">
                                    <input type="radio" name="raiting[]" value="1" class="raiting_check"/>
                                    <span class="fa-stack ml" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <br>

                                    <input type="radio" name="raiting[]" value="2"/>
                                    <span class="fa-stack ml" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <br>

                                    <input type="radio" name="raiting[]" value="3"/>
                                    <span class="fa-stack ml" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <br>

                                    <input type="radio" name="raiting[]" value="4"/>
                                    <span class="fa-stack ml" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <i
                                            class="far fa-star fa-stack-1x"></i></span>
                                    <br>

                                    <input type="radio" name="raiting[]" value="5"/>
                                    <span class="fa-stack ml" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <span class="fa-stack" style="width:1em">  <span style="color: #fb4c29;"> <i
                                                class="fas fa-star fa-stack-1x"></i></span>  </span>
                                    <br>
                                    <input class="btn btn-primary btn_raiting" type="submit" value="ОЦІНИТИ"/>
                                </form>
                            </div>
                        @endif
                        <div class="respond">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="you-might-like">
        <div class="container">
            <h3 class="you-might">Товари, які можуть вам сподобатися</h3>
            @if(isset($maylikeproduct))
                @foreach($maylikeproduct as $topProduct)
                    <div class="col-md-4 grid-stn nomargin simpleCart_shelfItem">
                        @if($topProduct->discount > 0 && $topProduct->discount < 100)
                            <div class="sale">
                                <span class="sale_value">-{{$topProduct->discount }}%</span>
                            </div>
                        @endif
                        <div class="ih-item square effect3 bottom_to_top">
                            <div class="bottom-2-top">
                                @if(explode(PHP_EOL, $topProduct->images)[0] == "")
                                    <div class="img"><img src="{{url('images/no image grid.jpg')}}" alt="/"
                                                          class="img-responsive gri-wid"></div>
                                @else
                                    <div class="img"><img src="{{url(explode(PHP_EOL, $topProduct->images)[0])}}" alt="/"
                                                          class="img-responsive gri-wid"></div>
                                @endif
                                <div class="info">
                                    <div class="pull-left styl-hdn">
                                        <h3>{{$topProduct->manufacturer}} {{$topProduct->model}}</h3>
                                    </div>
                                    @if($topProduct->discount > 0 && $topProduct->discount < 100)
                                        <div class="pull-right styl-price">
                                            <p><span class="item_price discount_price">{{$topProduct->price_without_discount}} ₴</span>
                                            </p>
                                            <p><a href="#" class="item_add"><span
                                                        class="glyphicon glyphicon-shopping-cart grid-cart scred"
                                                        aria-hidden="true"></span> <span
                                                        class="item_price item_price_discount">{{$topProduct->price}} ₴</span></a>
                                            </p>
                                        </div>
                                    @else
                                        <div class="pull-right styl-price">
                                            <p><a href="#" class="item_add"><span
                                                        class="glyphicon glyphicon-shopping-cart grid-cart"
                                                        aria-hidden="true"></span> <span class=" item_price">{{$topProduct->price}} ₴</span></a>
                                            </p>
                                        </div>
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="quick-view">
                            <a href="{{url('product/'.$topProduct->id)}}"><img class="qview"
                                                                               src="{{url('images/view.png')}}"></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
