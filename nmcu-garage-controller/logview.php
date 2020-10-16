<?php
///////////////////////////////////////////////
//           Простой просмотрщик логов       //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
if($_GET['act']=='clear') {
$fp = fopen('/var/www/patch/to/script/folder/log.txt', 'w');
fclose($fp);
header('Location: http://'.$_SERVER['SERVER_NAME'].'/patch/to/script/folder/logview.php');
}
echo '<html><head><title>LogViewer</title><meta http-equiv="Refresh" content="10" /></head><body>';
echo '<a href="logview.php?act=clear">Очистить логи</a><br>';
$t = file_get_contents('/var/www/patch/to/script/folder/log.txt');
$t = str_replace("\n", '<br>', $t);
echo $t;
echo '</body></html>';
?>
