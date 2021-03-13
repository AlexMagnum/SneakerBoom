@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Інформація про користувача <b>{{$user->name}}</b></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-danger" onclick="event.preventDefault();
                        document.getElementById('delete-form').submit();"><i class="fas fa-trash pr"></i>
                            Видалити користувача</a>
                    <td>
                        <a style="margin-left: 15px; " href="{{route('users.edit', $user->id)}}" class="btn btn-info"><i class="fas fa-edit pr"></i>
                            Редагувати користувача</a>
                    </td>
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-user pr"></i>Основна інформація</h3>
                        </div>
                        <div class="card-body" >
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><b>Нікнейм</b></td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td><b>Користувач підтвердив свій обліковий запис</b></td>
                                    <td>@if($user->email_verified_at != null)
                                            Так
                                        @else
                                            Ні
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Роль користувача в системі</b></td>
                                    <td>{{$role}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(isset($user->phone) || isset($user->pip) || isset($user->birthdate))
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-card pr"></i>Контактна інформація</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    @if(isset($user->phone))
                                        <tr>
                                            <td><b>Контактний телефон користувача</b></td>
                                            <td>{{$user->phone}}</td>
                                        </tr>
                                    @endif
                                    @if(isset($user->pip))
                                        <tr>
                                            <td><b>Прізвище, ім'я, по-батькові</b></td>
                                            <td>{{$user->pip}}</td>
                                        </tr>
                                    @endif
                                    @if(isset($user->birthdate))
                                        <tr>
                                            <td><b>Дата народження:</b></td>
                                            <td>{{date('Y-m-d', strtotime( $user->birthdate))}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if(isset($user->region) || isset($user->city) || isset($user->number_department))
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-card pr"></i>Адреса доставки</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    @if(isset($user->region))
                                        <tr>
                                            <td><b>Область</b></td>
                                            <td>{{$user->region}}</td>
                                        </tr>
                                    @endif
                                    @if(isset($user->city))
                                        <tr>
                                            <td><b>Місто (населений пункт)</b></td>
                                            <td>{{$user->city}}</td>
                                        </tr>
                                    @endif
                                    @if(isset($user->number_department))
                                        <tr>
                                            <td><b>№ Відділення</b></td>
                                            <td>{{$user->number_department}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <form action="{{route('users.delete', $user->id)}}" method="POST" id="delete-form" style="display:none">
        @csrf
        @method("DELETE")
    </form>
@endsection
