<?php
if ($_SERVER['REQUEST_METHOD'] = 'POST' && !empty($_POST['user'])) {
    var_dump($_POST);

}
header('Location:index.php');
