@extends('layouts.main')

@section('content')
    <div class="reg-form">
        <div class="container mtop">
            <div class="reg sorder">
                <div class="col-lg-3">
                    <div class="user_sidebar">
                        <a  href="{{route('profile')}}"><span aria-hidden="true"
                                                                                   class="glyphicon glyphicon-user gir"></span>
                            Обліковий запис</a>
                        <a class="activeprofile" href="{{route('deliveryaddress')}}">
                            <span aria-hidden="true" class="glyphicon glyphicon-transfer gir"></span>
                            </i> Адреса доставки</a>
                        <a href="{{route('changepassword')}}">
                            <span aria-hidden="true" class="glyphicon glyphicon-lock gir"></span>
                            </i> Зміна пароля</a>
                        <a href="{{route('vieworders')}}">
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
                    @if(Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif
                    <h2 class="user_profile_h">Адреса доставки</h2>
                    <form method="post" action="{{route('deliveryaddressupdate')}}">
                        @csrf
                        <ul>
                            <li class="text-info">Область:</li>
                            <li><input id="profile_region" type="text" name="profile_region" value="{{Auth::user()->region }}"
                                       autocomplete="profile_region">
                        </ul>
                        <ul>
                            <li class="text-info">Місто (населений пункт):</li>
                            <li><input id="profile_city" type="text" name="profile_city" value="{{Auth::user()->city }}"
                                       autocomplete="profile_city">
                        </ul>
                        <ul>
                            <li class="text-info">№ Відділення:</li>
                            <li><input id="profile_num_dep" type="text" name="profile_num_dep" value="{{Auth::user()->number_department }}"
                                       autocomplete="profile_num_dep">
                        </ul>
                        <input class="sub_profile" type="submit" value="Оновити адресу">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
