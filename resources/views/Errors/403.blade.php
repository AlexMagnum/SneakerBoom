@extends('layouts.main')

@section('content')
    <div class="container">
        <h2 class="error404">У Вас недостатньо прав для доступу до даної сторінки!</h2>
        <div class="row">
            <div class="col-lg-12">
                <img src="{{asset('images/403.jpg')}}" alt="404" class="img-responsive">
            </div>
        </div>
    </div>
@endsection
