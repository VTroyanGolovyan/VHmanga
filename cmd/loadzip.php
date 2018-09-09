<?php
    if (isset($_SESSION[$host]['id'])){
         $f = isLoader($mysqli,$_GET['mangaid'],$_SESSION[$host]['id']);
    }else $f = 0;
    if (isset($_SESSION[$host]['access']) && (($_SESSION[$host]['access'] & 4) == 4 || $f == 1) ){
      if (! empty($_FILES['zip']['name'])){
        if($_FILES['zip']['error'] == 0){
          if($_FILES['zip']['type']=='application/zip'){
              set_time_limit(0);
              $query = 'SELECT * FROM `chapters` WHERE mangaid='.$_POST['mangaid'].' AND number='.$_POST['chapter'];
              $rez = $mysqli->query($query);
              $row = $rez->fetch_assoc();

              $folder = md5(time()).generateHash(10);
              mkdir('content/tmp/'.$folder,0777);
              shell_exec('unzip -d '.'content/tmp/'.$folder.' '.$_FILES['zip']['tmp_name'].'');
              $files = scandir('content/tmp/'.$folder);
              $n = count($files);
              $t = 0;
              $images = null;
              for ($i = 0; $i < $n; $i++){
                 if (is_image( 'content/tmp/'.$folder.'/'.$files[$i] ))
                   $images[$t++] = 'content/tmp/'.$folder.'/'.$files[$i];
              }
              sort($images, SORT_STRING);
              $n = count($images);
              for ($i = 0; $i < $n; $i++){
                 $image = new image_worker($images[$i]);
                 $image->load();
                 $image->resizeToWidth(800);
                 $filenew = md5(time()).generateHash(10);
                 $filenew = $image->save(  $row['folder'].'/page_'.$filenew);
                 $query = 'SELECT max(page) FROM `pages` WHERE mangaid='.$_GET['mangaid'].' and chapter='.$_GET['chapter'];
                 $rez = $mysqli->query($query);
                 if ($rez->num_rows != 0){
                   $row2 = $rez->fetch_assoc();
                   $page = $row2['max(page)']+1;
                 }else $page = 1;
                 $query = 'INSERT INTO `pages` (id,mangaid,chapter,page,image) VALUES (NULL,'.$_POST['mangaid'].','.$_POST['chapter'].','.$page.',"'.$filenew.'")';
                 $mysqli->query($query);
              }

              delFolder('content/tmp/'.$folder);
          }
        }
      }
    }
 ?>
