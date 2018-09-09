<?php
if (! empty($_FILES['image']['name'])){
  if($_FILES['image']['error'] == 0){
      if(substr($_FILES['image']['type'],0,5)=='image'){
        $image = new image_worker($_FILES['image']['tmp_name']);
        $image->load();
        $image->crop(750,1065);
        $filenew = 'content/mangaimgs/mangaimg_'.md5(time()).generateHash(10);
        $filenew = $image->save($filenew);
        $query = 'SELECT image FROM `manga` WHERE id='.(int)$_GET['mangaid'];
        $rez = $mysqli->query($query);
        if ($rez->num_rows!=0){
           $row = $rez->fetch_assoc();
           @unlink($row['image']);
        }
        $query = 'UPDATE `manga` SET image = "'.$filenew.'" WHERE id='.(int)$_GET['mangaid'];
        $mysqli->query($query);
      }
  }
}
if (isset($_POST['name']) && isset($_POST['about'])){
  $query = 'UPDATE `manga` SET name = "'.$_POST['name'].'", genre = "'.$_POST['genre'].'", about ="'.$_POST['about'].'" , year ="'.$_POST['year'].'" , author ="'.$_POST['author'].'" , translator ="'.$_POST['translator'].'" WHERE id='.(int)$_GET['mangaid'];
  $mysqli->query($query);
}
 ?>
