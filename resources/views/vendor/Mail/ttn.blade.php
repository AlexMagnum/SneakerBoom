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
                                 <p style="font-size: 14px">Ваше замовлення № {{$order->id}} відправлено!
                                 <h2>Деталі замовлення</h2>
                                 <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0"
                                        width="100%">
                                    <tr>
                                        <th>№ замовлення</th>
                                        <th>Адреса відділення Нової пошти</th>
                                        <th>Номер накладної</th>
                                        <th>Сума замовлення</th>
                                        <th>Час доставки</th>
                                    </tr>
                                     <tr style="margin-top: 15px">
                                         <td>{{$order->id}}</td>
                                         <td><b> <i><u>Область:</u></i></b> {{explode("->", $order->destination_address)[0]}}<br>
                                    <b><i><u>Місто (населений
                                                пункт):</u></i></b> {{explode("->", $order->destination_address)[1]}}
                                    <br>
                                    <b> <i><u>№
                                                відділення:</u></i></b> {{explode("->", $order->destination_address)[2]}}
                                         </td>
                                         <td><h3><b>{{$order->TTN}}</b></h3></td>
                                         <td>{{$order->total_cost }} ₴</td>
                                         <td>3-5 робочих днів</td>
                                     </tr>
                                 </table>
            </span>

                            <span style="display:inline-block; width:800px; padding-top: 35px;">
                                 <p style="font-size: 14px"><b><span style="color: red">Увага:</span> інформацію про прибуття товару Ви отримаєте <br>
                                          смс-повідомленням на номер телефону, який був указаний Вами при оформленні замовлення.</b></p>
                                <h3>Бажаємо Вам гарного дня!</h3>
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

