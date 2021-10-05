<?php 
    include '../../assets/header.php';
    $clanky = file('clanky.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>

<div class="container">
    <h1>Domov</h2>
        <?php

            foreach ($clanky as $clanok) {
                list($nadpis, $obrazok, $text) = explode('::', $clanok);

        ?>

            <div class="clanok" style="margin-bottom: 20px;">

        <div class="row">

          <div class="col-2"><img src="images/<?php echo $obrazok; ?>" width="100%"></div>

          <div class="col-10">

                    <h3><?php echo $nadpis; ?></h3>
                    <p><?php echo $text; ?></p>

          </div>

        </div>

            </div>

        <?php

            }

        ?>
</div>

<?php
    include '../../assets/footer.php';
?>
