<main>
<?php
  if (isset($_GET['mangaid']) && isset($_GET['chapter'])){
    if (isset($_SESSION[$host]['id'])){
      $f = isLoader($mysqli,$_GET['mangaid'],$_SESSION[$host]['id']);
    }else $f = 0;
    if (isset($_SESSION[$host]['access']) && (($_SESSION[$host]['access'] & 4) == 4 || $f == 1) ){

      ?>
         <?php
             $mangaid = $_GET['mangaid'];
             include_once ('panels/chapterctrl.php');
          ?>
         <div class = "adproduct">
          <form method = "POST" enctype="multipart/form-data" action = "index.php?cmd=add&view=chapter&<?php print 'mangaid='.$_GET['mangaid'].'&chapter='.$_GET['chapter'];?>">
            <div class = "hidden">
              <input type="text" name= "mangaid" value="<?php print $_GET['mangaid']; ?>">
              <input type="text" name= "chapter" value="<?php print $_GET['chapter']; ?>">
              <input type="text" name= "page" value = "<?php
                $query = 'SELECT max(page) FROM `pages` WHERE mangaid='.$_GET['mangaid'].' and chapter='.$_GET['chapter'];
                $rez = $mysqli->query($query);
                if ($rez->num_rows != 0){
                  $row = $rez->fetch_assoc();
                  print $row['max(page)']+1;
                }
              ?>">
            </div>
            <input type = "file" name = "image">
            <br>
            <input type = "submit" value = "Добавить">
          </form>
      </div>
      <div class = "adproduct">
       <form method = "POST" enctype="multipart/form-data" action = "index.php?cmd=loadzip&view=chapter&<?php print 'mangaid='.$_GET['mangaid'].'&chapter='.$_GET['chapter'];?>">
         <div class = "hidden">
           <input type="text" name= "mangaid" value="<?php print $_GET['mangaid']; ?>">
           <input type="text" name= "chapter" value="<?php print $_GET['chapter']; ?>">
         </div>
         <input type = "file" name = "zip">
         <br>
         <input type = "submit" value = "Добавить Архив">
       </form>
   </div>
      <?php
    }
      print '<div class = "mangaPages">';
      $query = 'SELECT * FROM `chapters` WHERE mangaid='.$_GET['mangaid'].' and number='.$_GET['chapter'];
      $rez = $mysqli->query($query);
      if ($rez->num_rows != 0){
        $row = $rez->fetch_assoc();
        print '<div class = "avtorizationTitle">';
        print $row['name'];
        print '</div>';
      }
      print '<div class = "typeList2">';
      if ($_GET['chapter'] >1){
        print '<a href="?view=chapter&mangaid='.$_GET['mangaid'].'&chapter='.($_GET['chapter']-1).'">';
        print '<div>';
        print 'Назад';
        print '</div>';
        print '</a>';
      }
      print '<a href="?view=chapter&mangaid='.$_GET['mangaid'].'&chapter='.($_GET['chapter']+1).'">';
      print '<div>';
      print 'Вперед';
      print '</div>';
      print '</a>';
      $query = 'SELECT * FROM `pages` WHERE mangaid='.$_GET['mangaid'].' and chapter='.$_GET['chapter'];
      $rez = $mysqli->query($query);
      print '</div>';
      print '<div class = "mangaContainer">';
      if ($rez->num_rows != 0){
        while ($row = $rez->fetch_assoc()) {
          if (isset($_SESSION[$host]['access']) && (($_SESSION[$host]['access'] & 4) == 4 || $f == 1) ){
            ?>
            <form method = "POST" enctype="multipart/form-data" action = "index.php?cmd=changepage&view=chapter&<?php print 'mangaid='.$_GET['mangaid'].'&chapter='.$_GET['chapter'].'&pageid='.$row['id'];?>">

              <input type = "file" name = "image">
              <br>
              <input type = "submit" value = "Изменить">
            </form>
            <?php
          }
          print '<div class = "mangaPageImg">';
          print '<img title="'.$row['page'].'" src = "'.$row['image'].'">';
          print '</div>';
        }
      }
      print '</div>';
      print '</div>';
  }else{
    include('views/404.php');
  }
 ?>
</main>
<?php
   include_once('panels/search.php');
 ?>
