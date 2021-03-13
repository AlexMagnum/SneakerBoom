@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><span aria-hidden="true" class="glyphicon glyphicon-exclamation-sign gir"></span>{{ __('Підтвердіть свою адресу електронної пошти') }}</div>
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('На вашу електронну адресу надіслано нове посилання для підтвердження.') }}
                            </div>
                        @endif

                        {{ __('Перш ніж продовжити, будь ласка, перевірте свою електронну пошту, щоб знайти посилання для підтвердження.') }}
                        {{ __('Якщо ви не отримали повідомлення на електронну пошту, натисніть на кнопку "Надіслати запит повторно"!') }}
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <div class="ba_wrap"><button type="submit" class="btn btn-link p-0 m-0 align-baseline accept_verify">{{ __('Надіслати запит повторно') }}</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

