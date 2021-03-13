@extends('layouts.admin')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success">
                            {{ session()->get('alert-success') }}
                        </div>
                    @endif
                    <h1 class="m-0">Редактор товарів</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btnadd" href="{{route('goods.add')}}"><i class="fas fa-plus pr"></i>Додати новий
                                товар</a>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Виробник</th>
                                    <th>Модель</th>
                                    <th>Ціна ₴</th>
                                    <th>Знижка</th>
                                    <th>Кількість на складі</th>
                                    <th>Продано</th>
                                    <th>Редагування</th>
                                </tr>
                                </thead>
                                <tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
