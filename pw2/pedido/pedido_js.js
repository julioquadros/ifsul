$().ready(function () {
    ajxMostrarDadosPedido();
    $("#telaVerificaPagamento").hide();

    //alert("Carregando JavaScript");

    function ajxMostrarDadosPedido() {
        $.ajax({
            url: 'pedido_control.php',
            dataType: 'json',
            type: 'POST',
            timeout: 3000,
            data: {acao: 'listarDadPedido'},
            beforeSend: function () {
                $("#mensagem").html('Carregando');
            },
            success: function (dados) {
                $("#endereco").html(dados[0]);
                $("#bairro").html(dados[1]);
                $("#cidade").html(dados[2]);
                $("#cep").html(dados[3]);
                $("#telefone").html(dados[4]);
                $("#valorTotalProdutos").html(dados[5].replace(".", ","));
                $("#valorFrete").html(dados[6].replace(".", ","));
                $("#valorTotalPedido").html(dados[7]);

                $("#mensagem").html('Dados Carregados');
            }
        });
    }
    $('#btnVerificarCartao').on('click', function () {
        var verificaFormulario = "";
        var nome = $("#nome").val();
        if (nome === "") {
            verificaFormulario = verificaFormulario + "Campo Nome é obrigatório!<br> ";
        }

        var num_cartao = $("#num_cartao").val();
        if (num_cartao === "") {
            verificaFormulario = verificaFormulario + "Campo Número do Cartão é obrigatório!<br> ";
        }
        var mes_val_cartao = $("#mes_val_cartao").val();
        if (mes_val_cartao === "") {
            verificaFormulario = verificaFormulario + "Campo Mês de Validade do Cartão é obrigatório!<br> ";
        }
        var ano_val_cartao = $("#ano_val_cartao").val();
        if (ano_val_cartao === "") {
            verificaFormulario = verificaFormulario + "Campo Ano de Validade do Cartão é obrigatório!<br> ";
        }
        var cod_seguranca = $("#cod_seguranca").val();
        if (cod_seguranca === "") {
            verificaFormulario = verificaFormulario + "Campo Código de Segurança do Cartão é obrigatório!<br> ";
        }

        if (verificaFormulario === "") {

            $.ajax({
                url: 'pedido_control.php',
                dataType: 'json',
                type: 'POST',
                timeout: 3000,
                data: {acao: 'verificarCartao', nome: nome, num_cartao: num_cartao, mes_val_cartao: mes_val_cartao, ano_val_cartao: ano_val_cartao, cod_seguranca: cod_seguranca},
                beforeSend: function () {
                    $("#mensagem").html('Verificando Dados do Cartão');
                },
                success: function (dados) {
                    if (dados === "CartaoValido") {
                        $("#ResumoCompra").html("Dados do Cartão Validados, a Operadora já aprovou seu Pagamento");
                        $("#telaFinalizarPedido").hide();
                        $("#telaVerificaPagamento").show();
                    } else {
                        $("#mensagem").html("Dados do Cartão Inválidos, por favor Verifique e tente novamente"); 
                    }
                }
            });
        } else {
            $("#mensagem").html(verificaFormulario);
        }

    });

//    function ajxVerificarCartao() {
//        var $nome = 
//        
//    }

});
