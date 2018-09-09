<?php
if (! empty($_FILES['image']['name'])){
  if($_FILES['image']['error'] == 0){
      if(substr($_FILES['image']['type'],0,5)=='image'){

          $query = 'SELECT * FROM `chapters` WHERE mangaid='.$_GET['mangaid'].' AND number='.$_GET['chapter'];;
          $rez = $mysqli->query($query);
          $row = $rez->fetch_assoc();
          $filenew = $row['folder'].'/page_'.md5(time()).generateHash(10);

          $image = new image_worker($_FILES['image']['tmp_name']);
          $image->load();
          $image->resizeToWidth(800);
          $filenew = $image->save($filenew);
          $query = 'SELECT * FROM `pages` WHERE id='.(int)$_GET['pageid'];
          $rez = $mysqli->query($query);
          if ($rez->num_rows != 0){
             $row = $rez->fetch_assoc();
             unlink($row['image']);
          }
          $query = 'UPDATE `pages` SET image = "'.$filenew.'" WHERE id='.(int)$_GET['pageid'];
          $mysqli->query($query);

      }
    }
  }
 ?>
