<?php

require_once 'DataControl.php';

$comando = "SELECT Nome FROM produtos WHERE Quantidade > :qtd";
$bind = array(
    "qtd" => 0
);
$c =  new Controler("loja");
$result = $c->Select($comando, $bind);
$dados = $result->fetchAll();






?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial scale=1.0, shrink-to-fit=no">
    <title>CrIFF</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="container mx-auto">
        <form method="POST">
            <div class="form-group">
                <label for="textNome">Qual do produtos</label>
                <select class="form-group">
                    <?php
                    $n = 0;
                    foreach ($dados as $ids) {
                    ?>

                        <option value="<?= $n; ?>"><?= $ids['Nome']; ?></option>;
                    <?php
                        $n++;
                    }
                    ?>
                </select>
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
                <input type="submit" value="Enviar" class="btn btn-primary">
            </div>
        </form>
    </div>



    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>