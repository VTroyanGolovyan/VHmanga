<?php
   //ini_set('error_reporting', E_ALL);
   //ini_set('display_errors', 1);
   //ini_set('display_startup_errors', 1);

   require('db/db.php');  //Подключение к бд
   require('utility/image_worker.php'); //Класс для работы с картинками
   require('utility/functions.php'); //Функции которые упростят жизнь

   require('assets/languages/ru.php');

   session_start();
   $host = 'VHmanga';
   foreach ($_POST as $key => $value) {
      $_POST[$key] = $mysqli->real_escape_string(htmlspecialchars($value)); //Прогоняем все данные полученные через POST
   }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>VHmanga</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="assets/css/right.css">
    <link rel="stylesheet" type="text/css" href="assets/css/manga.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slider.css">
    <link rel="stylesheet" type="text/css" href="assets/css/news.css">
    <link rel="stylesheet" type="text/css" href="assets/css/chapter.css">
    <link rel="stylesheet" type="text/css" href="assets/css/profile.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dialog.css">
    <link rel="stylesheet" type="text/css" href="assets/css/adapt.css">
    <link rel="stylesheet" type="text/css" href="assets/css/imgbox.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <meta charset = "utf-8"  name = "viewport" content = "width=device-width">
  </head>
  <body>
    <input id="toggle" type="checkbox">
   <?php
    $CMDLIST['login'] = 'login.php';
    $CMDLIST['reg'] = 'reg.php';
    $CMDLIST['confirm'] = 'confirm.php';
    if (isset($_SESSION[$host]['id'])){
      $CMDLIST['logout'] = 'logout.php';
      $CMDLIST['update_avatar'] = 'update_avatar.php';
      if ( ($_SESSION[$host]['access'] & 1) == 1 ){
        $CMDLIST['sendmsg'] = 'sendmsg.php';
        $CMDLIST['addcoment'] = 'addcoment.php';
      }
      if ( ($_SESSION[$host]['access'] & 2) == 2 ){  //Редактор
        $CMDLIST['add'] = 'add.php';
        $CMDLIST['addchapter'] = 'addchapter.php';
        $CMDLIST['addmanga'] = 'addmanga.php';
        $CMDLIST['editmanga'] = 'editmanga.php';
        $CMDLIST['changepage'] = 'changepage.php';
        $CMDLIST['loadzip'] = 'loadzip.php';
        $CMDLIST['chapter'] = 'chapter.php';
      }
      if ( ($_SESSION[$host]['access'] & 4) == 4 ){ //Админ
        $CMDLIST['dellmanga'] = 'dellmanga.php';
        $CMDLIST['parser'] = 'parser.php';
        $CMDLIST['news'] = 'news.php';
        $CMDLIST['changevisible'] = 'changevisible.php';
      }
    }
    if (isset($_GET['cmd'])){
      if (isset($CMDLIST[$_GET['cmd']])){
        include_once('cmd/'.$CMDLIST[$_GET['cmd']]);
      }
    }
    include_once('panels/header.php');
    $VIEWLIST['main'] = 'main.php'; //Главная страница
    $VIEWLIST['login'] = 'login.php'; //Страница входа
    $VIEWLIST['reg'] = 'reg.php'; //Страница регистрации
    $VIEWLIST['manga'] = 'manga.php'; //Страница описания манги
    $VIEWLIST['rand'] = 'rand.php'; //страница случайной манги
    $VIEWLIST['chapter'] = 'chapter.php'; //страница с главой
    $VIEWLIST['news'] = 'news.php'; //Новости
    $VIEWLIST['profile'] = 'profile.php'; //Профиль
    $VIEWLIST['genres'] = 'genres.php'; //Жанры

    if (isset($_SESSION[$host]['id'])){
      if ($_SESSION[$host]['access'] == 0 && !isset($VIEWLIST[$_GET['view']])){
        $query = 'SELECT * FROM `users` WHERE id='.$_SESSION[$host]['id'].' LIMIT 1';
        $rez = $mysqli->query($query);
        $_SESSION[$host]['access'] = $row['access'];
        if ($rez->num_rows != 0 && $_SESSION[$host]['access'] == 0){
          $row = $rez->fetch_assoc();
          $VIEWLIST['noactive'] = 'noactive.php';
          $_GET['view']='noactive';
        }
      }
      $VIEWLIST['dialog'] = 'dialog.php';  //Диалог
      $VIEWLIST['messages'] = 'messages.php'; //Сообщения
    }
    if (isset($_GET['view'])){
      if (isset($VIEWLIST[$_GET['view']])){
        include_once('views/'.$VIEWLIST[$_GET['view']]);
      }else include_once('panels/404.php');
    }else include_once('views/main.php');
    include_once('panels/menu.php');
    $mysqli->close();
  ?>
    <script src = "assets/js/menu.js"></script>
    <script src = "assets/js/openbox.js"></script>
    <script src = "assets/js/imgbox.js"></script>
    <?php include_once('panels/imgbox.php'); ?>
    <div></div>
  </body>
</html>
