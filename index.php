<?php
require_once 'DataControl.php';



$comando = "SELECT Nome, Quantidade, Valor FROM produtos WHERE Quantidade > :qtd ORDER BY Nome ASC";
$bind = array(
    "qtd" => 0
);
$date = date("Y_m_d");
$c =  new Controler("loja");
$c->_criarBancoDeDados();
$result = $c->_Select($comando, $bind);
$dados = $result->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0, shrink-to-fit=no">
    <title>Sys</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="body">


    <aside class="aside">
        <?php
        $n = 0;
        foreach ($dados as $ids) {
        ?>
            <p class="aside-products btn-primary">
                <span nome="<?= $ids['Nome']; ?>" valor="<?= $ids['Valor']; ?>" quantidade="<?= $ids['Quantidade']; ?>" ><?= $ids['Nome']; ?> <?= $ids['Quantidade']; ?></span>
                <span class="aside-products-more"><span class="menos btn-danger" onclick="tirar(this)">-</span><span class="mais btn-success" onclick="adicionar(this)">+</span></span>
            </p>
        <?php
            $n++;
        }
        ?>
    </aside>




    <div class="areas">
        <header class="header">
            <div class="header-criar btn-success" onclick="createProducts()">
                <span>Criar Produtos</span>
            </div>
            <div class="header-resultados btn-primary" onclick="TotalDiario()">
                <span>Total Di??rio</span>
            </div>

            <div class="header-resultados-result">
                <?php
                $comandoDiario = "SELECT Nome, Quantidade, Valor FROM dia{$date}";
                $bindDiario = array();
                $result_diario = $c->_Select($comandoDiario, $bindDiario);
                $diario = $result_diario->fetchAll(PDO::FETCH_ASSOC);
                foreach ($diario as $items) {
                ?>
                    <p class="m-0 produtosDiarios">Produto: <?= $items['Nome']; ?> | Quantidade: <?= $items['Quantidade']; ?> | Valor: <?= $items['Valor']; ?></p>
                <?php
                };
                ?>
                <?php
                $comandoTotal = "SELECT SUM(Valor) as Valor FROM dia{$date}";
                $bindTotal = array();
                $result_total = $c->_Select($comandoTotal, $bindTotal);
                $total = $result_total->fetch(PDO::FETCH_ASSOC);
                $english_format_number = number_format($total['Valor'], 2, '.', '');
                ?>
                <p class="m-3">Total de Vendas diaria: R$:<span id="totaldiario" total="<?= $english_format_number; ?>"><?= $english_format_number; ?><span></p>

                <p align="center">
                    <button type="button" class="btn btn-primary" id="imprimirdia">Imprimir</button>
                </p>
            </div>




            <div class="header-formulario">
                <div class="container mx-auto">
                    <form method="POST" class="text-white">
                        <div class="form-group">
                            <label for="textNome">Nome do produto</label>
                            <input type="text" id="textNome" name="textNome" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="textQtd">A Quantidade</label>
                            <input type="text" id="textQtd" name="textQtd" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="textValor">Qual o valor?</label>
                            <input type="text" id="textValor" name="textValor" class="form-control">
                        </div>
                        <div class="form-group">
                            <a class="btn btn-danger float-left" style="cursor:pointer" onclick="createProductsClose()">X</a>
                            <input type="submit" value="Enviar" class="btn btn-primary float-right">
                        </div>
                    </form>
                </div>

                <?php

                require_once 'DataControl.php';

                $nome = filter_input(INPUT_POST, "textNome", FILTER_SANITIZE_STRING);
                $quantidadeCreate = filter_input(INPUT_POST, "textQtd", FILTER_SANITIZE_NUMBER_INT);
                $valorCreate = filter_input(INPUT_POST, "textValor", FILTER_SANITIZE_STRING);

                if (strpos($valorCreate, ",") > 0) {
                    $valorCreate = str_replace(",", ".", $valorCreate);
                };
                if (isset($nome, $quantidadeCreate, $valorCreate)) {
                    $controler = new Controler("loja");
                    $arr = array(
                        "nome" => $nome,
                        "quantidade" => $quantidadeCreate,
                        "valor" => $valorCreate
                    );
                    $controler->_Criar($arr);
                };

                ?>

            </div>






            <div class="pesquisar">
                <div class="pesquisar-mecanismo">
                    <i class="fas fa-search text-primary" onclick="pesquisar()"></i>
                    <div class="pesquisar-mecanismo-area">
                    <input type="text" class="form-control" id="pesquisar-texto">
                    <button type="button" class="btn btn-primary" id="pesquisar" style="cursor: pointer">Pesquisar</button>
                    </div>
                </div>
            </div>











        </header>

        <div class="painel">
            <div class="painel-area">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="produtos">Produtos</label>
                        <input type="text" id="produtos" name="produtos" class="form-control" readonly >
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input type="text" id="quantidade" name="quantidade" class="form-control" readonly >
                    </div>
                    <div class="form-group">
                        <label for="valor">Pre??o</label>
                        <input type="text" id="valor" name="valor" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-primary" value="Confirmar" style="cursor: pointer;" onclick="imprimir()">
                            </div>
                            <div class="col-md-8">
                                <div class="precototal h-100 w-100">
                                    <input class="form-control imprimir" type="text" name="totalapagar" id="totalapagar" placeholder="Total" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    $produtos = filter_input(INPUT_POST, "produtos", FILTER_SANITIZE_STRING);
    $quantidade = filter_input(INPUT_POST, "quantidade", FILTER_SANITIZE_STRING);
    $valor = filter_input(INPUT_POST, "valor", FILTER_SANITIZE_STRING);
    if (isset($produtos, $quantidade, $valor) && !empty($produtos) && !empty($quantidade) && !empty($valor)) {
        $produtos_arr = explode(",", $produtos);
        $quantidade_arr = explode(",", $quantidade);
        $valor_arr = explode(",", $valor);

        $c->_vendas($produtos_arr, $quantidade_arr, $valor_arr);
    }
    ?>


    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/createItem.js"></script>
    <script src="js/pdf.js"></script>
    <script src="js/Compras.js"></script>
    <script src="js/pesquisar.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>