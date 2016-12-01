$().ready(function () {

    $(document).on('click', '.calcFrete', function (event) {
        event.preventDefault();
                let
        $cep = $("#CEP").val(),
                $reg = /^\d{5}(-\d{3})?$/;
        if ($cep == "") {
            $("#tipo_entrega").html('<br><label class="alert alert-danger col-md-12">Por favor informe o CEP para calcular o frete!</label>');
            return;
        }
        if (!$reg.test($cep)) {
            $("#tipo_entrega").html('<br><label class="alert alert-danger col-md-12">Por favor informe um CEP válido para calcular o frete!</label>');
            return;
        }
        $.ajax({
            url: 'calcFrete_control.php',
            dataType: 'html',
            type: 'POST',
            data: {acao: 'calcFrete', cep: $cep},
            beforeSend: function () {
                $("#tipo_entrega").html('Aguardando a resposta dos Correios. <img src="">!');
            },
            success: function (dados) {
                $("#tipo_entrega").html(dados);
            }
        });
    });

    $(document).on('change', '#entrega', function () {
        //alert($('input[name=entrega]:checked').val());
        let
        $servico;
                switch ($('input[name=entrega]:checked').val()) {
            case '41106':
                $servico = 'PAC';
                break;
                //case 40045: $servico = 'SEDEX a Cobrar';
                //break;
            case '40215':
                $servico = 'SEDEX 10';
                break;
                //case 40290: $servico = 'SEDEX Hoje';
                //break;
            default:
                $servico = 'SEDEX';
        }
        $('.modalidade').text(' (' + $servico + ')');
        $('.precoFrete').text($('.val_frete' + $('input[name=entrega]:checked').val()).text());
        //console.info( parseFloat( $('.precoFrete').text().replace(",", ".") ) );
        $('.valorTotal').text(parseFloat($('.valorProdutos').text().replace(",", ".")) + parseFloat($('.precoFrete').text().replace(",", ".")));
        $('.valorTotal').text(parseFloat($('.valorTotal').text()).toFixed(2).replace(".", ","));
    });
//    var somatorio = 0;
//    $('table').each(function () {
//        var $this = $(this),
//                valor_unitario_item = parseFloat($this.find(".valor_unitario_item").val(), 10),
//                valor_total_item = parseFloat($this.find(".valor_total_item").val(), 10);
//        $this.find(".jantotal").html(valor_unitario_item);
//        somatorio += janmembros || 0;
//    });
//    $(".total").html(somatorio);
});
