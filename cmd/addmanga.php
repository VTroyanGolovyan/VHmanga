<?php
if (! empty($_FILES['image']['name'])){
  if($_FILES['image']['error'] == 0){
      if(substr($_FILES['image']['type'],0,5)=='image'){
        $image = new image_worker($_FILES['image']['tmp_name']);
        $image->load();
        $image->crop(750,1065);
        $filenew = 'content/mangaimgs/mangaimg_'.md5(time()).generateHash(10);
        $filenew = $image->save($filenew);
        $folder = 'content/manga/'.time();
        mkdir($folder,0777);
        $author = $_POST['author'];
        $translator = $_POST['translator'];
        $year = (int)$_POST['year'];
        $query = 'INSERT INTO `manga` (id,name,genre,folder,author,translator,year,about,image,loader,visible) VALUES (NULL,"'.$_POST['name'].'","'.$_POST['genre'].'","'.$folder.'","'.$author.'","'.$translator.'",'.$year.',"'.$_POST['about'].'","'.$filenew.'",'.$_SESSION[$host]['id'].',0)';
        $mysqli->query($query);
      }
  }
}
 ?>
