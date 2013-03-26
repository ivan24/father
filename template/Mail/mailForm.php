<table class="table" >
    <tr>
        <th style="width: 80px">Опция</th>
        <th>Данные</th>
    </tr>
    <tr>
        <td>Товар</td>
        <td><?print $userinfo['goods'] ?></td>
    </tr>
    <tr>
        <td>Имя</td>
        <td><?print $userinfo['name'] ?></td>
    </tr>
    <tr>
        <td>Электронный адресс</td>
        <td><?print $userinfo['email'] ?></td>
    </tr>
    <tr>
        <td>Телефон</td>
        <td><?print $userinfo['phone'] ?></td>
    </tr>
    <tr>
        <td>Сообщение</td>
        <td><?print $userinfo['msg'] ?></td>
    </tr>
    <tr>
        <td>Remote Address</td>
        <td><?print $serverinfo['remote_addr'] ?></td>
    </tr>
    <tr>
        <td>Useragent</td>
        <td><?print $serverinfo['useragent'] ?></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><?print $serverinfo['date'] ?></td>
    </tr>
</table>

