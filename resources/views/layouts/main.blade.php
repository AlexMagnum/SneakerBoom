<?php

use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Ui;
use App\Models\Product;

$categories = Category::all();
$ui = Ui::first();
$slides = Product::where('slider', 1)->where('count', '>', 0)->get();
?>
    <!DOCTYPE html>
<html lang="ru">
<head>
    <title>Sneakerboom | Інтернет магазин сучасного взуття</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords"
          content="Sneaker boom"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <meta charset="utf-8">
    <!--fonts-->
    <link href='//fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
    <!--fonts-->
    <!--bootstrap-->
    <link href="{{ @asset('css/form.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ @asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <!--coustom css-->
    <link href="{{ @asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!--shop-kart-js-->
    <script src="{{ @asset('js/simpleCart.min.js') }}"></script>
    <!--default-js-->
    <script src="{{ @asset('js/jquery-2.1.4.min.js') }}"></script>
    <!--bootstrap-js-->
    <script src="{{ @asset('js/bootstrap.min.js') }}"></script>
    <!--script-->
    <script src="{{ @asset('js/imagezoom.js') }}"></script>
    <script defer src="{{ @asset('js/jquery.flexslider.js') }}"></script>
    <link rel="stylesheet" href="{{ @asset('css/flexslider.css') }}" type="text/css" media="screen"/>
    <script>
        // Can also be used with $(document).ready()
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>
</head>
<body>
<div class="header">
    <div class="container">
        <div class="header-top">
            <div class="logo">
                <a href="/"> <img class="img-responsive fl-img-wid logoimg" src="{{url('images/logo.png')}}"></a>
            </div>
            <div class="login-bars">
                @if(!Auth::check())
                    <a class="btn btn-default log-bar" href="{{ url('/register') }}" role="button">Реєстрація</a>
                    <a class="btn btn-default log-bar" href="{{ url('/login') }}" role="button">Вхід</a>
                @else
                    <a href="{{route('profile')}}">
                        <img class="user_icon" src="{{@asset('images/user.png')}}">
                        <span class="username">{{ Auth::user()->name}}</span>
                    </a>
                @endif
                <div class="cart box_1">
                    <a href="{{route('shoppingcart')}}">
                        <div class="total">
                            <img class="cart_img" src="{{url('images/cart.png')}}">
                            <div class="cart_count">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</div>
                        </div>
                        <div class="total">
                            <a href="{{url('product/filter/')}}"><img class="search_icon"
                                                                      src="{{url('images/search.png')}}"></a>
                        </div>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!---menu-----bar--->
        <div class="header-botom">
            <div class="content white">
                <nav class="navbar navbar-default nav-menu" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <!--/.navbar-header-->

                    <div class="collapse navbar-collapse collapse-pdng" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav nav-font">
                            @foreach($categories as $category)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$category->name}}<b
                                            class="caret"></b></a>
                                    <ul class="dropdown-menu multi-column columns-3">
                                        <div class="row">
                                            <div class="col-sm-4 menu-img-pad">
                                                <ul class="multi-column-dropdown">
                                                    @foreach($category->subcategory as $subcategory)
                                                        <li>
                                                            <a href="{{url('category/'.$category->id.'/'.$subcategory->id)}}"> {{$subcategory->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @if($category->name == "Чоловікам")
                                                <div class="col-sm-4 menu-img-pad">
                                                    <a href="#"><img src="{{url('images/menu1.jpg')}}" alt="/"
                                                                     class="img-rsponsive men-img-wid"/></a>
                                                </div>
                                                <div class="col-sm-4 menu-img-pad">
                                                    <a href="#"><img src="{{url('images/menu2.jpg')}}" alt="/"
                                                                     class="img-rsponsive men-img-wid"/></a>
                                                </div>
                                            @elseif($category->name == "Жінкам")
                                                <div class="col-sm-4 menu-img-pad">
                                                    <a href="#"><img src="{{url('images/menu3.jpg')}}" alt="/"
                                                                     class="img-rsponsive men-img-wid"/></a>
                                                </div>
                                                <div class="col-sm-4 menu-img-pad">
                                                    <a href="#"><img src="{{url('images/menu4.jpg')}}" alt="/"
                                                                     class="img-rsponsive men-img-wid"/></a>
                                                </div>
                                            @elseif($category->name == "Дітям")
                                                <div class="col-sm-4 menu-img-pad">
                                                    <a href="#"><img src="{{url('images/menu5.jpg')}}" alt="/"
                                                                     class="img-rsponsive men-img-wid"/></a>
                                                </div>
                                                <div class="col-sm-4 menu-img-pad">
                                                    <a href="#"><img src="{{url('images/menu6.jpg')}}" alt="/"
                                                                     class="img-rsponsive men-img-wid"/></a>
                                                </div>
                                            @endif

                                        </div>
                                    </ul>
                                </li>
                            @endforeach
                            <li><a href="{{ url('/contact') }}">Контакти</a></li>
                            <div class="clearfix"></div>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!--/.navbar-collapse-->
                    <div class="clearfix"></div>
                </nav>
                <!--/.navbar-->
                <div class="clearfix"></div>
            </div>
            <!--/.content--->
        </div>
        <!--header-bottom-->
    </div>
</div>
@if(url()->current() == url('/'))
    <div class="header-end">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @for($i=0; $i < count($slides); $i++)
                        @if($i == 0)
                            <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                        @else
                            <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                        @endif
                    @endfor
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($slides as $pos => $slide)
                        @if($pos == 0)
                            @if($slide->poster == "")
                                <div class="item active">
                                    <img src="{{url("./images/no image slider.jpg")}}" alt="...">
                                    <div class="carousel-caption car-re-posn">
                                        <h3>{{$slide->model}}</h3>
                                        <h4 class="sile_capt">Товар відсутній</h4>
                                        <span class="color-bar"></span>
                                    </div>
                                </div>

                            @else
                                <div class="item active">
                                    <a href="{{route('single', $slide->id)}}"> <img src="{{url($slide->poster)}}" alt="..."></a>
                                    <div class="carousel-caption car-re-posn">
                                        <h3>{{$slide->model}}</h3>
                                        <h4 class="sile_capt">{{$slide->slider_slog}}</h4>
                                        <span class="color-bar"></span>
                                    </div>
                                </div>
                            @endif
                        @else
                            @if($slide->poster == "")
                                <div class="item">
                                    <img src="{{url("./images/no image slider.jpg")}}" alt="...">
                                    <div class="carousel-caption car-re-posn">
                                        <h3>{{$slide->model}}</h3>
                                        <h4 class="sile_capt">Товар відсутній</h4>
                                        <span class="color-bar"></span>
                                    </div>
                                </div>
                            @else
                                <div class="item">
                                    <a href="{{route('single', $slide->id)}}"> <img src="{{url($slide->poster)}}" alt="..."></a>
                                    <div class="carousel-caption car-re-posn">
                                        <h3>{{$slide->model}}</h3>
                                        <h4 class="sile_capt">{{$slide->slider_slog}}</h4>
                                        <span class="color-bar"></span>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left car-icn" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right car-icn" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endif
@yield('content')
<div class="footer-grid">
    <div class="container">
        <div class="col-md-2 col-sm-4 re-ft-grd">
            <h3>Категорії</h3>
            <ul class="categories">
                @foreach($categories as $category)
                    <li><a href="{{url('category/'.$category->id)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-2 col-sm-4 re-ft-grd">
            <h3>Інформація</h3>
            <ul class="shot-links">
                <li><a href="{{route('contact')}}">Контакти</a></li>
                <li><a href="{{route('privacy')}}">Політика конфіденційності</a></li>
                <li><a href="{{route('aboutus')}}">Про нас</a></li>
                <li><a href="{{route('faq')}}">FAQ</a></li>
                <li><a href="{{route('payment')}}">Оплата</a></li>
                <li><a href="{{route('delivery')}}">Доставка</a></li>
            </ul>
        </div>
        <div class="col-md-6 col-sm-4 re-ft-grd">
            <h3>Ми в соціальних мережах</h3>
            <ul class="social">
                @if(isset($ui->social1))
                    <li><a target="_blank" href="{{$ui->social1}}" class="fb"><img class="img-responsive fl-img-wid soc"
                                                                                   src="{{ url('images/fb.png') }}"></a>
                    </li>
                @endif
                @if(isset($ui->social2))
                    <li><a target="_blank" href="{{$ui->social2}}" class="twt"><img
                                class="img-responsive fl-img-wid soc"
                                src="{{ url('images/tw.png') }}"></a>
                    </li>
                @endif
                @if(isset($ui->social3))
                    <li><a target="_blank" href="{{$ui->social3}}" class="gpls"><img
                                class="img-responsive fl-img-wid soc"
                                src="{{ url('images/y.png') }}"></a>
                    </li>
                @endif
                @if(isset($ui->social4))
                    <li><a target="_blank" href="{{$ui->social4}}" class="inst"><img
                                class="img-responsive fl-img-wid soc"
                                src="{{ url('images/inst.png') }}"></a></li>
                @endif
                <div class="clearfix"></div>
            </ul>
        </div>
        <div class="col-md-2 col-sm-0 re-ft-grd">
            <div class="bt-logo">
                <div class="logo">
                    <a href="{{ url('/') }}" class="ft-log"><img class="img-responsive fl-img-wid"
                                                                 src="{{ url('images/logo.png') }}"></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="copy-rt">
        <div class="container">
            <p>&copy; 2021 SNEAKER BOOM</p>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/61f4a2ee85.js" crossorigin="anonymous"></script>
</body>
</html>
