<?php


class Compra {

    private $con, $bd; // para conexão
    private $sql; // para os comandos SQL
    private $res; // para resultado dos SQLs
    private $ordem; // para ordenação da consulta
    private $totalPag; // para total de páginas
    private $pag; //número da página atual

    //método construtor

    public function __construct() {
        $this->con = new Conecta();
        $this->bd = $this->con->getBd();
        $this->ordem = "data_deposito";
    }

    public function listarProdutos() {
        //se usuário selecionar uma nova ordenação
        if (isset($_REQUEST['ordem']))
            $this->ordem = $_REQUEST['ordem'];
        $filtro = "";
//        if (isset($_POST['pesquisa']) &&
//                $_POST['pesquisa'] != '') {
//            $pesq = strtolower($_POST['pesquisa']);
//            $filtro = " where lower(nome) like '$pesq%' ";
//        }
        //número de páginas
        $this->totalPag = ceil($this->totalReg($filtro) / CONFIG_PAGINA);
        if (isset($_REQUEST['pag'])) {
            $this->pag = $_REQUEST['pag'];
        } else {
            $this->pag = 1;
        }

        $this->sql = "select * from cheques 
		             $filtro  order by $this->ordem";
        $this->res = $this->bd->Execute($this->sql);
        //$this->res = $this->bd->PageExecute($this->sql, CONFIG_PAGINA, $this->pag);
        return $this->res;
    }
    
    public function listarAlterar($cheque_id) {
        $this->sql = "select * from cheques where cheque_id = $cheque_id";
        $this->res = $this->bd->Execute($this->sql);
        //return $this->res;
        $retornoAlterar = array($this->res->fields['cheque_id'], $this->res->fields['data_emissao'], $this->res->fields['data_deposito'], $this->res->fields['taxa_juro_mensal'], $this->res->fields['valor'], $this->res->fields['tipo_pessoa']);
        return json_encode($retornoAlterar);
    }

    public function listarTabela() {
        if (isset($_REQUEST['ordem']))
            $this->ordem = $_REQUEST['ordem'];
        $filtro = "";
        if (isset($_POST['pesquisa']) &&
                $_POST['pesquisa'] != '') {
            $pesq = strtolower($_POST['pesquisa']);
            //$filtro = " where lower(nome) like '$pesq%' ";
        }
        $this->sql = "select * from cheques
		              $filtro  order by $this->ordem";
        $this->res = $this->bd->Execute($this->sql);
        if ($this->res->RowCount() > 0) {
            $tabela = "";
            while (!$this->res->EOF) {
                $tabela .= "<tr>\n";
                $tabela .= "<td>" . $this->res->fields['cheque_id'] . "</td>\n";
                $tabela .= "<td>" . $this->res->fields['data_emissao'] . "</td>\n";
                $tabela .= "<td align='center'>" . $this->res->fields['data_deposito'] . "</td>\n";
                $tabela .= "<td align='center'>" . $this->res->fields['taxa_juro_mensal'] . "</td>\n";
                $tabela .= "<td align='center'>" . $this->res->fields['valor'] . "</td>\n";
                $tabela .= "<td align='center'>" . $this->res->fields['tipo_pessoa'] . "</td>\n";
                $tabela .= "<td align='center'><a class='altera_cheque' href=''>Alterar</a></td>\n";
                $tabela .= "<td align='center'><a class='exclui_cheque' href=''>Excluir</a></td>\n";
                $tabela .= "</tr>\n";
                $this->res->MoveNext();
            }
            return $tabela;
        } else {
            return "0";
        }
    }

    //contar total de registros
    public function totalReg($filtro) {
        $sql = "select count(*) as total from cheques $filtro";
        $res = $this->bd->Execute($sql);
        return $res->fields['total'];
    }

    // <?php echo $mod->paginacao(); 

    public function paginacao() {
        $pesq = "";
        if (isset($_POST['pesquisa']))
            $pesq = $_POST['pesquisa'];

        $x = 1;
        // $this->totalPag
        $retorno = "";
        while ($x <= $this->totalPag) {
            $retorno .= "[<a href='index.php?menu=cheques&" .
                    "pesquisa=$pesq&ordem=$this->ordem&" .
                    "pag=$x'> $x </a> ]";
            $x++;
        }
        return $retorno;
    }

    public function gravarIncluir($data_emissao, $data_deposito, $taxa_juro_mensal, $valor, $tipo_pessoa) {
        $valor = number_format($valor, 2, '.' , ',');
        $taxa_juro_mensal = number_format($taxa_juro_mensal, 2, '.' , ',');
        $this->sql = "insert into cheques (data_emissao, data_deposito, taxa_juro_mensal, valor, tipo_pessoa)
		             values ('$data_emissao', '$data_deposito', $taxa_juro_mensal, $valor, '$tipo_pessoa')";
        $this->res = $this->bd->Execute($this->sql);

        $this->sql = "select max(cheque_id) as cheque_id from cheques";
        $this->res = $this->bd->Execute($this->sql);
        $tabela = "";
        $tabela .= "<tr>\n";
        $tabela .= "<td align='center'>" . $this->res->fields['cheque_id'] . "</td>\n";
        $tabela .= "<td align='center'>" . date("d/m/Y", strtotime($data_emissao)) . "</td>\n";
        $tabela .= "<td align='center'>" . date("d/m/Y", strtotime($data_deposito)) . "</td>\n";
        $tabela .= "<td align='center'>" . number_format($taxa_juro_mensal, 2, '.', ',')  . "% </td>\n";
        $tabela .= "<td align='right'>R$ " . number_format($valor, 2, ',', '.') . "</td>\n";
        $tabela .= "<td align='center'>" . $tipo_pessoa . "</td>\n";
        $tabela .= "<td align='center'><a class='altera_cheque' href=''>Alterar</a></td>\n";
        $tabela .= "<td align='center'><a class='exclui_cheque' href=''>Excluir</a></td>\n";
        $tabela .= "</tr>\n";
//        $this->res->MoveNext();
        return $tabela;
    }

    public function gravarAlterar($cheque_id, $data_emissao, $data_deposito, $taxa_juro_mensal, $valor, $tipo_pessoa) {
        $this->sql = "update cheques set data_emissao = '$data_emissao', data_deposito = '$data_deposito', taxa_juro_mensal = $taxa_juro_mensal, valor = $valor, tipo_pessoa = '$tipo_pessoa' where cheque_id = $cheque_id";
        $this->res = $this->bd->Execute($this->sql);
        $tabela = "";
        $tabela .= "<tr>\n";
        $tabela .= "<td align='center'>" . $cheque_id . "</td>\n";
        $tabela .= "<td align='center'>" . date("d/m/Y", strtotime($data_emissao)) . "</td>\n";
        $tabela .= "<td align='center'>" . date("d/m/Y", strtotime($data_deposito)) . "</td>\n";
        $tabela .= "<td align='center'>" . number_format($taxa_juro_mensal, 2, '.', ',')  . "% </td>\n";
        $tabela .= "<td align='right'>R$ " . number_format($valor, 2, ',', '.') . "</td>\n";
        $tabela .= "<td align='center'>" . $tipo_pessoa . "</td>\n";
        $tabela .= "<td align='center'><a class='altera_cheque' href=''>Alterar</a></td>\n";
        $tabela .= "<td align='center'><a class='exclui_cheque' href=''>Excluir</a></td>\n";
        $tabela .= "</tr>\n";
        if (!$this->res) { //se ocorreu erro
            return '0';
        }  else {
            return $tabela;
        }
        
        
    }

    public function excluir($cheque_id) {
        $this->sql = "delete from cheques where cheque_id = $cheque_id";
        $this->res = $this->bd->Execute($this->sql);
        if (!$this->res) //se ocorreu erro
            return '0';
        else
            return '1';
        //mensagem(MSG_EXCLUIR);
    }

    public function alterar($cheque_id) {
        $this->sql = "select * from cheques where cheque_id = $cheque_id ";
        $this->res = $this->bd->Execute($this->sql);
        return $this->res;
    }
}

//fim class
?>