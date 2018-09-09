<?php
   if (isset($_GET['mangaid']) && isset($_POST['name'])){
     $mangaid = $_GET['mangaid'];
     $name = $_POST['name'];
     $query = 'SELECT max(number) FROM `chapters` WHERE mangaid ='.$mangaid;
     $rez = $mysqli->query($query);
     if ($rez->num_rows != 0){
       $row = $rez->fetch_assoc();
       $chapter = (int)$row['max(number)'] + 1;

     }else $chapter = 1;
     $query = 'SELECT * FROM `manga` WHERE id='.$mangaid;
     $rez = $mysqli->query($query);
     if ($rez->num_rows != 0){
       $row = $rez->fetch_assoc();
       $folder = $row['folder'].'/'.$chapter;
       mkdir($folder,0777);
     }
     $query = 'INSERT INTO `chapters` (id,mangaid,folder,name,number) VALUES (NULL,'.$mangaid.',"'.$folder.'","'.$name.'",'.$chapter.')';
     $mysqli->query($query);
   }
 ?>
