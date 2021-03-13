@extends('layouts.main')

@section('content')
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
    <div class="feel-fall">
        <div class="container">
            <div class="pull-left fal-box">
                <div class="fall-left">
                    <h3 class="ffont">{{$ui->cta1_header}}</h3>
                   <a href="{{$ui->cta1_url}}"> <img src="{{@asset($ui->cta1_image)}}" alt="/" class="img-responsive fl-img-wid"></a>
                    <p class="color_sub_text">{{$ui->cta1_desc}}</p>
                    <span class="fel-fal-bar"></span>
                </div>
            </div>
            <div class="pull-right fel-box">
                <div class="feel-right">
                    <h3 class="ffont">{{$ui->cta2_header}}</h3>
                    <a href="{{$ui->cta2_url}}"><img src="{{@asset($ui->cta2_image)}}" alt="/" class="img-responsive fl-img-wid"></a>
                    <p class="color_sub_text">{{$ui->cta2_desc}}</p>
                    <span class="fel-fal-bar2"></span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="shop-grid">
        <div class="container">
            @foreach($topProducts as $topProduct)
                <div class="col-md-4 grid-stn simpleCart_shelfItem">
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
                                        <p><a href="{{url('product/'.$topProduct->id)}}" class="item_add"><span
                                                    class="glyphicon glyphicon-shopping-cart grid-cart scred"
                                                    aria-hidden="true"></span> <span
                                                    class="item_price item_price_discount">{{$topProduct->price}} ₴</span></a>
                                        </p>
                                    </div>
                                @else
                                    <div class="pull-right styl-price">
                                        <p><a href="{{url('product/'.$topProduct->id)}}" class="item_add"><span
                                                    class="glyphicon glyphicon-shopping-cart grid-cart"
                                                    aria-hidden="true"></span> <span class=" item_price">{{$topProduct->price}} ₴</span></a></p>
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="quick-view">
                        <a href="{{url('product/'.$topProduct->id)}}"><img class="qview" src="{{url('images/view.png')}}"></a>
                    </div>
                </div>
            @endforeach
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="sub-news">
        <div class="container">
            <form action="{{route('addnewsletter')}}" method="get">
                <h3>Підпишись на новини та акції</h3>
                <input type="email" class="sub-email" placeholder="Email" id="newsletterform" name="email" required />
                <button type="submit" class="btn btn-default subs-btn">OK</button>
            </form>
        </div>
    </div>
@endsection
