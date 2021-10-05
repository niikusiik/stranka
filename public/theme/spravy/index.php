
<?php 
    include '../../assets/header.php';
    date_default_timezone_set("Europe/Bratislava");
    $clanky = glob('*.txt');
    
?>
<div class="container">
  <h1>Správy</h1>

    <?php

	foreach ($clanky as $subor) {
        
        $clanok = file($subor, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $datum = strtotime(basename($subor, ".txt"));
        $datumStr = date('j.n.Y H:i', $datum);
        
    ?>
    
        <div class="clanok" style="margin-bottom: 20px;">

          <div class="row">

            <div class="col-3"><img src="images/<?php echo $clanok[1]; ?>" width="100%"></div>

            <div class="col-9">
                <small><?php echo $datumStr?></small>
              <h3><?php echo $clanok[0]; ?></h3>
              <p><?php echo $clanok[2]; ?></p>

            </div>

          </div>

        </div>

    <?php } ?>

</div>
<?php
include '../../assets/footer.php';
?>
