<main>
<?php
   $id = (int)$_GET['id'];
   $query = 'UPDATE `messages` SET `seen` = true WHERE  (`sender` = '.$_GET['id'].' AND `receiver` = '.$_SESSION[$host]['id'].')';
   $mysqli->query($query);
   $query = 'SELECT * FROM `messages` INNER JOIN `users` ON `messages`.sender = `users`.id WHERE (`sender` = '.$_SESSION[$host]['id'].' AND `receiver` = '.$_GET['id'].')  OR  (`sender` = '.$_GET['id'].' AND `receiver` = '.$_SESSION[$host]['id'].')';
   $rez = $mysqli->query($query);
   if ($rez->num_rows != 0){
     print '<div class = "msgList">';
     while($row = $rez->fetch_assoc()){
       print '<div class = "message">';
       print  '<div>';
       if ($row['avatar'] != ""){
         print '<img width="50px" src = "'.$row['avatar'].'">';
       }else{
         print '<img width="50px" src = "content/avatars/defolt.jpg">';
       }
       print  '</div>';
       print  '<div>';
       print   '<div class = "senderName">';
       print   $row['name'].' '.$row['last_name'];
       print   '</div>';
       print   '<div class = "messageText">';
       print   $row['text'];
       print   '</div>';
       print  '</div>';
       print '</div>';
     }
     print '<div id = "scroller"></div>';
     print '</div>';
   }
?>
<div class = "sendmsgForm">
  <form method = "post" action = "?cmd=sendmsg&view=dialog&id=<?php print $id; ?>">
     <textarea class="messageWrite" name = "message"></textarea><!--
     --><input class = "submitMsg" type = "submit" value="Отправить">
  </form>
</div>
</main>
<?php
   include_once('panels/search.php'); //Панель поиска
?>
<script>
   document.getElementById('scroller').scrollIntoView(true);
</script>
