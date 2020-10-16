<?php
///////////////////////////////////////////////
//        Файл, передающий значения на       //
//             народный мониторинг           //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
include '/var/www/patch/to/script/folder/inc/function.php';
include '/var/www/patch/to/script/folder/inc/class.php';
$iot = new IoT();

$fp = @fsockopen("tcp://narodmon.ru", 8283, $errno, $errstr);
if(!$fp) exit("ERROR(".$errno."): ".$errstr);
fwrite($fp, "#12:34:56:78:90:AB\n#T1#".$iot->getDallasData(1)."\n#T2#".$iot->getDallasData(2)."\n#T3#".$iot->getDallasData(3)."\n#P1#R1#".$iot->getRelayState(1)."\n#R2#".$iot->getRelayState(2)."\n#R3#".$iot->getRelayState(3)."\n#R4#".$iot->getRelayState(4)."\n##");

fclose($fp);
add_log('Данные телеметрии переданы в Народный мониторинг');
?>
