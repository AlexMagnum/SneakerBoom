@extends('layouts.main')
@section('content')
    <div class="login">
        <div class="container">
            <div class="login-grids">
                <div class="col-md-6 log">
                    <h3>Вхід</h3>
                    <div class="strip"></div>
                    <p>Ласкаво просимо, будь ласка, введіть дані, щоб продовжити.</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h5>E-Mail:</h5>
                        <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                       <br> <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <h5>Пароль:</h5>
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <br><strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Запам\'ятати') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Вхід">
                    </form>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Забули пароль?') }}
                        </a>
                    @endif
                </div>
                <div class="col-md-6 login-right">
                    <h3>Реєстрація</h3>
                    <div class="strip"></div>
                    <p>Створивши обліковий запис у нашому магазині, ви зможете пришвидшити процес оформлення замовлення, зберегти свою контактну інформацію, переглянути та відстежити свої замовлення у своєму обліковому записі. </p>
                    <a href="{{route('register')}}" class="button">Реєстрація</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection



