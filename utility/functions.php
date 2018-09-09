<?php
//функция для генерации строки
function generateHash($length){
     //символы из которых генерируем
     $string='qwertyuiopadfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
     //генерация
     $hash='';
     for ($i = 0;$i<$length;$i++){
       $hash.=$string[mt_rand(0,strlen($string)-1)];
     }
     return $hash;
}
//функция которая проверяет является ли человек хозяином залитой манги
function isLoader($mysqli,$mangaid,$id){
  $query = 'SELECT * FROM `manga` WHERE `id` = '.(int)$mangaid.' LIMIT 1';
  $rez = $mysqli->query($query);
  if ($rez->num_rows == 0)
     return 0;
  else{
     $row = $rez->fetch_assoc();
     if ($row['loader'] == $id)
       return 1;
     else return 0;
  }
}
//функция рекурсивного удаления
function delFolder($dir){
    $files = array_diff(scandir($dir), array('.','..'));
    if (is_array($files))
      foreach ($files as $file)
        is_dir($dir.'/'.$file) ? delFolder($dir.'/'.$file) : unlink($dir.'/'.$file);
    return rmdir($dir);
}
function clearDir($dir){
  $files = array_diff(scandir($dir), array('.','..'));
  if (is_array($files))
    foreach ($files as $file)
      is_dir($dir.'/'.$file) ? delFolder($dir.'/'.$file) : unlink($dir.'/'.$file);
}
function is_image($filename) {
  $is = @getimagesize($filename);
  if ( !$is ) return false;
  elseif ( !in_array($is[2], array(1,2,3)) ) return false;
  else return true;
}
function refresh($url){
    print '<script>';
    print 'location.href="'.$url.'";';
    print '</script>';
    exit;
  }
?>
