@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Новий товар</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{route('goods.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Категорія товару</label>
                                <select class="select2" style="width: 100%;" name="category" required>
                                    @if(count($category) > 0)
                                        @foreach($category as $cat)
                                            @if($cat->name == $categoryId->name)
                                                <option selected>{{$cat->name}}</option>
                                            @else
                                                <option>{{$cat->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Підкатегорія товару</label>
                                <div class="select2-purple">
                                    <select class="select2" multiple="multiple" data-placeholder="Виберіть підкатегорію"
                                            data-dropdown-css-class="select2-purple" style="width: 100%;"
                                            name="subcategory[]" required>
                                        @if(count($subcategory) > 0)
                                            @foreach($subcategory as $sub)
                                                <option
                                                    @if($subcategoryId->contains('name', $sub->name)) selected @endif>
                                                    {{$sub->name}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group" style="margin-top: 20px">
                                    <label for="manufacturer">Виробник*</label>
                                    <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                                           placeholder="Назва виробника" required value="{{$product->manufacturer}}">
                                </div>
                                <div class="form-group">
                                    <label for="model">Модель*</label>
                                    <input type="text" class="form-control" id="model" name="model"
                                           placeholder="Назва моделі" required value="{{$product->model}}">
                                </div>
                                <div class="form-group">
                                    <label for="code">Код товару*</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                           placeholder="Код товару (артикул)" required value="{{$product->code}}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Ціна*</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                           placeholder="Ціна товару" required value="{{$product->price}}">
                                </div>
                                <div class="form-group">
                                    <label for="count">Кількість одиниць на складі*</label>
                                    <input type="text" class="form-control" id="count" name="count"
                                           placeholder="Кількість товару" required value="{{$product->count}}">
                                </div>
                                <div class="form-group">
                                    <label for="discount">Знижка</label>
                                    <input type="text" class="form-control" id="discount" name="discount"
                                           placeholder="Знижка (1-99)%"
                                           value="@if(isset($product->discount)){{$product->discount}}@endif">
                                </div>
                                <div class="form-group">
                                    <label for="color">Колір*</label>
                                    <input type="text" class="form-control" id="color" name="color"
                                           placeholder="Колір товару" required value="{{$product->color}}">
                                </div>
                                <div class="form-group">
                                    <label>Розміри товару*:</label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple"
                                                data-placeholder="Вкажіть доступні розміри"
                                                data-dropdown-css-class="select2-purple" style="width: 100%;"
                                                name="size[]" required>
                                            @if(count($size) > 0)
                                                @foreach($size as $s)
                                                    <option
                                                        @if($sizeId->contains('name', $s->name)) selected @endif>
                                                        {{$s->name}}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top: 20px">
                                        <label for="images">Картинки товару*</label>
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
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="images" name="images[]"
                                                       multiple>
                                                <label class="custom-file-label" for="images">Виберіть файли
                                                    (1-4)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="checkbox" id="slider" name="slider" @if($product->slider == 1)
                                            checked @endif >
                                        <label for="slider" class="slider">
                                            Додати товар у слайдер на головній
                                        </label>
                                    </div>
                                    <div class="form-group" id="slider_img">
                                        <label for="images">Зображення у слайдер</label>
                                        @if(isset($posterImage))
                                            <img src="{{@asset($posterImage[0])}}"
                                                 style="height: 150px; margin-bottom: 15px"/>
                                            @else
                                            <img src="{{@asset('images/no image.jpg')}}"
                                                 style="height: 250px"/>
                                        @endif
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="poster" name="poster">
                                                <label class="custom-file-label" for="poster">Виберіть файл
                                                    (Рекомендований
                                                    розмір 1286 x 408)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="slider_desc">
                                        <label for="slider_slog">Заголовок слайду</label>
                                        <input type="text" class="form-control" id="slider_slog" name="slider_slog"
                                               placeholder="Підпис до картинки у слайдері" value="@if(isset($product->slider_slog)){{
                                               $product->slider_slog}} @endif">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Опис товару</label>
                                        <textarea id="description" name="description">
                                            @if(isset($product->description))
                                                {{$product->description}}
                                                @endif
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="highlights">Основна інформація про товар</label>
                                        <textarea id="highlights" name="highlights">
                                             @if(isset($product->highlights))
                                                {{$product->highlights}}
                                            @endif
                                        </textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <button type="submit" class="btn btn-primary">Оновити товар у базі даних</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection
