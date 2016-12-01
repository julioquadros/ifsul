<?php
require '../conexao/conecta.php';
?>
<table>

    <?php
    while (!$rs->EOF) { // enquanto não for fim dos registros
        $ped_id = $rs->fields['ped_id'];
        $pro_id = $rs->fields['pro_id'];
        $ite_qtd = $rs->fields['ite_qtd'];
        $ite_valor = $rs->fields['ite_valor'];
        ?>

        <tr>
            <td align="center"><?php echo $ped_id; ?> </td>
            <td align="center"><?php echo $pro_id; ?></td>
            <td align="center"><?php echo $ite_qtd; ?></td>
            <td align="right"><?php echo 'R$ ' . number_format($ite_valor, 2, ',', '.') . "  "; ?></td>
            <td align="center"><a data-toggle="modal" href="#form-content" class="altera_cheque" href="">Alterar</a></td>
            <td align="center"><a class="exclui_cheque" href="">Excluir</a></td>
        </tr>
        <?php
        $rs->MoveNext(); //move para próximo registro
    }
    ?>
</table>

