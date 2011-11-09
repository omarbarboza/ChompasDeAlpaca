<?php
require_once '../model/Chompa.php';
require_once '../model/Pedido.php';

$pedido= new Pedido(6,6,6);
//print_r($pedido);
//$pedido->insertarPedido();
//echo $pedido->get_fecha()->format('Y-m-d');
var_dump($pedido->getAllPedidos());

?>
