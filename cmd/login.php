<?php
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
