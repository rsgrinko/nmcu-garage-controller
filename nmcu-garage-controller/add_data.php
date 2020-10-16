<?php
///////////////////////////////////////////////
//  Файл обработчик запросов от контроллера  //
//  Принимает показания датчиков и выдает    //
// состояние реле, необходимое для установки //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
include '/var/www/patch/to/script/folder/inc/function.php';
include '/var/www/patch/to/script/folder/inc/class.php';
add_log('************************************************************************');
add_log('Скрипт запущен. Создаем объект класса');
$iot = new Iot();

add_log('Запускаем цикл');
for($i=1; $i<=10; $i++) {
$iot->addDallasData($i, $_GET['dallas'.$i.'temp']);	
add_log('Установлено значение датчика '.$i.': '.$_GET['dallas'.$i.'temp'].' C');
}
add_log('************************************************************************');

//выдаем значение реле для установки
echo file_get_contents('/var/www/patch/to/script/folder/txt/rele1.txt');
echo "\n";
echo file_get_contents('/var/www/patch/to/script/folder/txt/rele2.txt');
echo "\n";
echo file_get_contents('/var/www/patch/to/script/folder/txt/rele3.txt');
echo "\n";
echo file_get_contents('/var/www/patch/to/script/folder/txt/rele4.txt');
echo "\n";
?>