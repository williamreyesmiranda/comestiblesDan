<?php
session_start();
include("../db/Conexion.php");

$idUser = $_SESSION['iduser'];
$obs = $_POST['obs'];
$idProducto = $_POST['idProducto'];
$cantidades = $_POST['cantidad'];
$conexion = new Conexion();

$consultaSQL = "INSERT INTO pedidos (id_usuario, observaciones) values ('$idUser','$obs' )";
$insert = $conexion->agregarDatos($consultaSQL);
if ($insert == 1) {
    $consultaSQL = "SELECT MAX(id_pedido) as 'MAX' FROM pedidos";
    $result = $conexion->consultarDatos($consultaSQL);
    $max = $result[0]['MAX'];
    $contar = 0;
    foreach ($cantidades as $cantidad) {
        if ($cantidad > 0) {
            $consultaSQL = "INSERT INTO pedidos_detalle (id_pedido, id_producto, cantidad) values ($max, $idProducto[$contar], $cantidad)";
            $insert = $conexion->agregarDatos($consultaSQL);
        }
        $contar++;
    }
}

echo json_encode($insert);
