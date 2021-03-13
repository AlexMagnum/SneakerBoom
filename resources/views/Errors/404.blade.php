@extends('layouts.main')

@section('content')
    <div class="container">
        <h2 class="error404">Сторінку за Вашим запитом не знайдено...</h2>
        <div class="row">
            <div class="col-lg-12">
               <img src="{{asset('images/404.jpg')}}" alt="404" class="img-responsive">
            </div>
        </div>
        <h2 class="error404">Повернутися на <a href="{{route('home')}}">Головну</a></h2>
    </div>

@endsection
