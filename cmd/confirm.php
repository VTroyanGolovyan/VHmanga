<?php
  $key = $_GET['key'];
  $query = 'SELECT * FROM `users` WHERE ckey="'.$key.'" LIMIT 1';
  $rez = $mysqli->query($query);
  if ($rez->num_rows != 0){
    $row = $rez->fetch_assoc();
    if ($key == $row['ckey']){
      $query = 'UPDATE `users` SET access = 1, ckey = "'.generateHash(60).'" WHERE id ='.$row['id'];
      $mysqli->query($query);
      $_SESSION[$host]['access'] = 1;
      $_SESSION[$host]['id'] = $row['id'];
    }
  }
 ?>
