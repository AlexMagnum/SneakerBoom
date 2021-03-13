@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Детальна інформація звернення</b></h1>
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
                        Видалити звернення</a>
                    <td>
                        <a style="margin-left: 15px; " href="{{route('contacts.edit', $contact->id)}}" class="btn btn-info"><i class="far fa-envelope pr"></i>
                            Дати відповідь</a>
                    </td>
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-envelope-open-text pr"></i>Зміст повідомлення</h3>
                        </div>
                        <div class="card-body" >
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td><b>Нікнейм</b></td>
                                    <td>{{$contact->name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{$contact->email}}</td>
                                </tr>
                                <tr>
                                    <td><b>Телефон</b></td>
                                    <td>{{$contact->phone }}</td>
                                </tr>
                                <tr>
                                    <td><b>Дата звернення</b></td>
                                    <td>{{$contact->created_at}}</td>
                                </tr>
                                <tr>
                                    <td><b>Статус</b></td>
                                    <td> @if($contact->status == "Чекає відповіді")
                                            <b style="color: red">{{$contact->status}}</b>
                                        @else
                                            <b style="color: green">{{$contact->status}}</b>
                                        @endif</td>
                                </tr>
                                <tr>
                                    <td><b>Повідомлення</b></td>
                                    <td>
                                        {{$contact->message}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <form action="{{route('contacts.delete', $contact->id)}}" method="POST" id="delete-form" style="display:none">
        @csrf
        @method("DELETE")
    </form>
@endsection
