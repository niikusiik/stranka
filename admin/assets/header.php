<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark container sticky-top">
        <a class="navbar-brand" href="../../../public/theme/domov">Prax</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php
                    $aktivnaStranka = basename($_SERVER['SCRIPT_NAME'],'.php');
                    $menu = [];
                    $riadky=file('../../../public/assets/menu.txt',FILE_SKIP_EMPTY_LINES);



                    foreach ($riadky as $riadok) {
                        list($k,$h)=explode('::', $riadok);
                        $menu[$k]=$h;
                    }
                    foreach ($menu as $kluc => $hodnota) {
                    echo '
                        <li class="nav-item">
                        <a class="nav-link '.($aktivnaStranka == $kluc? "active":"").'" href="../../../public/theme/'.$kluc.'/index.php">' .$hodnota . '</a>
                        </li>';
                    }
                ?>
            </ul>

    </nav>
</div>
