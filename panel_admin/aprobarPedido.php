<?php
include("../db/Conexion.php");


$idPedido = $_POST['idPedido'];
$estado = $_POST['estado'];
$conexion = new Conexion();

$consultaSQL = "UPDATE pedidos SET estado=$estado WHERE id_pedido=$idPedido";
$update = $conexion->editarDatos($consultaSQL);

echo json_encode($update);
