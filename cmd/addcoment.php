<?php
  if (isset($_POST['coment'])){
    $_POST['coment'] = htmlspecialchars($mysqli->real_escape_string($_POST['coment']));
  }

  if (isset($_POST['coment']) && $_POST['coment'] != ''){
    $query = 'INSERT INTO `coments`(id,mangaid,user,text,datetime) VALUES (NULL,'.(int)$_GET['mangaid'].','.$_SESSION[$host]['id'].',"'.$_POST['coment'].'","'.date("Y-m-d H:i:s").'")';
    $mysqli->query($query);
  }
 ?>
