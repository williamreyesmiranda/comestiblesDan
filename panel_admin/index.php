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
                        <br><br><br>
                        <table class="table table-striped table-bordered table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>idPedido</th>
                                    <th>NIT/CC</th>
                                    <th>Cliente</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Total Productos</th>
                                    <th>Total Unidades</th>
                                    <th>Precio Total</th>
                                    <th>Observacion</th>
                                    <th>Estado</th>
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                $conexion = new Conexion();
                                $consultaSQL = "SELECT DISTINCT pe.id_pedido, pe.fecha, pe.observaciones, usu.nombre, usu.cedula, (SELECT COUNT(id_pedido) FROM pedidos_detalle WHERE id_pedido=pe.id_pedido) productos, (SELECT SUM(cantidad) FROM pedidos_detalle WHERE id_pedido=pe.id_pedido) cantidad,
                        (SELECT SUM(pd.cantidad*pr.precio) suma FROM pedidos_detalle pd INNER JOIN productos pr ON pd.id_producto=pr.id_producto WHERE id_pedido=pe.id_pedido) precio, es.nombre_estado, pe.respuesta FROM pedidos AS pe 
                        INNER JOIN usuario AS usu ON pe.id_usuario = usu.idusuario INNER JOIN pedidos_detalle AS det ON pe.id_pedido = det.id_pedido 
                        INNER JOIN estado es  ON pe.estado=es.id_estado";
                                $pedidos = $conexion->consultarDatos($consultaSQL);
                                foreach ($pedidos as $pedido) :
                                    $datos = $pedido['fecha'] . "||" . $pedido['id_pedido'] . "||" . $pedido['observaciones'] .
                                        "||" . $pedido['productos'] . "||" . $pedido['cantidad'] . "||" . $pedido['nombre'] . "||" . $pedido['cedula'] . "||" . $pedido['precio']; ?>
                                    <tr class="text-center">
                                        <td><?php echo ($pedido['id_pedido']); ?></td>
                                        <td><?php echo ($pedido['cedula']); ?></td>
                                        <td><?php echo ($pedido['nombre']); ?></td>
                                        <td><?php echo ($pedido['fecha']); ?></td>
                                        <td><button type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal<?php echo ($pedido['id_pedido']); ?>"><?php echo ($pedido['productos']); ?></button></td>
                                        <td><?php echo ($pedido['cantidad']); ?></td>
                                        <td>$<?php echo number_format($pedido['precio'], 2, ',', '.'); ?></td>
                                        <td><?php echo ($pedido['observaciones']); ?></td>
                                        <td><?php echo ($pedido['nombre_estado']); ?></td>
                                        <td><?php echo ($pedido['respuesta']); ?></td>
                                    </tr>
                                    <div class="modal fade" id="myModal<?php echo ($pedido['id_pedido']); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Pedido N°<?php echo ($pedido['id_pedido']); ?>, Cliente: <?php echo ($pedido['nombre']); ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <strong>Ref</strong>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <strong>Descripción</strong>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <strong>Unds</strong>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <strong>Precio</strong>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <strong>Total</strong>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <strong>Imagen</strong>
                                                            </div>
                                                        </div>
                                                    </center>
                                                    <hr>
                                                    <?php
                                                    $idPedido = $pedido['id_pedido'];
                                                    $consultaSQL = "SELECT pd.id_producto, pr.referencia, pr.descripcion, pd.cantidad, pr.precio
                                            FROM pedidos AS pe INNER JOIN pedidos_detalle AS pd ON pe.id_pedido = pd.id_pedido
                                            INNER JOIN productos AS pr ON pd.id_producto = pr.id_producto WHERE pe.id_pedido=$idPedido";
                                                    $productos = $conexion->consultarDatos($consultaSQL);
                                                    foreach ($productos as $producto) : ?>
                                                        <center>
                                                            <div class="row " style="vertical-align: auto;">
                                                                <div class="col-md-1">
                                                                    <?php echo ($producto['referencia']); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php echo ($producto['descripcion']); ?>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <?php echo ($producto['cantidad']); ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    $<?php echo number_format($producto['precio'], 2, ',', '.'); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    $<?php echo (number_format($producto['precio'] * $producto['cantidad'], 2, ',', '.')); ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <img src="../img/<?php echo ($producto['referencia']); ?>.png" style="width:100%">
                                                                </div>
                                                            </div>
                                                        </center>
                                                        <hr>

                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                <?php endforeach  ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>


    </div>

    <?php include "includes/scriptDown.php" ?>
    
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "order": [
                [0, "asc"]
            ],
            "pageLength": 25

        });

    });
</script>

</body>

</html>