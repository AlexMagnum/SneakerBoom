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
                             <span style="display:inline-block; width:800px;">
                                 <p style="font-size: 14px">Даний лист містить інформацію для оплати замовлення
                                 на сайті Sneakerboom.ho.ua</p>
                                 <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; font-size: 16px"
                                        width="100%">
                                     <tr>
                                         <td style="text-align: right"><span style="font-weight: bold;">№ Замовлення: </span></td>
                                         <td style="text-align: left; padding-left: 50px">{{$id}}</td>
                                     </tr>
                                     <tr>
                                        <td style="text-align: right"><span style="font-weight: bold;">До сплати: </span></td>
                                         <td style="text-align: left; padding-left: 50px">{{$order->total_cost}} ₴</td>
                                     </tr>
                                      <tr>
                                         <td style="text-align: right"><span style="font-weight: bold;">Отримувач: </span></td>
                                        <td style="text-align: left; padding-left: 50px">Інтернет-магазин взуття "Sneakerboom"</td>
                                     </tr>
                                      <tr>
                                         <td style="text-align: right"><span style="font-weight: bold;">ЄДРПОУ: </span></td>
                                         <td style="text-align: left; padding-left: 50px">33395345</td>
                                     </tr>
                                       <tr>
                                         <td style="text-align: right"><span style="font-weight: bold;">Розрахунковий рахунок: </span></td>
                                        <td style="text-align: left; padding-left: 50px">P-UA369204476573551004751015895</td>
                                     </tr>
                                      <tr>
                                         <td style="text-align: right"><span style="font-weight: bold;">Призначення платежу: </span></td>
                                         <td style="text-align: left; padding-left: 50px">Оплата за замовлення №{{$id}}</td>
                                     </tr>
                                 </table>
            </span>
                            <span style="display:inline-block; width:800px; padding-top: 35px;">
                                <p style="font-size: 14px; color: red; font-weight: bold">
                                    Обов'язкову вкажіть номер Вашого замовлення у призначенні платежу!
                                </p>
                                 <p style="font-size: 14px">
                                 Після успішної оплати очікуйте номер доставки ТТН на електронну пошту та телефон
                                 <br> після того як наші менеджери опрацюють Ваше замовлення.</p>
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

