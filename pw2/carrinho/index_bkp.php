<?php
include_once('calcFrete_control.php');
//include_once('../conexao/conecta.php');
//include_once('cesta_compras_control.php');
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>E-Commerce | Programação Web 2 | Cesta de Compras</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="scripts/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.12.1.custom/jquery-ui.min.js" type="text/javascript"></script>
        <link href="scripts/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!--<link type="text/css" rel="stylesheet" href="css/principal.css">-->
        <!--<link type="text/css" rel="stylesheet" href="css/carrinho.css">-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="justified-nav.css" rel="stylesheet">-->
        <script src="scripts/bootstrap.min.js" type="text/javascript"></script>
        <script src="calcFrete_js.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>E-Commerce | PW2 | Cesta de Compras</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-primary btn-lg">ESCOLHER MAIS PRODUTOS</button>
                </div>
                <div class="col-lg-4">
                    <h2></h2>
                </div>
                <div class="col-lg-4 text-right">
                    <button type="button" class="btn btn-success btn-lg">COMPRAR</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="table">
                <div class="col-lg-9">
                    Produtos
                </div>
                <div class="col-lg-1 text-center">
                    Valor Unit.
                </div>
                <div class="col-lg-1 text-center">
                    Quantidade
                </div>
                <div class="col-lg-1 text-center">
                    Total
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <table class="table">
                <div class="col-lg-9">
                    <img src="images/12753581_1GG.jpg" class="img-thumbnail" width="75" height="75" alt=""/>
                </div>
                <div class="col-lg-1 text-center text-center">
                    R$ 199,00
                </div>
                <div class="col-lg-1 text-center">
                    <input type="text" size="2" name="quantidade">
                </div>
                <div class="col-lg-1 text-center">
                    R$ 199,00
                </div>
            </table>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <table class="table">
                <div class="col-lg-9">
                    <img src="images/11765725_1GG.jpg" class="img-thumbnail" width="75" height="75" alt=""/>
                </div>
                <div class="col-lg-1 text-center text-center">
                    R$ 199,00
                </div>
                <div class="col-lg-1 text-center">
                    <input size="2" name="quantidade" style="width:50px" min="0" max="99" step="1" type="number" value="1">
                </div>
                <div class="col-lg-1 text-center">
                    R$ 199,00
                </div>
            </table>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="table">
                <div class="col-lg-5 text-left">
                    <div class="well btn-group">
                        <a4>Simule o prazo de entrega e o frete para seu CEP abaixo:</a4><br><br>
                        <div class="input-group">
                            <input type="text" class="form-control" size="10" name="CEP" id="CEP" placeholder="Informe o CEP (formato: 99150-000)">
                            <span class="input-group-btn">
                                <button class="btn btn-default calcFrete" type="button">Calcular!</button>
                            </span>
                        </div>
                        <br/>
                        <div id="tipo_entrega2">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 text-right">
                    Valor Total dos Produtos:
                </div>
                <div class="col-lg-2 text-right">
                    <b>R$ <span class="valorProdutos2">398,00</span></b>
                </div>
            </div>
            <div class="table">
                <div class="col-lg-5 text-left">

                </div>
                <div class="col-lg-5 text-right">
                    Valor da Entrega<span class="modalidade2"></span>:<br>
                </div>
                <div class="col-lg-2 text-right">
                    <b>R$ <span class="precoFrete2"> -------- </span></b>
                </div>
                <div class="col-lg-7 text-right">
                    <del>-------------</del>
                </div>
                <div class="col-lg-5 text-right">
                    Valor Total a Pagar:
                </div>
                <div class="col-lg-2 text-right">
                    <b>R$ <span class="valorTotal2"> -------- </span></b>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">
                    <h2></h2>
                </div>
                <div class="col-lg-4 text-right">
                    <button type="button" class="btn btn-warning btn-lg">COMPRAR</button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <h2>E-Commerce | PW2 | Carrinho de Compras</h2>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table grid">
                    <tr>
                        <td colspan="6" class="text-left">
                            <button type="button" class="btn btn-primary btn-md">ESCOLHER MAIS PRODUTOS</button>
                        </td>
                        <td colspan="6" class="text-right">
                            <button type="button" class="btn btn-warning btn-md">COMPRAR</button>
                        </td>  
                    </tr>
                    <tr>
                        <td colspan="6" class="text-left">Produtos</td>
                        <td colspan="2" class="text-center">Quantidade</td>
                        <td colspan="2" class="text-center">Valor Unitário</td>
                        <td colspan="2" class="text-center">Valor Total</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-left">
                            <img src="images/12753581_1GG.jpg" class="img-thumbnail" width="75" height="75" alt=""/>
                            <a href="#"><spam>{Descrição do Produto - Camisa do Grêmio}</spam></a>
                        </td>
                        <td colspan="2" class="text-center">
                            <input size="2" name="quantidade" style="width:50px" min="1" max="99" step="1" type="number" value="1">
                            <br>
                            <button type="button" class="btn btn-link btn-sm">Retirar do Carrinho</button>
                        </td>
                        <td colspan="2" class="text-center">R$ 199,00</td>
                        <td colspan="2" class="text-center">R$ 199,00</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-left">
                            <img src="images/10485778_1GG.jpg" class="img-thumbnail" width="75" height="75" alt=""/>
                            <a href="#"><spam>{Descrição do Produto - Camisa do Cruzeiro}</spam></a>
                        </td>
                        <td colspan="2" class="text-center">
                            <input size="2" name="quantidade" style="width:50px" min="1" max="99" step="1" type="number" value="1">
                            <br>
                            <button type="button" class="btn btn-link btn-sm">Retirar do Carrinho</button>
                        </td>
                        <td colspan="2" class="text-center">R$ 199,00</td>
                        <td colspan="2" class="text-center">R$ 199,00</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-left">
                            <img src="images/11765725_1GG.jpg" class="img-thumbnail" width="75" height="75" alt=""/>
                            <a href="#"><spam>{Descrição do Produto - Camisa do Inter}</spam></a>
                        </td>
                        <td colspan="2" class="text-center">
                            <input size="2" name="quantidade" style="width:50px" min="1" max="99" step="1" type="number" value="1">
                            <br>
                            <button type="button" class="btn btn-link btn-sm">Retirar do Carrinho</button>
                        </td>
                        <td colspan="2" class="text-center">R$ 199,00</td>
                        <td colspan="2" class="text-center">R$ 199,00</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-left" style="width:650px; height:200px">
                            <div class="row well text-center"  style="width:650px; height:200px">
                                <a4>Simule o prazo de entrega e o frete para seu CEP abaixo:</a4><br><br>
                                <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-md" id="cep" name="cep" pattern="[0-9]*" inputmode="numeric" value="" maxlength="9" placeholder="_____-___ Informe o CEP (formato: 99150-000)" size="9"> 
                                        <span class="input-group-btn">
                                            <button class="btn btn-default calcFrete" type="button">Calcular!</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-4 -->
                                <div class="alert-sucess" >
                                    <label id="tipo_entrega" class="alert col-md-12 text-left">

                                    </label>
                                </div>
                            </div><!-- /.row -->
                        </td>
                        <td colspan="5" class="text-right" style="width:450px; height:200px">
                            <table class="table">
                                <tr>
                                    <td colspan="2" class="text-left">
                                        Valor total dos produtos:
                                    </td>
                                    <td class="text-right">
                                        R$
                                    </td>  
                                    <td class="text-left valorProdutos">
                                        697,00
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-left">
                                        Valor da Entrega:
                                    </td>
                                    <td class="text-right">
                                        R$
                                    </td>  
                                    <td class="text-left">
                                        <b><span class="precoFrete"> -------- </span></b>
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-left">
                                        Valor total dos produtos:
                                    </td>
                                    <td class="text-right">
                                        R$
                                    </td>  
                                    <td class="text-left">
                                        <b><span class="valorTotal"> -------- </span></b>
                                    </td> 
                                </tr>
                            </table>
                        </td>  
                    </tr>
                    <tr>
                        <td colspan="6" class="text-left">
                            <button type="button" class="btn btn-primary btn-md">ESCOLHER MAIS PRODUTOS</button>
                        </td>
                        <td colspan="6" class="text-right">
                            <button type="button" class="btn btn-warning btn-md">COMPRAR</button>
                        </td>  
                    </tr>
                </table>
            </div>
        </div> <!-- /container -->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    </body>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            <div class="info text-center">
                PW2 - Contato via Email
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
        </div>
    </footer>

</html>
