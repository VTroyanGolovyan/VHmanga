<?php
  if ($_GET['t'] == 1){
   $query = 'UPDATE `manga` SET visible = 1 WHERE id='.(int)$_GET['mangaid'];
 }else{
   $query = 'UPDATE `manga` SET visible = 0 WHERE id='.(int)$_GET['mangaid'];
 }
   $mysqli->query($query);
 ?>
