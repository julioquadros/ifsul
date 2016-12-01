<?php
include('../config.php');
include('cheques_control.php');
include('../funcoes.php');
?>
<!DOCTYPE html> 
<html lang="pt-br"> 
    <head> 
        <meta charset="utf-8"> 
        <title>Sistema de controle de cheques</title> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> 
        <script src="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
        <script src="cheques_js.js" type="text/javascript"></script>
        <script src="../js/jQuery-Mask/jquery.mask.min.js" type="text/javascript"></script>
        <!--<link rel="stylesheet" href="../css/css.css">-->
    </head>
    <body>
        <div class="container">
            <h4>Gerenciamento de Cheques</h4>
            <div id="thanks">
                <p>
                    <a data-toggle="modal" href="#form-content" class="btn btn-primary">Inclusão de Cheques</a>
                </p>
            </div>
            <!-- model content -->	
            <div id="form-content" class="modal hide fade in" style="display: none; ">
                <div class="modal-header">
                    <a class="close" data-dismiss="modal">×</a>
                    <h3>Inclusão de Cheques</h3>
                </div>
                <div>
                    <form class="contact">
                        <fieldset>
                            <div class="modal-body">
                                <table  class="contact" width="500" border="1" align="center" cellpadding="3" cellspacing="0">
                                    <tr>
                                        <td width="150" align="right">Código do Cheque:</td>
                                        <td><input name="cheque_id" type="text" id="cheque_id" value="" size="10" maxlength="10" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <td align="right">Data de Emissão:</td>
                                        <td><input required name="data_emissao" type="date" id="data_emissao" value="<?php echo date("Y-m-d") ?>" size="40" maxlength="40"></td>
                                    </tr>
                                    <tr>
                                        <td align="right">Data de Depósito:</td>
                                        <td><input required name="data_deposito" type="date" id="data_deposito" value="<?php echo date("Y-m-d") ?>" size="40" maxlength="40"></td>
                                    </tr>
                                    <tr>
                                        <td align="right">Taxa de Juro Mensal:</td>
                                        <td><input class="percent" required name="taxa_juro_mensal" type="text" id="taxa_juro_mensal" value="" size="8" maxlength="40">%</td>
                                    </tr>
                                    <tr>
                                        <td align="right">Valor:</td>
                                        <td>R$: 
                                            <input class="money" required name="valor" type="text" id="valor" value="" size="20" maxlength="40"></td>
                                    </tr>
                                    <tr>
                                        <td align="right">Tipo de Pessoa:</td>
                                        <td>
                                            <select name="tipo_pessoa" id="tipo_pessoa">
                                                <option value="">Escolha Uma Opção</option>
                                                <option value="F" selected>Pessoa Física</option>
                                                <option value="PJ">Pessoa Jurídica</option>
                                                <option value="Simples">Pessoa Jurídica Inscrito no Simples Nacional</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="button" name="btnGravar" id="btnGravar" value="Gravar">
                                            <input type="button" name="btnCancelar" id="btnCancelar" value="Cancelar">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="submit">submit</button>
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
            </div>
            <div id="titulo">Cheques Cadastrados</div>


            <table id="tabCheques" width="800" border="1" align="center" cellpadding="3" cellspacing="0">
                <thead>
                    <tr class="negrito">
                        <th width="30">Código</th>
                        <th width="120" align="center">Data de Emissão</th>
                        <th width="120" align="center"><a href="cheques.php?menu=cheques&amp;ordem=data_deposito">Data de Depósito</a></th>

                        <th width="150" align="center">Taxa de Juro Mensal</th>
                        <th width="100" align="center">Valor</th>
                        <th width="80" align="center">Tipo de Pessoa</th>
                        <th width="70" align="center">Alterar</th>
                        <th width="70" align="center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while (!$rs->EOF) { // enquanto não for fim dos registros
                        $cheque_id = $rs->fields['cheque_id'];
                        $data_emissao = $rs->fields['data_emissao'];
                        $data_deposito = $rs->fields['data_deposito'];
                        $taxa_juro_mensal = $rs->fields['taxa_juro_mensal'];
                        $valor = $rs->fields['valor'];
                        $tipo_pessoa = $rs->fields['tipo_pessoa'];
                        ?>
                        <tr>
                            <td align="center"><?php echo $cheque_id; ?> </td>
                            <td align="center"><?php echo date("d/m/Y", strtotime($data_emissao)); ?></td>
                            <td align="center"><?php echo date("d/m/Y", strtotime($data_deposito)); ?></td>
                            <td align="center"><?php echo number_format($taxa_juro_mensal, 2, '.', ',') . "%"; ?></td>
                            <td align="right"><?php echo 'R$ ' . number_format($valor, 2, ',', '.') . "  "; ?></td>
                            <td align="center"><?php echo $tipo_pessoa; ?></td>
                            <td align="center"><a data-toggle="modal" href="#form-content" class="altera_cheque" href="">Alterar</a></td>
                            <td align="center"><a class="exclui_cheque" href="">Excluir</a></td>
                        </tr>
                        <?php
                        $rs->MoveNext(); //move para próximo registro
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script>
            $(function () {
                //twitter bootstrap script
                $("button#submit").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "process.php",
                        data: $('form.contact').serialize(),
                        success: function (msg) {
                            $("#thanks").html(msg)
                            $("#form-content").modal('hide');
                        },
                        error: function () {
                            alert("failure");
                        }
                    });
                });
            });
        </script>
    </body>
</html>

