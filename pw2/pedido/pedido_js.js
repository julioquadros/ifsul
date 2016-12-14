$().ready(function () {
    ajxMostrarDadosPedido();
 
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
            }
        });
    }

});
