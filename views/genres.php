<main>
  <div class = "genres">
  <?php
     $query = 'SELECT * FROM `tags`';
     $rez = $mysqli->query($query);
     if ($rez->num_rows != 0){
       while ($row = $rez->fetch_assoc()){ ?>
         <a class = "ganreItemRow" href = "?viev=main&tag=<?php print $row['id']; ?>&page=1">
           <div class = "ganreItem">
             <img src = "<?php print $row['icon']; ?>">
             <div><?php print $row['tag']; ?></div>
          </div>
          <div class = "genreImage">
            <div class="mask"></div>
            <img src = "<?php print $row['image']; ?>">

          </div>
        </a>
 <?php }
     }
   ?>
  </div>
</main>
<?php
   include_once('panels/search.php');
 ?>
