<?php

  set_time_limit(0);
  $start = 1;
  if (isset($_POST['start']))
     $start = (int)$_POST['start'];
  if (isset($_GET['end'])){
     $end = (int)$_GET['end'];
  }else $end = (int)$_POST['end'];
  if (isset($_POST['start'])){
    $base = $_POST['base'];
    $_SESSION[$host]['base'] = $base;
  }else $base = $_SESSION[$host]['base'];

  $mangaid = (int)$_GET['mangaid'];
  if (isset($_GET['chapter']))
       $chapter = (int)$_GET['chapter'];
     else  $chapter = (int)$_POST['chapter'];
  if (isset($_GET['now']))
    $i = (int)$_GET['now'];
  else $i = $start;
  if ($i  <= $end){
    $filename = $base."".$i.".jpg";
    if (!@fopen($filename,'r')){
      $filename = $base."".$i.".png";
    }
    $image = new image_worker($filename);
    $image->load();
    $image->resizeToWidth(800);

    $query = 'SELECT * FROM `manga` WHERE id ='.$mangaid;
    $rez = $mysqli->query($query);
    $row = $rez->fetch_assoc();
    $filenew = $row['folder'].'/'.$chapter.'/page_'.md5(time()).generateHash(10);

    $filenew = $image->save($filenew);
    $query = 'INSERT INTO `pages` (id,mangaid,chapter,page,image) VALUES (NULL,'.$mangaid.','.$chapter.','.$i.',"'.$filenew.'")';
    $mysqli->query($query);
    $i++;
    header( 'Location: index.php?cmd=parser&mangaid='.$mangaid.'&now='.$i.'&chapter='.$chapter.'&start='.$start.'&end='.$end );
  }

?>
