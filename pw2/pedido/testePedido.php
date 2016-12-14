<?php
    include_once('../../config.php');
    include_once('./pedido_control.php');
    
    
    $pedido = new finalizarPedido();
//    
//    $pedido->listar();
//    echo "<br>";
    //$pedido->gerarPedido(597.00, 34.80, 3);
    echo "<br>";
    //$pedido->mostrarDadosTelaPedido();
    
    $pedido->listarDadosPedido();
    echo "<br>";
    echo var_dump($pedido->verificarCartao('Julio', '4914999999995116' , '10', '2018', '321'));