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
                        <a class="activeprofile" href="{{route('changepassword')}}">
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
                    <h2 class="user_profile_h">Зміна пароля</h2>
                    <form method="post" action="{{route('changepasswordupdate')}}">
                        @csrf
                        <ul>
                            <li class="text-info">Діючий пароль :</li>
                            <li> <input id="updatepassword" type="password" class="" name="updatepassword" required>
                        </ul>
                        <ul>
                            <li class="text-info">Новий пароль :</li>
                            <li> <input id="newpassword" type="password" class="" name="newpassword" required>
                        </ul>
                        <ul>
                            <li class="text-info">Підтвердіть новий пароль :</li>
                            <li> <input id="confirmpassword" type="password" class="" name="confirmpassword" required>
                        </ul>
                        <input class="sub_profile" type="submit" value="Змінити пароль">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
