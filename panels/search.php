<input id="toggleSearch" type="checkbox">
<div class = "rightSection">
    <div class = "elementSearch">
      <div class = "hello">Найти мангу по названию</div>
      <form class="searchform" method = "post" action = "?view=main">
        <input class = "input" name = "names" type="text" placeholder="Название">
        <input class = "submit" type="submit" value="Поиск">
        </label>
      </form>
   </div>
   <div class = "elementSearch">
     <div  class = "hello">Жанры</div>
     <?php
        $query = 'SELECT * FROM `tags` LIMIT 4';
        $rez = $mysqli->query($query);
        if ($rez->num_rows != 0){
          while ($row = $rez->fetch_assoc()){ ?>
            <a href = "?viev=main&tag=<?php print $row['id']; ?>&page=1">
              <div class = "ganreItem">
                <img src = "<?php print $row['icon']; ?>">
                <div><?php print $row['tag']; ?></div>
             </div>
           </a>
    <?php }
        }
      ?>
     <a href = "?view=genres">
        <div class = "ganreItem">
          <img src = "assets/img/icon/genres/all.png">
          <div>Все жанры</div>
       </div>
     </a>
  </div>
</div>
