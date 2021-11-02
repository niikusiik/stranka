
<?php 
    include '../../assets/header.php';

    function kontrola($vstup)
    {
        $vstup = trim($vstup);
        $vstup = htmlspecialchars($vstup);
        $vstup = stripslashes($vstup);
        return $vstup;
    }

    date_default_timezone_set("Europe/Bratislava");

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        if(trim($_POST['odpoved']) == $_POST['spravnaOdpoved']) {

            $suborPrispevky = fopen("prispevky.csv","a");

            $novyPrispevok[] = kontrola($_GET['pocet'] + 1);
            $novyPrispevok[] = kontrola($_POST['meno']);
            $novyPrispevok[] = kontrola($_POST['sprava']);
            $novyPrispevok[] = date('Y-m-d H:i:s', time());
            
            $chyba[0] = 'Prispevok bol úspešne pridaný.';
            $chyba[1] = 'success';

            fputcsv($suborPrispevky, $novyPrispevok, ';');
            fclose($suborPrispevky);

        }
        else {
            $chyba[0] = 'Nesprávna odpoveď.';
            $chyba[1] = 'warning';
            $meno = kontrola($_POST['meno']);
            $sprava = kontrola($_POST['sprava']);
        }
    }

    $suborCaptcha = file('captcha.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $antiSpam = [];

    for ($i = 0; $i < count($suborCaptcha); $i += 2) {
        $antiSpam[str_replace("odpoved: ","", $suborCaptcha[$i + 1])] = str_replace("otazka: ", "", $suborCaptcha[$i]);
    }

    $antiSpamKluc = array_rand($antiSpam);

    $prispevky = [];
    $suborPrispevky = fopen('prispevky.csv', 'r');

    while ($prispevok = fgetcsv($suborPrispevky,1000, ';')) {
        $prispevky[] = $prispevok;
    }

    fclose($suborPrispevky);

    $prispevky = array_reverse($prispevky);

    if(!empty($chyba)) { ?>
        <div class="alert alert-<?php echo $chyba[1]; ?> aler-dismissible fade show" role="alert">
            <strong><?php echo $chyba[0]; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php unset($chyba); } ?>

<div class="container">
    <h1>Fórum</h1>

    <form class="was-validated" action="?pocet=<?php echo count($prispevky); ?>" method="POST">
        <input type="hidden" name="spravnaOdpoved" value="<?php echo $antiSpamKluc; ?>">
        <div class="form-group">
            <label for="i1"><b>Meno</b></label>
            <input type="text" value="<?php echo (isset($_POST['meno']) ? $_POST['meno'] : ""); ?>" pattern="\S(.*\S)?" id="i1" name="meno" class="form-control" placeholder="Zadaj meno..." required>
            <div class="invalid-feedback">
                Prosíme vyplniť túto položku.
            </div>
        </div>
        <div class="form-group">
            <label for="i2"><b>Správa</b></label>
            <textarea id="i2" name="sprava" pattern="\S(.*\S)?" class="form-control" placeholder="Zadaj text správy..." rows="3" required><?php echo (isset($_POST['sprava']) ? $_POST['sprava'] : ""); ?></textarea>
            <div class="invalid-feedback">
                Prosíme vyplniť text správy.
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 form-group">
                <label for="i3"><small><b>Otázka: </b><?php echo $antiSpam[$antiSpamKluc]; ?></small></label>
                <input type="text" pattern="\S+" id="i3" name="odpoved" class="form-control" placeholder="<?php echo $antiSpam[$antiSpamKluc]; ?>" required>
                <div class="invalid-feedback">
                    Prosíme vyplniť túto položku so správnou odpoveďou na otázku.
                </div>
            </div>
            <div class="col-md-4">
                <button type="reset" class="btn btn-dark">Vymazať</button>
                <button type="submit" class="btn btn-info">Odoslať</button>
            </div>
        </div>
    </form>

    <?php

        foreach ($prispevky as $prispevok) {
            $datum = date_format(date_create($prispevok[3]),'d.m.Y H:i');

    ?>

        <h4><?php echo $prispevok[1]; ?></h4>
        <small>Odoslané: <i><?php echo $datum; ?></i></small>
        <p><?php echo nl2br($prispevok[2]); ?></p>
        <hr>

    <?php

        }

    ?>

</div>
<?php
include '../../assets/footer.php';
?>
