@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Налаштування головної сторінки</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success">
                            {{ session()->get('alert-success') }}
                        </div>
                    @endif
                    @if(session()->has('alert-abort'))
                        <div class="alert alert-warning">
                            {{ session()->get('alert-abort') }}
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
                    <form method="post" action="{{route('uiupdate')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="far fa-share-square pr"></i>Посилання на соціальні
                                    мережі</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="facebook"><i class="fab fa-facebook pr"></i>Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                           placeholder="Посилання на facebook" value="@if(isset($ui->social1)) {{$ui->social1}} @endif"/>
                                </div>
                                <div class="form-group">
                                    <label for="twitter"><i class="fab fa-twitter pr"></i>Twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter"
                                           placeholder="Посилання на twitter" value="@if(isset($ui->social2)) {{$ui->social2}} @endif"/>
                                </div>
                                <div class="form-group">
                                    <label for="youtube"><i class="fab fa-youtube pr"></i>Youtube</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube"
                                           placeholder="Посилання на youtube" value="@if(isset($ui->social3)) {{$ui->social3}} @endif"/>
                                </div>
                                <div class="form-group">
                                    <label for="instagram"><i class="fab fa-instagram pr"></i></i>Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram"
                                           placeholder="Посилання на instagram" value="@if(isset($ui->social4)) {{$ui->social4}} @endif"/>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-award pr"></i>Ліве рекламне вікно</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cta1_header">Заголовок</label>
                                    <input type="text" class="form-control" id="cta1_header" name="cta1_header"
                                           placeholder="Ключова фраза" value="@if(isset($ui->cta1_header)) {{$ui->cta1_header}} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="cta1_desc">Підпис</label>
                                    <input type="text" class="form-control" id="cta1_desc" name="cta1_desc"
                                           placeholder="Опис акції" value="@if(isset($ui->cta1_desc)) {{$ui->cta1_desc}} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="cta1_url">Посилання на акцію</label>
                                    <input type="text" class="form-control" id="cta1_url" name="cta1_url"
                                           placeholder="Опис акції" value="@if(isset($ui->cta1_url)) {{$ui->cta1_url}} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="cta1_image">Зображення</label>
                                    @if(isset($poster1))
                                        <img src="{{@asset($poster1[0])}}"
                                             style="height: 150px; margin-bottom: 15px"/>
                                    @else
                                        <img src="{{@asset('images/no image.jpg')}}"
                                             style="height: 250px"/>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cta1_image"
                                                   name="cta1_image">
                                            <label class="custom-file-label" for="poster">Виберіть файл (Рекомендований
                                                розмір 300 x 400)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-award pr"></i>Праве рекламне вікно</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cta2_header">Заголовок</label>
                                    <input type="text" class="form-control" id="cta2_header" name="cta2_header"
                                           placeholder="Ключова фраза" value="@if(isset($ui->cta2_header)) {{$ui->cta2_header}} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="cta2_desc">Підпис</label>
                                    <input type="text" class="form-control" id="cta2_desc" name="cta2_desc"
                                           placeholder="Опис акції" value="@if(isset($ui->cta2_desc)) {{$ui->cta2_desc}} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="cta2_url">Посилання на акцію</label>
                                    <input type="text" class="form-control" id="cta2_url" name="cta2_url"
                                           placeholder="Опис акції" value="@if(isset($ui->cta2_url)) {{$ui->cta2_url}} @endif">
                                </div>
                                <div class="form-group">
                                    <label for="cta2_image">Зображення</label>
                                    @if(isset($poster2))
                                        <img src="{{@asset($poster2[0])}}"
                                             style="height: 150px; margin-bottom: 15px"/>
                                    @else
                                        <img src="{{@asset('images/no image.jpg')}}"
                                             style="height: 250px"/>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="cta2_image"
                                                   name="cta2_image">
                                            <label class="custom-file-label" for="poster">Виберіть файл (Рекомендований
                                                розмір 300 x 400)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 50px; margin-top: 10px">
                            Зберегти налаштування головної сторінки
                        </button>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
