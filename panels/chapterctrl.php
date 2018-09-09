<?php
   print '<div class = "danger">';
   print '<div class = "addmangaButton" onclick = openbox("danger1")>Опасная зона</div>';
   print '<div class = "dangerList" id = "danger1" style = "display:none">';
   print '<a href = "?cmd=chapter&type=0&mangaid='.$mangaid.'&chapter='.$_GET['chapter'].'&view=chapter">Очистить</a>';
   print '<a href = "?cmd=chapter&type=1&mangaid='.$mangaid.'&chapter='.$_GET['chapter'].'&view=chapter">Удалить</a>';
   ?>
   <form class="searchform" method = "post" action = "<?php print '?cmd=chapter&type=2&mangaid='.$mangaid.'&chapter='.$_GET['chapter'].'&view=chapter'; ?>">
     <input class = "input" name = "name" type="text" placeholder="Название">
     <input class = "submit" type="submit" value="Сменить имя">
   </form>
   <?php
   print '</div>';
   print '</div>';
?>
