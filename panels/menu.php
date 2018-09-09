  
<nav>
  <a href = "?view=main">
    <div class = "navItem">
      <img src = "assets/img/icon/home-white.png">
      <span><?php print $LANG['menu']['main']; ?></span>
    </div>
  </a>
  <a href = "?view=rand">
    <div class = "navItem">
      <img src = "assets/img/icon/shuffle-white.png">
      <span><?php print $LANG['menu']['rand']; ?></span>
    </div>
  </a>
  <a href = "?view=news">
    <div class = "navItem">
      <img src = "assets/img/icon/news-white.png">
      <span><?php print $LANG['menu']['news']; ?></span>
    </div>
  </a>
  <?php if (!isset($_SESSION[$host]['access'])){ ?>
  <a class = "mobile" href = "?view=login">
    <div class = "navItem">
      <img src = "assets/img/icon/login.png">
      <span><?php print $LANG['menu']['login']; ?></span>
    </div>
  </a>
  <a class = "mobile" href = "?view=reg">
    <div class = "navItem">
      <img src = "assets/img/icon/reg.png">
      <span><?php print $LANG['menu']['reg']; ?></span>
    </div>
  </a>
<?php }else{ ?>
  <a class = "mobile"  href = "?view=profile">
    <div class = "navItem">
      <img src = "assets/img/icon/profile.png">
      <span><?php print $LANG['menu']['profile']; ?></span>
    </div>
  </a>
  <a href = "?view=messages">
    <div class = "navItem">
      <img src = "assets/img/icon/messages.png">
      <span id = "counter">
        <?php print $LANG['menu']['messages']; ?>
        <?php
            $query = 'SELECT count(*) FROM `messages` WHERE seen = false AND receiver='.$_SESSION[$host]['id'];
            $rez = $mysqli->query($query);
            if ($rez->num_rows != 0){
              $row = $rez->fetch_assoc();
              if ($row['count(*)'] != 0)
                print '+'.$row['count(*)'];
            }
        ?>
      </span>
    </div>
  </a>
<?php } ?>
</nav>

<div class = "tablet">
  <a href = "?view=main">
    <div class = "navItem">
      <img src = "assets/img/icon/home-white.png">
    </div>
  </a>
  <a href = "?view=rand">
    <div class = "navItem">
      <img src = "assets/img/icon/shuffle-white.png">
    </div>
  </a>
  <a href = "?view=news">
    <div class = "navItem">
      <img src = "assets/img/icon/news-white.png">
    </div>
  </a>
  <?php if (!isset($_SESSION[$host]['access'])){ ?>
  <a class = "mobile" href = "?view=login">
    <div class = "navItem">
      <img src = "assets/img/icon/login.png">
    </div>
  </a>
  <a class = "mobile" href = "?view=reg">
    <div class = "navItem">
      <img src = "assets/img/icon/reg.png">
    </div>
  </a>
<?php }else{ ?>
  <a class = "mobile"  href = "?view=profile">
    <div class = "navItem">
      <img src = "assets/img/icon/profile.png">
    </div>
  </a>
  <a href = "?view=messages">
    <div class = "navItem">
      <img src = "assets/img/icon/messages.png">
    </div>
  </a>
<?php } ?>
</div>
