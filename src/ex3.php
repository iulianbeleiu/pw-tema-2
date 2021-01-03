<?php

require 'Classes/Statements.php';

$statements = new Statements();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $statements->adaugaArticole($_POST);
    $articole = $statements->articole();
}
$articole = $statements->articole();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Tema 2</title>
</head>
<body>
<div class="container">
    <nav class="navbar sticky-top navbar-light bg-light mt-4">
        <a class="navbar-brand" href="index.php">Acasa</a>
        <a class="navbar-brand" href="ex1.php">Ex 1</a>
        <a class="navbar-brand" href="ex2.php">Ex 2</a>
        <a class="navbar-brand" href="ex3.php">Ex 3</a>
    </nav>
    <form class="mt-5" method="post">
        <div class="row">
            <p class="col">Articol 1</p>
        </div>
        <div class="row">
            <div class="col">
                <label for="nume1">Nume</label>
                <input type="text" class="form-control" id="nume1" name="nume1">
            </div>
            <div class="col">
                <label for="pret1">Pret</label>
                <input type="text" class="form-control" id="pret1" name="pret1">
            </div>
            <div class="col">
                <label for="cantitate1">Cantitate</label>
                <input type="number" class="form-control" id="cantitate1" name="cantitate1">
            </div>
        </div>

        <div class="row mt-5">
            <p class="col">Articol 2</p>
        </div>
        <div class="row">
            <div class="col">
                <label for="nume2">Nume</label>
                <input type="text" class="form-control" id="nume2" name="nume2">
            </div>
            <div class="col">
                <label for="pret2">Pret</label>
                <input type="text" class="form-control" id="pret2" name="pret2">
            </div>
            <div class="col">
                <label for="cantitate2">Cantitate</label>
                <input type="number" class="form-control" id="cantitate2" name="cantitate2">
            </div>
        </div>
        <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Adauga</button>
        </div>
    </form>

    <?php if (isset($articole)): ?>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nume</th>
                <th scope="col">Cantitate</th>
                <th scope="col">Pret</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articole as $key => $articol): ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><?= $articol['nume'] ?></td>
                    <td><?= $articol['cantitate'] ?></td>
                    <td><?= $articol['pret'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
</html>
