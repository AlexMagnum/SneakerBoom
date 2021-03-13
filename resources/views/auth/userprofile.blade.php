@extends('layouts.main')

@section('content')
    <div class="reg-form">
        <div class="container mtop">
            <div class="reg sorder">
                <div class="col-lg-3">
                    <div class="user_sidebar">
                        <a class="activeprofile" href="{{route('profile')}}"><span aria-hidden="true"
                                                                                   class="glyphicon glyphicon-user gir"></span>
                            Обліковий запис</a>
                        <a href="{{route('deliveryaddress')}}">
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
                    <h2 class="user_profile_h">Інформація про користувача</h2>
                    <form method="post" action="{{route('profileupdate')}}">
                        @csrf
                        <ul>
                            <li class="text-info">Логін:</li>
                            <li><input id="profile_login" type="text" name="profile_login" value="{{Auth::user()->name }}"
                                        autocomplete="profile_login" readonly>
                        </ul>
                        <ul>
                            <li class="text-info">Електронна пошта:</li>
                            <li><input id="profile_email" type="text" name="profile_email" value="{{Auth::user()->email }}"
                                        autocomplete="profile_email" readonly>
                        </ul>
                        <ul>
                            <li class="text-info">Прізвище, ім'я, по-батькові:</li>
                            <li><input id="profile_name" type="text" name="profile_name" value="{{Auth::user()->pip }}"
                                        autocomplete="profile_name">
                        </ul>
                        <ul>
                            <li class="text-info">Телефон:</li>
                            <li><input id="profile_phone" type="text" name="profile_phone" value="{{Auth::user()->phone }}"
                                        autocomplete="profile_phone">
                        </ul>
                        <ul>
                            <li class="text-info">Дата народження:</li>
                            <div class="form-group">
                                <input type="date" class="dtp" name="profile_birthdate"
                                @if(Auth::user()->birthdate !== NULL)
                                       value="{{date("Y-d-m", strtotime(Auth::user()->birthdate )) }}"
                                    @endif
                                    >
                            </div>
                        </ul>

                        <input class="sub_profile" type="submit" value="Оновити інформацію">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
