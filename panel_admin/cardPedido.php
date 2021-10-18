<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}

include("../db/Conexion.php"); ?>
<form method="post" id="formRegistrarPedido">
    <?php $conexion = new Conexion();
    $consultaSQL = "SELECT * FROM productos order by familias";
    $productos = $conexion->consultarDatos($consultaSQL);
    foreach ($productos as $producto) : ?>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    <b><label for="cantidad<?php echo $producto['id_producto'] ?>"><?php echo $producto['descripcion'] ?></label></b>
                </div>
                <div class="panel-body">
                    <center><a href="" data-toggle="modal" data-target="#myModal<?php echo $producto['id_producto'] ?>"><img style="width: 50%;" src="../img/<?php echo $producto['referencia']; ?>.png"></a> </center>
                    <p><b>Referencia: </b> <?php echo $producto['referencia']; ?></p>
                    <p><b>Peso: </b> <?php echo $producto['peso']; ?> gr</p>
                    <p><b>Unidades: </b> <?php echo $producto['unidades']; ?></p>
                    <p><b>Familia: </b> <?php echo $producto['familias']; ?></p>
                    <center>
                        <h4><b>Precio Venta: </b>$ <?php echo number_format($producto['precio'], 2, ',', '.'); ?></h4>
                    </center>
                </div>
                <div class="panel-footer">
                    <input type="hidden" name="idProducto[]" value="<?php echo $producto['id_producto']; ?>">
                    <input type="number" id="cantidad<?php echo $producto['id_producto'] ?>" class="form-control" name="cantidad[]" style="width: 100px;" placeholder="Cantidad a Pedir" autocomplete="off">
                </div>
            </div>
        </div>
        <!-- modal -->
        <div class="modal fade" id="myModal<?php echo $producto['id_producto'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo $producto['referencia']; ?>-<?php echo $producto['descripcion']; ?></h4>
                        </div>
                        <div class="modal-body">
                        <center><img style="width: 70%;" src="../img/<?php echo $producto['referencia']; ?>.png"></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
    <?php endforeach ?>

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading text-center">
                <label for="obs">OBSERVACIONES</label>
            </div>
            <div class="panel-body">
                <textarea class="form-control" name="obs" id="obs" rows="5"></textarea>
            </div>

        </div>
    </div>

    <div class="text-center">
        <button type="button" class="btn btn-info" name="" onclick="registrarPedido()">Registrar Pedido</button>
    </div>



</form>