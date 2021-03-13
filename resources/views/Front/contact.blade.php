@extends('layouts.main')
@section('content')
        <div class="contact">
            <div class="container">
                @if(session()->has('alert-success'))
                    <div class="alert alert-success">
                        {{ session()->get('alert-success') }}
                    </div>
                @endif
                <h3 class="ffont">Залиште ваше повідомлення</h3>
                <div class="contact-content">
                    <form method="get" action="{{route('sendcontact')}}">
                        <input type="text" class="textbox" placeholder="Ім'я*" name="username" required><br>
                        <input type="email" class="textbox" placeholder="E-Mail*" name="email" required><br>
                        <input type="text" class="textbox" placeholder="Телефон*" name="phone" required><br>
                            <div class="clear"> </div>
                        <div>
                            <textarea name="message" placeholder="Ваше запитання або пропозиція..."></textarea><br>
                        </div>
                       <div class="submit">
                            <input class="btn btn-default cont-btn btnsub" style="margin-bottom: 50px" type="submit" value="ВІДПРАВИТИ" />
                      </div>
                    </form>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d81505.3416858946!2d30.22459646318128!3d50.32846901470686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4b6864b8091d3%3A0x64a1d2685ed1e261!2z0JHQvtGP0YDQutCwLCDQmtC40ZfQstGB0YzQutCwINC-0LHQuy4sIDA4MTUx!5e0!3m2!1suk!2sua!4v1615131920738!5m2!1suk!2sua" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
@endsection
