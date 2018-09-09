<?php
  set_time_limit(0);
  if (isset($_GET['mangaid'])){
    $id = $_GET['mangaid'];
    $query = 'SELECT * FROM `manga` WHERE id='.$id;
    $rez = $mysqli->query($query);
    if (!$rez->num_rows == 0){
      $row = $rez->fetch_assoc();
      $folder = $row['folder'];
      $query = 'SELECT * FROM `chapters` WHERE mangaid='.$id;
      $rez = $mysqli->query($query);
      if (!$rez->num_rows == 0){
        while($row2 = $rez->fetch_assoc()){
          $query = 'DELETE FROM `pages` WHERE mangaid='.$id.' AND chapter='.$row2['number'];
          $mysqli->query($query);
        }
      }
      $query = 'DELETE FROM `chapters` WHERE mangaid='.$id;
      $mysqli->query($query);
      unlink($row['image']);
      delFolder($folder);
    }
    $query = 'DELETE FROM `manga` WHERE id='.$id;
    $mysqli->query($query);
  }
 ?>
