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
                    <h1 class="m-0">Замовлення</h1>
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
                            <table id="exampleorders" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>№ замовлення</th>
                                    <th>Дата замовлення</th>
                                    <th>Сума ₴</th>
                                    <th>Статус</th>
                                    <th>ТТН</th>
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
