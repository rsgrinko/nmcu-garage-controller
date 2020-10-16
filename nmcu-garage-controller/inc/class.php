<?php
///////////////////////////////////////////////
//        Файл главного класса системы       //
//-------------------------------------------//
//        Автор: Гринько Роман Сергеевич     //
//             rsgrinko@gmail.com            //
///////////////////////////////////////////////
class IoT
{   
  public function getDallasData($num) {
	 if(file_exists($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/dallas'.$num.'temp.txt')) {
	  return file_get_contents($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/dallas'.$num.'temp.txt');
	 } else {
	  return  'undefined';
	 }
  }
  
  public function addDallasData($num, $data) { 
      $fh = fopen($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/dallas'.$num.'temp.txt', 'w');
      fwrite($fh, $data);
      fclose($fh); 
	  return;
  }
  
  public function setRelayState($num, $state) {
      $fh = fopen($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/rele'.$num.'.txt', 'w');
      fwrite($fh, $state);
      fclose($fh);
	  return;
  }
  
  

  public function getRelayState($num) {
	  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/rele'.$num.'.txt')) {
      return (file_get_contents($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/rele'.$num.'.txt'))=='1' ? '1' : '0';
      } else {
	  return  'undefined';
      } 
    
}


  
  public function getRelayStateHtml($num) {
	  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/rele'.$num.'.txt')) {
      return (file_get_contents($_SERVER['DOCUMENT_ROOT'].'/patch/to/script/folder/txt/rele'.$num.'.txt')=='1') ? '<font color="green">ON</font>' : '<font color="red">OFF</font>';
      } else {
	  return  'undefined';
      } 
  }
}
?>