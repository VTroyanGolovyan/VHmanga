<?php
   if (isset($_GET['mangaid'])){
      if (isset($_SESSION[$host]['id'])){
        print '<form class = "formComment" method = "POST" action = "?cmd=addcoment&view=manga&mangaid='.(int)$_GET['mangaid'].'">';
        print '<input placeholder = "Введите коментарий" class = "comentinput" type = "text" name="coment">';
        print '<input class = "submit" type = "submit" value = "Прокоментировать">';
        print '</form>';
      }else {
        print '<div class = "coment">';
        print 'Вы не авторизированы и не можете оставлять коментарии';
        print '</div>';
      }
      $query = 'SELECT * FROM `coments` INNER JOIN `users` ON `coments`.user = `users`.id WHERE `coments`.mangaid='.(int)$_GET['mangaid'].' ORDER BY `coments`.datetime DESC LIMIT 15';
      $rez = $mysqli->query($query);
      if ($rez->num_rows != 0){
         while( $row = $rez->fetch_assoc()){
           print '<div class = "coment">';
           print '<div class = "miniAvatar">';
           print '<a href = "?view=profile&id='.$row['user'].'">';
           if ($row['avatar'] != ""){
             print '<img src = "'.$row['avatar'].'">';
           }else{
             print '<img src = "content/avatars/defolt.jpg">';
           }
           print '</a>';
           print '</div>';
           print '<div class = "comentContent">';
           print   '<div>';
           print   $row['name'].' '.$row['last_name'];
           print   '</div>';
           print   '<div>';
           print   $row['text'];
           print   '</div>';
           print '</div>';
           print '</div>';
      }
    }else{
      if (isset($_SESSION[$host]['id'])){
         print '<div class = "coment">';
         print 'Коментарии отсутствуют, станьте первым!';
         print '</div>';
      }
    }

   }
?>
