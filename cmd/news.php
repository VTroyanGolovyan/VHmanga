<?php
if (! empty($_FILES['image']['name'])){
  if($_FILES['image']['error'] == 0){
      if(substr($_FILES['image']['type'],0,5)=='image'){
        $image = new image_worker($_FILES['image']['tmp_name']);
        $image->load();
        $image->crop(600,600);
        $filenew = 'content/news/newsimg_'.md5(time()).generateHash(10);
        $filenew = $image->save($filenew);
        $query = 'INSERT INTO `news` (id,title,text,image) VALUES (NULL,"'.$_POST['title'].'","'.$_POST['text'].'","'.$filenew.'")';
        $mysqli->query($query);
      }
  }
}
 ?>
