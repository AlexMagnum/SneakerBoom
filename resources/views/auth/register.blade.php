@extends('layouts.main')
@section('content')
    <div class="reg-form">
        <div class="container">
            <div class="reg">
                <h3>Реєстрація</h3>
                <p>Ласкаво просимо, будь ласка, введіть наступні дані, щоб продовжити.</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <ul>
                        <li class="text-info">Логін*: </li>
                        <li> <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <br><strong>{{ $message }}</strong>
                                    </span>
                            @enderror</li>
                    </ul>
                    <ul>
                        <li class="text-info">E-Mail*: </li>
                        <li> <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                       <br> <strong>{{ $message }}</strong>
                                    </span>
                            @enderror</li>
                    </ul>
                    <ul>
                        <li class="text-info">Пароль*: </li>
                        <li><input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <br><strong>{{ $message }}</strong>
                                    </span>
                        @enderror</li>
                    </ul>
                    <ul>
                        <li class="text-info">Підтвердіть пароль*:</li>
                        <li><input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"></li>
                    </ul>
                    <input type="submit" value="Зареєструватися">
                    <p class="click">Натискаючи цю кнопку, Ви погоджуєтесь з нашими <a href="{{route('privacy')}}">правилами.</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection



