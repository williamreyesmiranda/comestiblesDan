<?php
session_start();
if (!empty($_SESSION['active'])){
    header('location: panel_admin/');
  }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="img/logo-dan.png">
        <title>Inicio Sesión</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- SweetAlert -->
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

       
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading text-center ">
                            <img src="img/logo-dan.png" alt="">
                        </div>
                        <div class="panel-body">
                            <form role="form" action=""  method="POST" id="formLogin">
                                
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Usuario" id="usuario" name="usuario" type="text" autofocus autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Contraseña" id="password" name="password" type="password" autocomplete="off">
                                    </div>
                                                                        <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" name="submit" id="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        
        <script src="plugins/jquery/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/startmin.js"></script>
        <!-- SweetAlert -->
        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
        <script src="js/scripts.js"></script>


    </body>
</html>
