<?php
///////////////////////////////////////////////
//          Главная страница системы         //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
include '/var/www/patch/to/script/folder/inc/function.php';
include '/var/www/patch/to/script/folder/inc/class.php';
$iot = new IoT();

echo '<!DOCTYPE html><head><title>InfoPage</title></head>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<style type="text/css">
.act{
    height:65px;
    width:65px;
}
.block { 
    display: inline-block;
    width: 180px; 
    background: #CCCCCC;
	align: center;
    padding: 5px;
    padding-right: 20px; 
    border: solid 1px black; 
   }
   
.block_on { 
    display: inline-block;
    width: 180px; 
    background: #00FF7F;
	align: center;
    padding: 5px;
    padding-right: 20px; 
    border: solid 1px black; 
   }


.block_off { 
    display: inline-block;
    width: 180px; 
    background: #F08080;
	align: center;
    padding: 5px;
    padding-right: 20px; 
    border: solid 1px black; 
   }
   
   
.block_act { 
    display: inline-block; 
    background: #CCCCCC;
	align: center;
    border: solid 1px black; 
   }
   
   
.block_act_on { 
    background: #00FF7F;
    display: inline-block;
	align: center;
    border: solid 1px black; 
   }


.block_act_off { 
    background: #F08080;
    display: inline-block; 
	align: center;
    border: solid 1px black; 
   }
</style>
<body>';
echo '<table border="1px" width="100%">
<tr bgcolor="#1E90FF"><td><h3><center>Мониторинг</center></h3></td><td><h3><center>Управление</center></h3></td></tr>
<tr><td width="60%" valign="top" align="center">';

echo '<div class="block">Уличная температура (ID1):<br>'.$iot->getDallasData(1).' C</div><br>';
echo '<div class="block">Температура в помещении, стена(ID2):<br>'.$iot->getDallasData(2).' C</div><br>';
echo '<div class="block">Температура в помещении, верстак (ID3):<br>'.$iot->getDallasData(3).' C</div><br>';
echo '<h4><center>Состояние выходов</center></h4>';
$div_state1 = 'block';
$div_state2 = 'block';
$div_state3 = 'block';
$div_state4 = 'block';

$div_act_state1 = 'block_act';
$div_act_state2 = 'block_act';
$div_act_state3 = 'block_act';
$div_act_state4 = 'block_act';
if($iot->getRelayState(1)=='1') { $div_state1 = 'block_on'; $div_act_state1='block_act_on'; } else { $div_state1 = 'block_off'; $div_act_state1='block_act_off'; }
if($iot->getRelayState(2)=='1') { $div_state2 = 'block_on'; $div_act_state2='block_act_on'; } else { $div_state2 = 'block_off'; $div_act_state2='block_act_off'; }
if($iot->getRelayState(3)=='1') { $div_state3 = 'block_on'; $div_act_state3='block_act_on'; } else { $div_state3 = 'block_off'; $div_act_state3='block_act_off'; }
if($iot->getRelayState(4)=='1') { $div_state4 = 'block_on'; $div_act_state4='block_act_on'; } else { $div_state4 = 'block_off'; $div_act_state4='block_act_off'; }

echo '<div class="'.$div_state1.'">Значение реле '.$i.': '.$iot->getRelayStateHtml(1).'</div><br>';
echo '<div class="'.$div_state2.'">Значение реле '.$i.': '.$iot->getRelayStateHtml(2).'</div><br>';
echo '<div class="'.$div_state3.'">Значение реле '.$i.': '.$iot->getRelayStateHtml(3).'</div><br>';
echo '<div class="'.$div_state4.'">Значение реле '.$i.': '.$iot->getRelayStateHtml(4).'</div><br>';	

echo '</td><td width="40%" valign="top" >

<div class="'.$div_act_state1.'">
<center>Уличное освещение</center>
<button class="act" onclick="window.location.href=\'relayHandler.php?num=1&state=1\'">ON</button> <button class="act" onclick="window.location.href=\'relayHandler.php?num=1&state=0\'">OFF</button><br>
</div>

<div class="'.$div_act_state2.'">
<center>Внутреннее освещение</center>
<button class="act" onclick="window.location.href=\'relayHandler.php?num=2&state=1\'">ON</button> <button class="act" onclick="window.location.href=\'relayHandler.php?num=2&state=0\'">OFF</button><br>
</div>

<div class="'.$div_act_state3.'">
<center>Гараж 2 реле</center>
<button class="act" onclick="window.location.href=\'relayHandler.php?num=3&state=1\'">ON</button> <button class="act" onclick="window.location.href=\'relayHandler.php?num=3&state=0\'">OFF</button><br>
</div>

<div class="'.$div_act_state4.'">
<center>Оборгев помещения 3 КВт</center>
<button class="act" onclick="window.location.href=\'relayHandler.php?num=4&state=1\'">ON</button> <button class="act" onclick="window.location.href=\'relayHandler.php?num=4&state=0\'">OFF</button><br>
</div>
</td>
<tr>
</table>';

echo '</body></html>';
?>