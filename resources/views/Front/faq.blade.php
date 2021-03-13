@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageh2">Поширені запитання</h2>
                <img src="{{asset('images/faq.jpg')}}" alt="faq" class="img-responsive" style="margin: auto">
                <div class="faq">
                    <p class="qustion">
                        Чи оригінальний наший товар?
                    </p>
                    <p class="answer">
                        Увесь асортимент, який представлений у нас на сайті це ТІЛЬКИ ОРИГІНАЛ! Товар відправляється в оригінальних коробках.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Чи потрібно реєструватися, щоб зробити замовлення?
                    </p>
                    <p class="answer">
                        Ні, Ви можете оформити замовлення без реєстрації.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Який термін доставки товару?
                    </p>
                    <p class="answer">
                        Ваша посилка буде доставлена на протязі 3-5 робочих днів з моменту відправки замовлення.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Яка вартість доставки?
                    </p>
                    <p class="answer">
                        Оплата при отриманні (післяплата) - вартість доставки 50 Грн + 2% від суми замовлення.
                        <br>
                        Онлайн оплата (передоплата) - доставка безкоштовна.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Як я можу оплатити замовлення?
                    </p>
                    <p class="answer">
                        1) Накладений платіж.
                        <br>
                        2) Оплата онлайн за реквізитами
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Умови доставки замовлення?
                    </p>
                    <p class="answer">
                        У момент отримання замовлення перед оплатою товару ви можете відкрити посилку і оглянути доставлений товар, перевірити на наявність всіх позицій і оцінити якість і оригінальність товару.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Я зможу повернути замовлення, якщо мене щось не влаштує?
                    </p>
                    <p class="answer">
                        Так, ви зможете повернути замовлення, при цьому нічого не оплачуючи.
                    </p>
                </div>
                <div class="faq">
                    <p class="qustion">
                        Умови повернення товару?
                    </p>
                    <p class="answer">
                        Повернення можливе, якщо товар не був у споживанні, збережено його товарний вид, споживчі властивості, пломби, фабричні ярлики не пошкоджені. Заповніть заяву на повернення, обов'язкові поля: ПІБ, адреса і т.д., відзначте позиції, які повертаєте, суму і причину повернення.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
