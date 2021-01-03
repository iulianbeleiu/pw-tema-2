<?php

require 'Sql/Query.php';

$statements = new Query();
$articole = $statements->toateArticolele();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produs = $_POST['produs'];
    $pretBucata = $_POST['pret_bucata'];
    $articoleVerificate = $statements->verificaArticole($produs, $pretBucata);

    if (count($articoleVerificate) == 0) {
        $mesaj = 'Nu a fost gasit niciun articol';
    } elseif (count($articoleVerificate) == 1) {
        $articole = $articoleVerificate;
    } elseif (count($articoleVerificate) == 2) {
        $magic = $statements->doMagic($articoleVerificate);
        $articole = $statements->toateArticolele();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Tema 2</title>
</head>
<body>
<div class="container">
    <nav class="navbar sticky-top navbar-light bg-light mt-4">
        <a class="navbar-brand" href="index.php">Acasa</a>
        <a class="navbar-brand" href="ex1.php">Ex 1</a>
        <a class="navbar-brand" href="ex2.php">Ex 2</a>
        <a class="navbar-brand" href="ex3.php">Ex 3</a>
        <a class="navbar-brand" href="ex4.php">Ex 4</a>
    </nav>

    <form class="mt-5" method="post">
        <div class="row">
            <p class="col"><?= $mesaj ?></p>
        </div>
        <div class="row">
            <div class="col">
                <label for="produs">Produs</label>
                <input type="text" class="form-control" id="produs" name="produs">
            </div>
            <div class="col">
                <label for="pret_bucata">Pret Bucata</label>
                <input type="text" class="form-control" id="pret_bucata" name="pret_bucata">
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Verifica</button>
        </div>
    </form>

    <?php if (isset($articole)): ?>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Produs</th>
                <th scope="col">Bucati</th>
                <th scope="col">Pret Bucata</th>
                <th scope="col">Pret Total</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($articole as $key => $articol): ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $articol['produs'] ?></td>
                    <td><?= $articol['bucati'] ?></td>
                    <td><?= $articol['pret_bucata'] ?></td>
                    <td><?= $articol['pret_total'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>