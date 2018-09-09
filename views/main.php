<main>
<?php
if (isset($_SESSION[$host]['access']) &&  ($_SESSION[$host]['access'] & 2) == 2){
   include_once('panels/addmangapanel.php');
}
if (isset($_SESSION[$host]['access']) &&  ($_SESSION[$host]['access'] & 2) == 2){
   include_once('panels/visibility.php');
}
if (isset($_GET['page'])){
  $page = (int)$_GET['page'];
}else $page = 1;
$begin = ($page - 1) * 20;
$end = $page*20;
$where = "";
$f = false;
if (isset($_GET['tag'])){
  $query = 'SELECT * FROM `tags` WHERE id='.$_GET['tag'];
  $rez = $mysqli->query($query);
  if ($rez->num_rows != 0){
    $row = $rez->fetch_assoc();
    $where =  ' WHERE `genre` LIKE "%'.$row['tag'].'%"  ';
    $f = true;
  }
}

if (isset($_POST['names'])){
  if (!$f){
    $where =  ' WHERE ';
    $f = true;
  }else $where.=' and ';
   $where .= ' name LIKE "%'.$_POST['names'].'%" ';
}
if (isset($_GET['v']) && isset($_SESSION[$host]['id'])){
  if (($_SESSION[$host]['access'] & 4) == 4){
    if (!$f){
      $where =  ' WHERE ';
      $f = true;
     }else $where.=' and ';
     $where .= ' visible = 0 ';
  } else{
    if (!$f){
      $where =  ' WHERE ';
      $f = true;
     }else $where.=' and ';
    $where .= ' visible = 0 AND loader = '.$_SESSION[$host]['id'];
  }
}else{
  if (!$f){
    $where =  ' WHERE ';
    $f = true;
   }else $where.=' and ';
   $where .= ' visible = 1 ';
}
if (isset($_GET['v']) && isset($_SESSION[$host]['id'])){
  if (($_SESSION[$host]['access'] & 4) == 4)
    $query = 'SELECT * FROM `manga` '.$where.' ORDER BY `id` DESC LIMIT '.$begin.','.$end;
  else $query = 'SELECT * FROM `manga` '.$where.' ORDER BY `id` DESC LIMIT '.$begin.','.$end;
}else $query = 'SELECT * FROM `manga` '.$where.' ORDER BY `id` DESC LIMIT '.$begin.','.$end;

$rez = $mysqli->query($query);
if ($rez->num_rows != 0){
   print '<div class = "mangaAllCntainer">';
   while($row = $rez->fetch_assoc()){
     print '<div class = "mangaDiv">';
     print '<a class = "mangaHref" href = "?view=manga&mangaid='.$row['id'].'">';
     print    '<div class = "mangaImageContainer">';
     print       '<img class="mangaImage" src = "'.$row['image'].'">';
     print    '</div>';
     print '<div class="mangaTitle">';
     print $row['name'];
     print '</div>';
     print '</a>';
     print '</div>';
   }
   print '</div>';
}else{
  include('panels/404.php');
}
$query = 'SELECT count(*) FROM `manga`'.$where;
$row = $mysqli->query($query)->fetch_assoc();
if ($row['count(*)'] % 20 != 0)
   $last = (int)($row['count(*)']/20)+1;
else $last = (int)($row['count(*)']/20);
print '<div class = "pageList">';
for ($i = 1; $i <= $last; $i++){
  print '<a href = "?view=main&page='.$i.'">';
  if ($i == $page)
  print '<div class = "activebutton">';
  else print '<div>';
  print $i;
  print '</div>';
  print '</a>';
}
print '</div>';
?>
</main>
<?php
   include_once('panels/search.php');
 ?>
