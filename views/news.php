<main>
<?php if (isset($_SESSION[$host]['access']) && ( ( $_SESSION[$host]['access'] & 4 )== 4 )){  ?>
  <div class = "addMangaDiv">
      <div class = "addmangaButton" onclick = openbox("addmanga")>Добавление новости</div>
      <form id = "addmanga" enctype="multipart/form-data" method = "post" action="?cmd=news&view=news">
          <input class = "blockinputLight" placeholder = "Заголовок" name = "title" type = "text">
          <textarea placeholder = "Содержимое" name = "text"></textarea>
          <input class = "inputLeft" name = "image" type = "file">
          <input class = "submitRight" type = "submit" value = "Добавить">
      </form>
  </div>
<?php } ?>
   <?php
     $query = 'SELECT * FROM `news` ORDER BY `id` DESC';
     $rez = $mysqli->query($query);
     if ($rez->num_rows != 0){
       while ($row = $rez->fetch_assoc()){ ?>
         <div class = "newsDiv">
           <div class = "newsTitle">
             <h3>
               <?php print $row['title']; ?>
             </h3>
           </div>
           <div class = "newsContent">
             <div class = "newsImg">
               <img onclick="bigImage(this)" class = "newsImg" src = "<?php print $row['image']; ?>">
             </div>
             <div class = "newsText">
              <?php print $row['text']; ?>
             </div>
           </div>
         </div>
  <?php }
     } ?>
</main>
<?php
   include_once('panels/search.php');
 ?>
