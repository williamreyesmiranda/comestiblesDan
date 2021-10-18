<?php
session_set_cookie_params(60 * 60 * 24);
session_start();
// include("../db/Conexion.php");
date_default_timezone_set('America/Bogota');

if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/logo-dan.png">

    <title>Montar Pedido</title>
    <?php include "includes/scriptUp.php" ?>

</head>

<body>

    <div id="wrapper">
        <?php include "includes/navBar.php" ?>

        <br><br>
        <div id="page-wrapper">
          <div id="cardPedido"></div>

        </div>


    </div>
    <?php include "includes/scriptDown.php" ?>
    <script>
        $(document).ready(function() {
            $('#cardPedido').load('cardPedido.php');
        })
    </script>

</body>

</html>