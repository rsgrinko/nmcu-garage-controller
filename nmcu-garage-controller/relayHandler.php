<?php
///////////////////////////////////////////////
//        Файл обработчик релейных команд    //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
include '/var/www/patch/to/script/folder/inc/function.php';
include '/var/www/patch/to/script/folder/inc/class.php';

$iot = new Iot();

$iot->setRelayState($_GET['num'], $_GET['state']);
header('Location: show.php');
exit();
?>
