<?php
include("../db/Conexion.php");


$idPedido = $_POST['idPedido'];
$estado = $_POST['estado'];
$respuesta = $_POST['respuesta'];
$conexion = new Conexion();

$consultaSQL = "UPDATE pedidos SET estado=$estado, respuesta='$respuesta' WHERE id_pedido=$idPedido";
$update = $conexion->editarDatos($consultaSQL);

echo json_encode($update);
