<?php 
    include '../../assets/header.php';

    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        foreach ($users as $user) {

            list($username, $pass, $name, $type) = explode('::', $user);

            if($_POST['meno'] == $username && $_POST['heslo'] == $pass) {
                header('Location: ../domov/index.php');
                exit();
            }
            else {
                $chyba = true;
            }

        }

    }

?>

<div class="container">
    <div class="login bg-dark">
    <h1 class="text-center">Prihlásenie</h1>
    <?php
        if(isset($chyba)) {
            echo '<div class="alert alert-info" role="alert">
            Nesprávne meno alebo heslo!
        </div>';
            unset($chyba);
        }
    ?>

    <form class="was-validated" action="index.php" method="POST">
        <div class="form-group">
            <label for="i1"><b>Meno</b></label>
            <input type="text" pattern="\S(.*\S)?" id="i1" name="meno" class="form-control" placeholder="Zadaj meno..." required>
            <div class="invalid-feedback">
                Prosíme vyplniť túto položku.
            </div>
        </div>
        <div class="form-group">
            <label for="i2"><b>Heslo</b></label>
            <input type="password" pattern=".{5,}" id="i2" name="heslo" class="form-control" placeholder="Zadaj heslo..." required>
            <div class="invalid-feedback">
                Prosíme zadajte heslo. Musí obsahovať aspoň 5 znakov!
            </div>
        </div>
        <button type="submit" class="btn btn-outline-info">Prihlásiť sa</button>
        <br>
        <br>
        <a href="#">Zabudol som heslo</a><br>
        <a href="#">Registrácia</a>
    </form>

    </div>

</div>

<?php
    include '../../assets/footer.php';
?>
