<?php

    if (! empty($_FILES['image']['name'])){
      if($_FILES['image']['error'] == 0){
          if(substr($_FILES['image']['type'],0,5)=='image'){

            $image = new image_worker($_FILES['image']['tmp_name']);
            $image->load();
            $image->resizeToWidth(800);

            $query = 'SELECT * FROM `chapters` WHERE mangaid='.$_POST['mangaid'].' AND number='.$_POST['chapter'];
            $rez = $mysqli->query($query);
            $row = $rez->fetch_assoc();

            $filenew = $row['folder'].'/page_'.md5(time()).generateHash(10);
            $filenew = $image->save($filenew);

            $query = 'INSERT INTO `pages` (id,mangaid,chapter,page,image) VALUES (NULL,'.$_POST['mangaid'].','.$_POST['chapter'].','.$_POST['page'].',"'.$filenew.'")';
            $mysqli->query($query);
          }
      }
   }
?>
