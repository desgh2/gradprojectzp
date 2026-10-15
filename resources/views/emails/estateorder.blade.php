<ul style="list-style: none; padding: 0; margin: 0;" font-size="16px">
    <li style="padding: 5px 0;"><i>Ім’я:</i> <strong>{{ $order['name'] }}</strong></li>
    <li style="padding: 5px 0;"><i>Телефон:</i> <strong>{{ $order['phone'] }}</strong></li>
    <li style="padding: 5px 0;"><i>Назва об'єкту:</i> <strong>{{ $order['title'] }}</strong></li>
    <li style="padding: 5px 0;"><i>Посилання на нерухомість:</i> <strong><a href="https://gradproj.zp.ua/real-estate/{{ $order['slug'] }}" target="_blank">Перейти</a></strong></li>
</ul>
