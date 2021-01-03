<?php

require 'Classes/Statements.php';

$statements = new Statements();
$employees = $statements->getAllEployeesComputersAndProducts();
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
        </nav>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nume</th>
                <th scope="col">Prenume</th>
                <th scope="col">Nr. Legitimatie</th>
                <th scope="col">Descriere Computer</th>
                <th scope="col">Nr. Inventar</th>
                <th scope="col">Tip licenta</th>
                <th scope="col">Produs</th>
                <th scope="col">Producator</th>
                <th scope="col">Valoare</th>
                <th scope="col">Document</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($employees as $key => $employee): ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $employee['nume'] ?></td>
                        <td><?= $employee['prenume'] ?></td>
                        <td><?= $employee['nr_legitimatie'] ?></td>
                        <td><?= $employee['descriere'] ?></td>
                        <td><?= $employee['nr_inventar'] ?></td>
                        <td><?= $employee['tip'] ?></td>
                        <td><?= $employee['produs'] ?></td>
                        <td><?= $employee['producator'] ?></td>
                        <td><?= $employee['valoare'] ?></td>
                        <td><?= $employee['document'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>