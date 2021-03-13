@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><span class="glyphicon glyphicon-refresh gir" aria-hidden="true"></span>{{ __('Скинути пароль') }}</div>

                    <div class="card-body" style="margin-top: 50px">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail адреса') }}</label>

                                <div class="col-md-4">
                                    <input id="email" type="email" class="em_reset @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Новий пароль') }}</label>

                                <div class="col-md-4">
                                    <input id="password" type="password" class="em_reset @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Підтвердіть пароль') }}</label>

                                <div class="col-md-4">
                                    <input id="password-confirm" type="password" class="em_reset" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 75px">
                                <div class="col-md-offset-2 col-md-4">
                                    <button type="submit" class="btn_reset">
                                        {{ __('Зберегти новий пароль') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

