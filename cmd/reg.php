<?php
   if (isset($_POST['login'])){
     $query = 'SELECT * FROM `users` WHERE login="'.$_POST['login'].'"';
     $rez = $mysqli->query($query);
     if ($rez->num_rows == 0){
       $login = htmlspecialchars($_POST['login']);
       $name = $_POST['name'];
       $last_name = $_POST['last_name'];
       $password = md5(md5($_POST['password']));
       $access = 0;
       $key = htmlspecialchars(generateHash(50));
       $query = 'INSERT INTO `users` (id,login,name,last_name,access,password,avatar,ckey) VALUES (NULL , "'.$login.'", "'.$name.'", "'.$last_name.'", '.$access.', "'.$password.'", "","'.$key.'")';
       $mysqli->query($query);
       $body = 'Привет, '.$name.'! Для активации аккаунта перейдите по ссылке: https://vhmanga.com/?cmd=confirm&key='.$key.'&view=profile';
       mail($login, "Подтверждение аккаунта", $body);
     }
   }
   if (isset($_POST['login']) && isset($_POST['password'])){
       $login = htmlspecialchars($_POST['login']);
       $query = 'SELECT * FROM `users` WHERE login="'.$login.'" LIMIT 1';
       $rez = $mysqli->query($query);
       if ($rez->num_rows != 0){
         $row = $rez->fetch_assoc();
         if ($row['password'] == md5(md5($_POST['password']))){
           $_SESSION[$host]['access'] = $row['access'];
           $_SESSION[$host]['id'] = $row['id'];
         }
       }
   }
?>
