<header class = "header">
  <div class = "leftHeaderGroup">
    <div class = "mobileMenuOpener"   onclick="closeX('toggle')">
      <label class = "mobileMenuOpenerLabel"  for = "toggle">
        <img class ="closeM" src = "assets/img/icon/close.png">
        <img class ="openM" src = "assets/img/icon/menu.png">
      </label>
    </div>
    <div class = "logo">
      <img class="logoImage" src = "assets/img/manga.png">
      <span>VHmanga</span>
    </div>
    <div class = "mobileMenuOpener" onclick="closeX('toggleSearch')">
      <label for = "toggleSearch">
        <img src = "assets/img/icon/search.png">
      </label>
    </div>
  </div>
  <div class = "rightHeaderGroup">
     <?php
      if (isset($_SESSION[$host]['id']) ){
     ?>
     <a href = "?view=profile">
      <div class = "rightHeaderButton leftBorder">
        <?php print $LANG['menu']['profile']; ?>
      </div>
     </a>
     <a href = "?cmd=logout">
      <div class = "rightHeaderButton">
        <?php print $LANG['menu']['logout']; ?>
      </div>
    </a>
    <?php } else {?>
    <a href="?view=login">
      <div class = "rightHeaderButton leftBorder">
        <?php print $LANG['menu']['login']; ?>
      </div>
    </a>
    <a href="?view=reg">
    <div class = "rightHeaderButton">
      <?php print $LANG['menu']['reg']; ?>
    </div>
    </a>
  </div>
  <?php } ?>
</header>
