<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
?>
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
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php include("../db/Conexion.php");

        $conexion = new Conexion();
        $consultaSQL = "SELECT DISTINCT pe.id_pedido, pe.fecha, pe.observaciones, usu.nombre, usu.cedula, (SELECT COUNT(id_pedido) FROM pedidos_detalle WHERE id_pedido=pe.id_pedido) productos, (SELECT SUM(cantidad) FROM pedidos_detalle WHERE id_pedido=pe.id_pedido) cantidad,
                        (SELECT SUM(pd.cantidad*pr.precio) suma FROM pedidos_detalle pd INNER JOIN productos pr ON pd.id_producto=pr.id_producto WHERE id_pedido=pe.id_pedido) precio FROM pedidos AS pe 
                        INNER JOIN usuario AS usu ON pe.id_usuario = usu.idusuario INNER JOIN pedidos_detalle AS det ON pe.id_pedido = det.id_pedido WHERE pe.estado=0";
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
                <td>
                    <h3>
                        <a class="my-auto" title=" Aprobar Pedido" data-toggle="modal" data-target="#editarAsesor"><i class="fa fa-check my-auto" style="cursor:pointer;" onclick="aprobarPedido(`'<?php echo ($datos); ?>'`)"></i></a>
                        <a class="my-auto" title=" Anular Pedido" data-toggle="modal" data-target="#editarAsesor"><i class="fa fa-close my-auto" style="cursor:pointer;" onclick="cancelarPedido(`'<?php echo ($datos); ?>'`)"></i></a>
                    </h3>
                </td>
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
                                    <div class="row " style="margin-top: 10px; vertical-align: auto;">
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