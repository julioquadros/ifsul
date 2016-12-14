<?php

class finalizaPedido {

    private $con, $bd; // para conexao
    private $sql; // para os comandos SQL
    private $res; // para resultado dos SQLs

    // metodo construtor

    public function __construct() {
        $this->con = new Conecta();
        $this->bd = $this->con->getBd();
    }

    public function listar() {
        $this->sqlConsultaCesta = "SELECT cesit.pro_id, cesit.cite_qtd, cesit.cite_valor, 
                                           cesta.cli_id, 
                                           pro.pro_descricao, pro_estoque, pro_promocao,
                                           cli.cli_endereco, cli.cli_bairro, cli.cli_cep, cli.cid_id, cli.cli_fone1,
                                           cid.cid_nome, cid.cid_uf
                                      FROM cesta_itens cesit, 
                                           cesta, 
                                           produtos pro, 
                                           clientes cli, 
                                           cidades cid
                                     WHERE cesit.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                                       AND cesit.ces_sessao = cesta.ces_sessao
                                       AND cesit.pro_id = pro.pro_id
                                       AND cesta.cli_id = cli.cli_id
                                       AND cli.cid_id = cid.cid_id";

        $this->resConsultaCesta = $this->bd->Execute($this->sqlConsultaCesta);
        echo $this->resConsultaCesta;
        return $this->resConsultaCesta;
    }

    public function finalizarPedido($totalPedido, $fretePedido, $prazoEntrega) {
        $this->sql = "SELECT pro.pro_id
                            FROM produtos pro, cesta_itens cesit
                           WHERE cesit.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                             AND cesit.pro_id = pro.pro_id";

        //echo $this->sql;

        $this->res = $this->bd->Execute($this->sql);
        while (!$this->res->EOF) {
            $idProd[] = $this->res->fields['pro_id'];
            $this->res->MoveNext();
        }
        echo $idProd;
        //return json_encode($idProd);
    }

    public function getPeso($id_produto) {
        $this->sql = "SELECT pro.pro_peso
                            FROM produtos pro, cesta_itens cesit
                           WHERE cesit.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                             AND cesit.pro_id = pro.pro_id
                             AND pro.pro_id = $id_produto";

        //echo $this->sql;

        $this->res = $this->bd->Execute($this->sql);
        return $this->res->fields['pro_peso'];
    }

    public function gerarItensPedido($ultimoPedID) {
        $this->sqlConsultaCesta = "SELECT cesit.pro_id, cesit.cite_qtd, cesit.cite_valor, 
                                           cesta.cli_id, 
                                           pro.pro_descricao, pro_estoque, pro_promocao
                                      FROM cesta_itens cesit, 
                                           cesta, 
                                           produtos pro
                                     WHERE cesit.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                                       AND cesit.ces_sessao = cesta.ces_sessao
                                       AND cesit.pro_id = pro.pro_id";

        $this->resConsultaCesta = $this->bd->Execute($this->sqlConsultaCesta);

        while (!$this->resConsultaCesta->EOF) {
            $idProd = $this->resConsultaCesta->fields['pro_id'];
            $qtdProd = $this->resConsultaCesta->fields['cite_qtd'];
            $valorProd = $this->resConsultaCesta->fields['cite_valor'];

            $this->sqlItensPedido = "  INSERT INTO 
                                     pedidos_itens (ped_id, pro_id, ite_qtd, ite_valor) 
                                            VALUES ($ultimoPedID, $idProd, $qtdProd,$valorProd)
                                    ";
            echo $this->sqlItensPedido;
            $this->resItensPedido = $this->bd->Execute($this->sqlItensPedido);
            $this->resConsultaCesta->MoveNext();
        }
        echo $idProd;
    }
    
    public function mostrarDadosTelaPedido() {
        //$this->sqlConsultaCesta = $this->gerarPedido($totalPedido, $fretePedido, $prazoEntrega);
        $this->sql =    "SELECT cesta.cli_id, 
                                cli.cli_endereco, cli.cli_bairro, cli.cli_cep, cli.cid_id, cli.cli_fone1,
                                cid.cid_nome, cid.cid_uf
                           FROM cesta, 
                                clientes cli, 
                                cidades cid
                          WHERE cesta.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                            AND cesta.cli_id = cli.cli_id
                            AND cli.cid_id = cid.cid_id";

        //echo $this->sql;

        $this->res = $this->bd->Execute($this->sql);

        while (!$this->res->EOF) {
            $enderecoEntrega = $this->res->fields['pro_id'];
            $cidadeEntrega = $this->res->fields['cite_qtd'];
            $valorProd = $this->res->fields['cite_valor'];

//            $this->sqlItensPedido = "  INSERT INTO 
//                                     pedidos_itens (ped_id, pro_id, ite_qtd, ite_valor) 
//                                            VALUES ($ultimoPedID, $idProd, $qtdProd,$valorProd)
//                                    ";
//            echo $this->sqlItensPedido;
            echo $this->res;
//            $this->res = $this->bd->Execute($this->sqlItensPedido);
            $this->res->MoveNext();
        }
    }

    public function gerarPedido($totalPedido, $fretePedido, $prazoEntrega) {
        $this->sqlConsultaCliente = "SELECT cli_endereco, cli_bairro, cli_cep, cli_fone1,
                                           cid_nome, cid_uf, cid.cid_id
                                      FROM cesta, 
                                           clientes cli, 
                                           cidades cid
                                     WHERE cesta.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                                       AND cesta.cli_id = cli.cli_id
                                       AND cli.cid_id = cid.cid_id";

        $this->res = $this->bd->Execute($this->sqlConsultaCliente);
        date_default_timezone_set('America/Sao_Paulo');
        $dataPedido = date("Y-m-d");
        $horaPedido = date("H:i:s");
        $tipoPagPedido = "C";
        $statusPedido = "1";
        $dataEnvioPedido = date('Y-m-d', strtotime("+$prazoEntrega days"));
        ;
        $idCliente = 1;
        $tipoFretePedido = 1;
        $enderecoPedido = $this->res->fields['cli_endereco'];
        $bairroPedido = $this->res->fields['cli_bairro'];
        $cepPedido = $this->res->fields['cli_cep'];
        $cidadePedido = $this->res->fields['cid_id'];
        echo $retorno = "<br><br>" . $dataPedido . " " . $horaPedido . " " . $tipoPagPedido . " " . $statusPedido . " " . $dataEnvioPedido . " " . $idCliente . " " . $tipoFretePedido . " " . $enderecoPedido . " " . $bairroPedido . " " . $cepPedido . " " . $cidadePedido;

        $this->sqlPedido = "INSERT INTO 
                                pedidos(ped_data, ped_hora, ped_total, ped_frete, ped_tipopag,
                                        ped_status, ped_dataenvio, cli_id, ped_tipofrete, 
                                        ped_endereco, ped_bairro, ped_cep, cid_id) 
                                VALUES ('$dataPedido', '$horaPedido', $totalPedido, $fretePedido,
                                        '$tipoPagPedido', '$statusPedido', '$dataEnvioPedido', $idCliente,
                                        $tipoFretePedido, '$enderecoPedido', '$bairroPedido', $cepPedido,
                                        $cidadePedido) 
                              RETURNING ped_id
                                        ";
        echo "<br><br>" . $this->sqlPedido;
        $this->res = $this->bd->Execute($this->sqlPedido);
        $ultimoPedID = $this->res->fields['ped_id'];
        echo $ultimoPedID;

        $this->gerarItensPedido($ultimoPedID);

        //return $this->res->fields['ped_id'];
        return $retorno;
    }

    public function mostrarDadosPedido($totalPedido, $fretePedido, $prazoEntrega) {
        $this->gerarPedido($totalPedido, $fretePedido, $prazoEntrega);
        $this->sql = "SELECT cesta.cli_id, 
                                cli.cli_endereco, cli.cli_bairro, cli.cli_cep, cli.cid_id, cli.cli_fone1,
                                cid.cid_nome, cid.cid_uf
                           FROM cesta, 
                                clientes cli, 
                                cidades cid
                          WHERE cesta.ces_sessao = 'l9pl5sag3ho56ktamlm1nj7af6'
                            AND cesta.cli_id = cli.cli_id
                            AND cli.cid_id = cid.cid_id";

        //echo $this->sql;

        $this->res = $this->bd->Execute($this->sql);
//        while (!$this->res->EOF) {
//            $idProd[] = $this->res->fields['pro_id'];
//            $this->res->MoveNext();
//        }
        echo $this->res;
        return $this->res;
        //return json_encode($idProd);
    }

    function __destruct() {
        //echo "chamou o destrutor";
    }

}
?>


