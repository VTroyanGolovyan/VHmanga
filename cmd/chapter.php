<?php

   if (isset($_GET['type'])){
     if (isset($_SESSION[$host]['id'])){
       $f = isLoader($mysqli,$_GET['mangaid'],$_SESSION[$host]['id']);
     }else $f = 0;
     if (isset($_SESSION[$host]['access']) && (($_SESSION[$host]['access'] & 4) == 4 || $f == 1) ){
       switch ($_GET['type']) {
         case '0':
            if (isset($_GET['mangaid']) && isset($_GET['chapter'])){
                set_time_limit(0);
                $query = 'SELECT * FROM `pages` WHERE mangaid='.$_GET['mangaid'].' and chapter='.$_GET['chapter'];
                $rez = $mysqli->query($query);
                while($row = $rez->fetch_assoc()){
                  unlink($row['image']);
                }
                $query = 'DELETE FROM `pages` WHERE mangaid='.$_GET['mangaid'].' and chapter='.$_GET['chapter'];
                $rez = $mysqli->query($query);
            }
           break;

         case 1:
         if (isset($_GET['mangaid']) && isset($_GET['chapter'])){
             set_time_limit(0);
             $query = 'SELECT * FROM `chapters` WHERE mangaid='.$_GET['mangaid'].' and number='.$_GET['chapter'];
             $rez = $mysqli->query($query);
             $row = $rez->fetch_assoc();
             delFolder($row['folder']);

             $query = 'DELETE FROM `pages` WHERE mangaid='.$_GET['mangaid'].' and chapter='.$_GET['chapter'];
             $rez = $mysqli->query($query);
             $query = 'DELETE FROM `chapters` WHERE mangaid='.$_GET['mangaid'].' and number='.$_GET['chapter'];
             $rez = $mysqli->query($query);

         }
           break;
        case 2:
             if (isset($_GET['mangaid']) && isset($_GET['chapter']) && isset($_POST['name'])){
                $query = 'UPDATE `chapters` SET `name` = "'.$_POST['name'].'" WHERE mangaid='.$_GET['mangaid'].' and number='.$_GET['chapter'];
                 $rez = $mysqli->query($query);
             }
           break;
       }
     }
   }

?>
