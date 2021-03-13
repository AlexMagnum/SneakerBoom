@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span class="glyphicon glyphicon-refresh gir" aria-hidden="true"></span>{{ __('Скинути пароль') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row" style="margin-top: 50px;">
                            <label for="email" class="pull-left col-md-12 col-form-label text-md-right">{{ __('E-Mail вказаний при реєстрації: ') }}</label>
                            <div class="col-md-12 col-sm-12 col-xs-12"">
                                <input id="email" type="email" class="pull-left em_reset @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                       <br><br> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0" style="margin-bottom: 75px;">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline accept_verify pull-left">
                                    {{ __('Надіслати посилання для скидання пароля') }}
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
