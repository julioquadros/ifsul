<?php

include('../conexao/conecta.php');
include('cesta_compras_class.php');
$mod = new Cesta_Compras(); // criando objeto a partir da classe Cidade

if (isset($_REQUEST['acao'])) //se chegou acao por GET ou POST
    $acao = $_REQUEST['acao'];
else
    $acao = "";

if ($acao == "") {  // mostra a listagem
    $rs = $mod->listarCestaItens();
}

//if ($acao == "listar") {
//   echo  $rs = $mod->listarTabela();
//}
//
//if ($acao == "listarAlterar") {
//   echo  $rs = $mod->listarAlterar($_REQUEST['cheque_id']);
//}
//
//if ($acao == "alterar") {
//   echo  $rs = $mod->alterar($_REQUEST['cheque_id']);
//}
//
//if ($acao == "excluir") {
//    echo $mod->excluir($_REQUEST['cheque_id']);
//}
//
//if ($acao == "gravarIncluir") {
//    echo $mod->gravarIncluir($_REQUEST['data_emissao'], $_REQUEST['data_deposito'], $_REQUEST['taxa_juro_mensal'], $_REQUEST['valor'], $_REQUEST['tipo_pessoa']);
//    
//}
//if ($acao == "gravarAlterar") {
//  echo  $mod->gravarAlterar($_REQUEST['cheque_id'],$_REQUEST['data_emissao'], $_REQUEST['data_deposito'], $_REQUEST['taxa_juro_mensal'], $_REQUEST['valor'], $_REQUEST['tipo_pessoa']);
//}

?>