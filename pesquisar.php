<?php

header("content-type: application/json");

$pesquisar = filter_input(INPUT_POST, "pesquisar", FILTER_SANITIZE_STRING);
$conect = new PDO("mysql:host=localhost;port=3306;dbname=loja", "root", "");

$comando = "SELECT * FROM produtos WHERE Nome LIKE '%{$pesquisar}%' AND Quantidade > 0";
$bind = array(
    "pesquisar" => $pesquisar
);

$result = $conect->prepare($comando);
$result->execute();
$dados = $result->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($dados);
