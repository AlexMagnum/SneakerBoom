@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Новий користувач</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
                    <form method="post" action="{{route('users.save')}}">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user pr"></i>Основна інформація</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nickname">Нікнейм*</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname"
                                           placeholder="Нікнейм (обов'язкове поле)" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email (обов'язкове поле)" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Пароль*</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Пароль (обов'язкове поле)" required>
                                </div>
                                <div class="form-group">
                                    <label>Роль користувача в системі*</label><br>
                                    <select style="width: 50%;" name="role" class="ordersel" required>
                                        <option selected>Звичайний користувач</option>
                                        <option>Адміністратор</option>
                                        <option>Менеджер</option>
                                        <option>Редактор</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-card pr"></i>Контактна інформація</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           placeholder="Контактний телефон">
                                </div>
                                <div class="form-group">
                                    <label for="pip">Прізвище, ім'я, по-батькові</label>
                                    <input type="text" class="form-control" id="pip" name="pip"
                                           placeholder="ПІП">
                                </div>
                                <div class="form-group">
                                    <label>Дата народження:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input name="birthdate" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="ДД/ММ/РРРР"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-map-marked-alt pr"></i>Адреса доставки</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="oblast">Область</label>
                                    <input type="text" class="form-control" id="oblast" name="oblast"
                                           placeholder="Київська">
                                </div>
                                <div class="form-group">
                                    <label for="city">Місто (населений пункт)</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                           placeholder="Боярка">
                                </div>
                                <div class="form-group">
                                    <label for="department">№ Відділення</label>
                                    <input type="text" class="form-control" id="department" name="department"
                                           placeholder="№">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 50px; margin-top: 10px">Додати нового користувача до бази</button>

                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection
