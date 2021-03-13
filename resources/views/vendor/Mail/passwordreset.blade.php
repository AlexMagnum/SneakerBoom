<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head></head>
<body>
<table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
    <tr>
        <td>
            <span style="display: inline-block; max-width: 600px; width: 100%; text-align: center;">

                <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
                    <tr>
                        <td>
                            <span style="display:inline-block; width:600px;">
             <h1><a href="http://sneakerboom.ho.ua/"><img style="width: 256px" src="{{ $message->embed(asset('images/logo.png'))}}"></a></h1>
         </span>
                             <span style="display:inline-block; width:600px;"><h2>
                                     Вітаємо!
                                 </h2>
                                 <p style="font-size: 14px">Ви отримали цей електронний лист, оскільки ми отримали запит на скидання пароля для Вашого облікового запису.</p>
            </span>

                            <span style="display:inline-block; padding-top: 40px; width:600px;">
              <a href="{{$url}}" style="border: 1px solid #f84147; background: #f84147; padding: 10px;
                 text-decoration: none; font-size: 18px; font-weight: bold; color: white; border-radius: 8px">Скинути пароль</a>
         </span>
                             <span style="display:inline-block; padding-top: 40px; width:600px;">
                                 <p style="font-size: 14px;">Якщо Ви не запитували скидання пароля, подальших дій не потрібно.</p>
            </span>
                               <span style="display:inline-block; width:600px;">
                                 <p style="font-size: 14px;">Якщо у Вас виникли проблеми з натисканням кнопки "Скинути пароль",
                                     скопіюйте та вставте вказану нижче URL-адресу у свій веб-браузер: </p>
                                 <p>{{$url}}</p>
            </span>
             <span style="display:inline-block; padding-top: 25px; width:600px;">
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

