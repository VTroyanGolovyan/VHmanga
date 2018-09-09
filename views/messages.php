<main>
<?php
   $query = 'SELECT * FROM `dialogs` INNER JOIN `users` ON `users`.id = `dialogs`.id2 WHERE `id1` = '.$_SESSION[$host]['id'];
   $rez = $mysqli->query($query);
   if ($rez->num_rows != 0){ ?>
     <div class = "dialogList">
    <?php
     while ($row = $rez->fetch_assoc()) { ?>
      <a href = "?view=dialog&id=<?php print $row['id2']; ?>">
        <div class = "message">
          <div>
      <?php if ($row['avatar'] != ""){ ?>
         <img width="50px" src = "<?php print $row['avatar']; ?>">
      <?php }else{ ?>
        <img width="50px" src = "content/avatars/defolt.jpg">
      <?php } ?>
          </div>
          <div>
            <div class = "senderName">
              <?php print $row['name'].' '.$row['last_name']; ?>
            </div>
            <div class = "messageText">
            </div>
          </div>
       </div>
      </a>
    <?php } ?>
    </div>
  <?php } ?>
</main>
<?php
   include_once('panels/search.php');
 ?>
