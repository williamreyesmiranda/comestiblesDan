<?php
session_set_cookie_params(60 * 60 * 24);
session_start();
include("../db/Conexion.php");
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

    <title>Aprobar Pedido</title>
    <?php include "includes/scriptUp.php" ?>


</head>

<body>

    <div id="wrapper">
        <?php include "includes/navBar.php" ?>


        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- inicio de cuerpo de trabajo -->
                    <div class="col-lg-12">
                        <h1 class="page-header">Aprobación De Pedidos</h1>
                    </div>

                    <div id="tablaAprobacion"></div>
                </div>

            </div>

        </div>


    </div>

    <?php include "includes/scriptDown.php" ?>

    <script>
        $(document).ready(function() {
            $('#tablaAprobacion').load('tablaAprobar.php')

        });
    </script>

</body>

</html>