<?php
    include_once('../../conecta.php');
    include_once('./pedido_class.php');
    $pedido = new finalizarPedido();

    if (isset($_REQUEST['acao'])) //se chegou acao por GET ou POST
        $acao = $_REQUEST['acao'];
    else
        $acao = "";

    if ($acao == "") {  
        // mostra a listagem
        $rs = $pedido->listar();
    }
    if ($acao == "listarDadPedido") {  
        // mostra o endereco
        echo $rs = $pedido->listarDadosPedido();
    }
    if ($acao == "verificarCartao") {  
        // mostra o endereco
        echo $rs = $pedido->verificarCartao($_REQUEST['nome'], $_REQUEST['num_cartao'], $_REQUEST['mes_val_cartao'], $_REQUEST['ano_val_cartao'], $_REQUEST['cod_seguranca']);
    }
?>


