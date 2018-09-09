
<?php


 $query = 'SELECT count(*) FROM `manga`  WHERE visible = 1 ';
 $rez = $mysqli->query($query);
 $row = $rez->fetch_assoc();
 $rand_row = rand(0,(int)$row['count(*)']-4);

 $lim = $rand_row+4;
 $query = 'SELECT * FROM `manga`  WHERE visible = 1 LIMIT '.$rand_row.','.$lim;
 $rez = $mysqli->query($query);
 //$row = $rez->fetch_assoc();

 //$query = 'SELECT * FROM `manga` '.$where.' ORDER BY `id` DESC LIMIT 5';
// $rez = $mysqli->query($query);
 if ($rez->num_rows != 0){
    print '<div class = "interesting">Возможно вам понравятся</div>';
    $i = 0;
    print '<div class = "interestingManga">';
    while(($row = $rez->fetch_assoc() )&& $i<5){
     //
      print '<div class = "mangaDiv">';
      print '<a class = "mangaHref" href = "?view=manga&mangaid='.$row['id'].'">';
      print    '<div class = "mangaImageContainer">';
      print       '<img class="mangaImage" src = "'.$row['image'].'">';
      print    '</div>';
      print '<div class="mangaTitle">';
      print $row['name'];
      print '</div>';
      print '</a>';
      print '</div>';
   //   print '</a>';
     $i++;
    }
    print '</div>';
 }else{
   include('panels/404.php');
 }
 ?>
