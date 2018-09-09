<main>
<?php
  if (isset($_GET['mangaid']))
     $mangaid = (int)$_GET['mangaid'];
  else $mangaid = 1;
  $query = 'SELECT * FROM `manga` WHERE id='.$mangaid;
  $rez = $mysqli->query($query);
  if ($rez->num_rows != 0){
    $row = $rez->fetch_assoc();
    if ($row['visible'] == 1 || ($_SESSION[$host]['access'] & 4) == 4  ||
           (($_SESSION[$host]['access'] & 2) == 2) && $row['loader'] == $_SESSION[$host]['id'] ){
      print    '<div class = "mangaBigImage">';
      print       '<img onclick="bigImage(this)" src = "'.$row['image'].'">';
      print    '</div>';
      print   '<div class = "mangaInfo">';
      print     '<div class = "mangaBigName">';
      print        $row['name'];
      print     '</div>';
      print '<div class = "chaptersList">';
      print   '<div class = "list">';


      print '<div class = "chapterHref">';
      print   '<div class = "chapterNumber">';
      print   'Год выпуска';
      print   '</div>';
      print   '<div class = "chapterName">';
      print $row['year'];
      print   '</div>';
      print '</div>';

      print '<div class = "chapterHref">';
      print   '<div class = "chapterNumber">';
      print   'Жанр';
      print   '</div>';
      print   '<div class = "chapterName">';
      print $row['genre'];
      print   '</div>';
      print '</div>';

      print '<div class = "chapterHref">';
      print   '<div class = "chapterNumber">';
      print   'Автор';
      print   '</div>';
      print   '<div class = "chapterName">';
      print $row['author'];
      print   '</div>';
      print '</div>';

      print '<div class = "chapterHref">';
      print   '<div class = "chapterNumber">';
      print   'Перевод';
      print   '</div>';
      print   '<div class = "chapterName">';
      print $row['translator'];
      print   '</div>';
      print '</div>';
    print   '</div>';
    print '</div>';
    //print '<div class = "chaptersList">';
  //  print '</div>';
    $mangaid = $row['id'];
    $query = 'SELECT * FROM `chapters` WHERE mangaid='.$row['id'];
    $rez = $mysqli->query($query);
    if ($rez->num_rows != 0){
      print '<div class = "chaptersList">';
      print   '<input  id = "openList" type="checkbox">';
      print   '<div class = "aboutChaptersList">';
      print   'Список глав';
      print   '</div>';
      print   '<div id = "list" class = "list">';
      while ($row2 = $rez->fetch_assoc()){
        print '<a href = "?view=chapter&mangaid='.$mangaid.'&chapter='.$row2['number'].'">';
        print '<div class = "chapterHref">';
        print   '<div class = "chapterNumber">';
        print $row2['number'];
        print   '</div>';
        print   '<div class = "chapterName">';
        print $row2['name'];
        print   '</div>';
        print '</div>';
        print '</a>';
      }
      print   '</div>';
      print   '<label class = "openListLabel" onclick = "this.innerHTML = this.innerHTML==`Открыть` ? `Закрыть` : `Открыть`;" for = "openList">Открыть</label>';

      print '</div>';
    }
    if (isset($_SESSION[$host]['access']) && (  ( $_SESSION[$host]['access'] & 4 )== 4 ||  $row['loader'] == $_SESSION[$host]['id'] )){
      print '<div class = "chaptersList">';
      print '<form class = "formComment" method = "post" action="?cmd=addchapter&mangaid='.$mangaid.'&view=manga">';
      print '<input class = "comentinput" name = "name" type = "text" placeholder = "Название главы">';
      print '<input class = "submit" type = "submit" value = "Добавить">';
      print '</form>';
      if (isset($_SESSION[$host]['access']) && ( ( $_SESSION[$host]['access'] & 4 )== 4 )){
         print '<div class = "addmangaButton" onclick = openbox("danger")>Опасная зона</div>';
         print '<div id = "danger" style = "display:none">';
         print '<form method = "post" action="?cmd=parser&mangaid='.$mangaid.'&view=manga">';
         print '<input class = "input" name = "chapter" type = "text" placeholder = "Номер главы">';
         print '<input class = "input" name = "base" type = "text" placeholder = "Основа">';
         print '<input class = "input" name = "start" type = "text" placeholder = "от">';
         print '<input class = "input" name = "end" type = "text" placeholder = "до">';
         print '<input class = "submit" type = "submit" value = "Спарсить">';
         print '</form>';

         print '<a href = "?cmd=dellmanga&mangaid='.$mangaid.'">Удалить</a>';

         print '</div>';
      }
      print '</div>';
    }

    print '<div class = "chaptersList">';
    print        '<div class = "aboutChaptersList">';
    print          'Краткое описание';
    print        '</div>';
    print        $row['about'];
    print '</div>';

    if (isset($_SESSION[$host]['access']) && ( ($_SESSION[$host]['access'] & 4) == 4 || $row['loader'] == $_SESSION[$host]['id'] )){
      print '<div class = "chaptersList">';
      print '<div class = "addmangaButton" onclick = openbox("addmanga")>Редактировать информацию</div>';
      print '<form id = "addmanga" enctype="multipart/form-data" method = "post" action="?view=manga&cmd=editmanga&mangaid='.$mangaid.'">';
      print    '<input class = "blockinput" value = "'.$row['name'].'" placeholder = "Название манги" name = "name" type = "text">';
      print    '<input class = "blockinput" value = "'.$row['genre'].'" placeholder = "Жанры через запятую" name = "genre" type = "text">';
      print    '<input class = "blockinput" value = "'.$row['year'].'" placeholder = "Год выпуска" name = "year" type = "text">';
      print    '<input class = "blockinput" value = "'.$row['author'].'" placeholder = "Автор" name = "author" type = "text">';
      print    '<input class = "blockinput" value = "'.$row['translator'].'" placeholder = "Перевод" name = "translator" type = "text">';
      print    '<textarea placeholder = "Краткое описание" name = "about">'.$row['about'].'</textarea>';
      print    '<input class = "input" name = "image" type = "file">';
      print    '<input class = "submit" type = "submit" value = "Изменить">';
      print '</form>';
      print '</div>';
   }

   if (isset($_SESSION[$host]['access']) && ( ($_SESSION[$host]['access'] & 4) == 4 )){
     print '<div class = "chaptersList">';
     print '<a href = "?cmd=changevisible&view=manga&mangaid='.$row['id'].'&t='.($row['visible'] == 1 ? 0 : 1).'">';
     print $row['visible'] == 1 ? "Скрыть" : "Подтвердить";
     print '</a>';
     print '</div>';

   }

   print '<div class = "chaptersList">';
   include('panels/coments.php');
   print '</div>';

   print '</div>';
   include_once('panels/interesting.php');

}else print '<script> location.href = "?main";</script>';

}
 ?>
</main>
<?php
   include_once('panels/search.php');
 ?>
