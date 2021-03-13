<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head></head>
<body>
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
    <tr>
        <td>
            <span style="display: inline-block; max-width: 800px; width: 100%; text-align: center;">

                <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
                    <tr>
                        <td>
                            <span style="display:inline-block; width:800px;">
             <h1><a href="http://sneakerboom.ho.ua/"><img style="width: 256px"
                                                          src="{{ $message->embed(asset('images/logo.png'))}}"></a></h1>
         </span>
                             <span style="display:inline-block; width:800px;"><h2>
                                     Вітаємо!
                                 </h2>
                                 <p style="font-size: 14px">Ви оформили замовлення в нашому інтернет-магазину
                                 <br>Даний лист містить детальну інформацію Вашого замовлення</p>
                                 <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0"
                                        width="100%">
                                    <tr>
                                        <th>№ замовлення</th>
                                        <th>Дата замовлення</th>
                                        <th>Сума замовлення</th>
                                    </tr>
                                     <tr>
                                         <td>{{$order->id}}</td>
                                         <td>{{date('Y-d-m')}}</td>
                                         <td>{{$order->total_cost}} ₴</td>
                                     </tr>
                                 </table>
            </span>
                            <span style="display:inline-block; padding-top: 30px; width:800px;">
                                <p style="font-size: 14px">Товари в замовленні:</p>
                                 <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; padding-right: 50px;"
                                        width="100%">
                                    <tr>
                                        <th>Перегляд</th>
                                        <th>Виробник</th>
                                        <th>Модель</th>
                                        <th>Розмір</th>
                                        <th>Кількість</th>
                                    </tr>
                                         @foreach($cartItems->items as $item)
                                         <tr>
                                             <td><a href="{{url('product/'.$item['item']['id'])}}">
                                                     <img style="width: 100px"
                                                          <?php $productID =  \App\Models\Product::find($item['item']['id']);?>
                                                          src="{{ $message->embed(asset(explode(PHP_EOL,$productID->images)[0]))}}">
                                                 </a></td>
                                             <td>{{$item['item']['manufacturer']}}</td>
                                             <td>{{$item['item']['model']}}</td>
                                             <td>{{$item['size']}}</td>
                                             <td>{{$item['qty']}}</td>
                                             </tr>
                                         @endforeach
                                 </table>
                            </span>
                            <span style="display:inline-block; width:800px; padding-top: 35px;">
                                 <p style="font-size: 14px">Дякуємо, що скористалися нашим інтернет-магазином!
                                 <br>Очікуйте номер доставки ТТН на електронну пошту та телефон після того як
                                 <br>наші менеджери опрацюють Ваше замовлення.</p>
                            </span>
             <span style="display:inline-block; padding-top: 25px; width:800px;">
                                 <p> &copy;2021 SNEAKER BOOM</p>
            </span>


                        </td>
                    </tr>
                </table>
            </span>
        </td>
    </tr>
</table>
</body>
</html>

