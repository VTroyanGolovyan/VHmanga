<?php
    $query = 'SELECT count(*) FROM `manga`  WHERE visible = 1';
    $rez = $mysqli->query($query);
    $row = $rez->fetch_assoc();
    $rand_row = rand(0,(int)$row['count(*)']-1);

    $lim = $rand_row+1;
    $query = 'SELECT * FROM `manga` WHERE visible = 1 LIMIT '.$rand_row.','.$lim;
    $rez = $mysqli->query($query);
    $row = $rez->fetch_assoc();

    print '<script type="text/javascript">window.location = "?view=manga&mangaid='.$row['id'].'"</script>'; //переадресация
    exit;
?>
