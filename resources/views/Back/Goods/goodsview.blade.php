@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Картка товару</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td><a href="#" class="btn btn-danger" onclick="event.preventDefault();
                        document.getElementById('delete-form').submit();"><i class="fas fa-trash"></i>
                                    Видалити товар</a></td>
                                <td>
                                    <a href="{{route('goods.edit', $product->id)}}" class="btn btn-info"><i class="fas fa-edit"></i>
                                        Редагувати товар</a>
                                    <a target="_blank" href="{{route('single', $product->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i>
                                    Переглянути товар на сайті</a>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Категорія товару:</b></td>
                                <td>
                                    {{$category->name}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Підкатегорія товару:</b></td>
                                <td>
                                    @foreach($subcategory as $sub)
                                        {{$sub->name}} <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td><b>Id товару:</b></td>
                                <td>
                                    {{$product->id}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Виробник:</b></td>
                                <td>
                                    {{$product->manufacturer}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Модель:</b></td>
                                <td>
                                    {{$product->model}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Код:</b></td>
                                <td>
                                    {{$product->code}}
                                </td>
                            </tr>
                            <tr>
                                <td><b>Ціна:</b></td>
                                <td>
                                    {{$product->price}} ₴
                                </td>
                            </tr>
                            @if(isset($product->discount))
                                <tr>
                                    <td><b>Скидка:</b></td>
                                    <td>
                                        {{$product->discount}}
                                    </td>
                                </tr>
                            @endif
                            @if(isset($product->price_without_discount))
                                <tr>
                                    <td><b>Ціна без скидки:</b></td>
                                    <td>
                                        {{$product->price_without_discount}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Кількість на складі:</b></td>
                                <td>
                                    {{$product->count}}
                                </td>
                            </tr>
                            @if(isset($product->sale_count))
                                <tr>
                                    <td><b>Кількість продаж:</b></td>
                                    <td>
                                        {{$product->sale_count}}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Колір:</b></td>
                                <td>
                                    {{$product->color}}
                                </td>
                            </tr>
                            @if(isset($product->description))
                                <tr>
                                    <td><b>Детальна інформація:</b></td>
                                    <td>
                                        {!!$product->description!!}
                                    </td>
                                </tr>
                            @endif
                            @if(isset($product->highlights))
                                <tr>
                                    <td><b>Основне про товар:</b></td>
                                    <td>
                                        {!! $product->highlights !!}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><b>Зображення товару:</b></td>
                                <td>
                                    <div class="col-12">
                                        <div class="card card-primary">
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($productImages as $image)
                                                        <div class="col-sm-2">
                                                            <a href="{{@asset($image)}}"
                                                               data-toggle="lightbox"
                                                               data-gallery="gallery">
                                                                <img src="{{@asset($image)}}"
                                                                     class="img-fluid mb-2" alt="white sample"/>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @if($product->slider == 1)
                                <tr>
                                    <td><b>Товар в слайдері на головній:</b></td>
                                    <td>
                                        Так
                                    </td>
                                </tr>
                            @endif
                            @if($product->slider == 1 && isset($posterImage))
                                <tr>
                                    <td><b>Зображення у слайдері:</b></td>
                                    <td>
                                        <img src="{{@asset($posterImage[0])}}"
                                             style="height: 250px"/>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td><b>Зображення у слайдері:</b></td>
                                    <td>
                                        <img src="{{@asset('images/no image.jpg')}}"
                                             style="height: 250px"/>
                                    </td>
                                </tr>
                            @endif
                            @if($product->slider == 1 &&  isset($product->slider_slog))
                                <tr>
                                    <td><b>Заголовок слайда:</b></td>
                                    <td>
                                        {{$product->slider_slog}}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="{{route('goods.delete', $product->id)}}" method="POST" id="delete-form" style="display:none">
        @csrf
        @method("DELETE")
    </form>
@endsection

