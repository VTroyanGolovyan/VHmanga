<?php
   $id = (int)$_GET['id'];
   $query = 'SELECT * FROM `messages` WHERE (`sender` = '.$_SESSION[$host]['id'].' AND `receiver` = '.$_GET['id'].')  OR  (`sender` = '.$_GET['id'].' AND `receiver` = '.$_SESSION[$host]['id'].') LIMIT 1';
   $rez = $mysqli->query($query);
   if ($rez->num_rows == 0){
     $query = 'INSERT INTO `dialogs` (id,id1,id2) VALUES (NULL, '.$_SESSION[$host]['id'].' , '.$_GET['id'].') ,(NULL, '.$_GET['id'].' , '.$_SESSION[$host]['id'].')';
     $mysqli->query($query);
   }

   $query = 'INSERT INTO `messages` (id,sender,receiver,text,seen) VALUES (NULL, '.$_SESSION[$host]['id'].' , '.$id.' , "'.htmlspecialchars($_POST['message']).'",false)';
   $mysqli->query($query);
?>
