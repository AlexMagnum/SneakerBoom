@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Відповідь на звернення користувача <b>{{$contact->name}}</b></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-envelope-open-text pr"></i>Повідомлення</h3>
                        </div>
                        <div class="card-body">
                            {{$contact->message}}
                        </div>
                    </div>
                    <div class="card" style="margin-top: 30px;">
                        <div class="card-header">
                            <h3 class="card-title"><i class="far fa-paper-plane pr"></i>Відповідь</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('contacts.update', $contact->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <textarea id="answer" name="answer"></textarea>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Надіслати відповідь" />
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
