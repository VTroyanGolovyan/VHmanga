<main>
    <?php
        if (isset($_GET['id']))
           $id = $_GET['id'];
        else $id = $_SESSION[$host]['id'];
        $query = 'SELECT * FROM `users` WHERE id='.$id;
        $rez = $mysqli->query($query);
        if ($rez->num_rows != 0){
            $row = $rez->fetch_assoc(); ?>
            <div class = "avatar">
    <?php   if (isset($_SESSION[$host]['id']) && !isset($_GET['id'])){  ?>
            <div>
              <form method = "POST" enctype="multipart/form-data" action = "index.php?cmd=update_avatar&view=profile">
                <input type = "file" name = "avatar">
                 <br>
                 <input type = "submit" value = "Поменять">
              </form>
            </div>
            <?php
            }
            if ($row['avatar'] != ""){ ?>
              <img onclick="bigImage(this)" src = "<?php print $row['avatar']; ?>">
      <?php }else{ ?>
              <img  onclick="bigImage(this)" src = "content/avatars/defolt.jpg">
      <?php }
            if (isset($_GET['id']) && isset($_SESSION[$host]['id'])){  ?>
              <a href = "?view=dialog&id=<?php print $row['id']; ?>">
                <div class = "writemsg">
                  Написать
                </div>
              </a>
      <?php } ?>
          </div>
  <div class = "userName">
    <?php print $row['name'].' '.$row['last_name']; ?>
  </div>
<?php }?>
</main>
<?php
   include_once('panels/search.php');
 ?>
