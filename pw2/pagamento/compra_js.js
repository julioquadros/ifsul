
$().ready(function () {
    var _row = null;
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.percent').mask('##0,00', {reverse: true});
    //alert("Carregando o JS Corretamente");

    //--------- 
//    $(function () {
////twitter bootstrap script
//        $("button#submit").click(function () {
//            $.ajax({
//                type: "POST",
//                url: "process.php",
//                data: $('form.contact').serialize(),
//                success: function (msg) {
//                    $("#thanks").html(msg)
//                    $("#form-content").modal('hide');
//                },
//                error: function () {
//                    alert("failure");
//                }
//            });
//        });
//    });

    function limpar() {
        $("#cheque_id").val("");
        $("#data_emissao").val("");
        $("#data_deposito").val("");
        $("#taxa_juro_mensal").val("");
        $("#valor").val("");
        $("#tipo_pessoa").val("");
    }

    //--------------------LINK EXCLUIR--------------------------
    $(document).on('click', '.exclui_cheque', function (event) {
        event.preventDefault();
        _row = $(this).parents("tr");
        var cols = _row.children("td");
        var cheque_id = $(cols[0]).text();
        var self = $(this);

        $("#mensagem").html("ID: " + cheque_id);
        $.ajax({
            url: 'cheques_control.php',
            dataType: 'html',
            type: 'POST',
            data: {acao: 'excluir', cheque_id: cheque_id},
            success: function (data) {
                self.closest("tr").remove();
                $("#mensagem").html("Teste Excluir!");
            }
        })
    });
    //--------------------LINK ALTERAR--------------------------

    $(document).on('click', '.altera_cheque', function (event) {
        event.preventDefault();
        _row = $(this).parents("tr");
        var cols = _row.children("td");
        var cheque_id = $(cols[0]).text();
        $("#mensagem").html("Teste Alterar!");

        $.ajax({
            url: 'cheques_control.php',
            dataType: 'json',
            type: 'POST',
            data: {acao: 'listarAlterar', cheque_id: cheque_id},
            success: function (dados) {
                $("#cheque_id").val(dados[0]);
                $("#data_emissao").val(dados[1]);
                $("#data_deposito").val(dados[2]);
                $("#taxa_juro_mensal").val(dados[3]);
                $("#valor").val(dados[4]);
                $("#tipo_pessoa").val(dados[5]);
                $("#mensagem").html("Dados Preenchidos!");
            }
        })
    });
    //--------------------BOTÃO NOVO --------------------------

    $('#btnNovo').on('click', function (event) {
    });
    //--------------------BOTÃO GRAVAR --------------------------

    $('#btnGravar').on('click', function (event) {
        var cheque_id = $("#cheque_id").val();
        var data_emissao = $("#data_emissao").val();
        var data_deposito = $("#data_deposito").val();
        var taxa_juro_mensal = $("#taxa_juro_mensal").val();
        var valor = $("#valor").val();
        var tipo_pessoa = $("#tipo_pessoa").val();
        var acao = "gravarIncluir";
        if (cheque_id !== "") {
            acao = "gravarAlterar";
        }

        $.ajax({
            url: 'cheques_control.php',
            dataType: 'html',
            type: 'POST',
            data: {acao: acao, cheque_id: cheque_id, data_emissao: data_emissao, data_deposito: data_deposito, taxa_juro_mensal: taxa_juro_mensal, valor: valor, tipo_pessoa: tipo_pessoa},
            success: function (dados) {
                if (acao === "gravarIncluir") {
                    $("#tabCheques").append(dados);
                    $("#mensagem").html("Registro Incluido com Sucesso!");
                } else {
                    $("tr td:first-child:contains('" + cheque_id + "')").closest("tr").replaceWith(dados);
                    $("#mensagem").html("Registro Alterado com Sucesso!");
                }

                limpar();
            }
        })

    });
    //--------------------CANCELAR--------------------------
    $('#btnCancelar').on('click', function (event) {
        limpar();
    });

    //--------------------FILTRAR--------------------------
    $('#btnFiltrar').on('click', function (event) {
    });


});