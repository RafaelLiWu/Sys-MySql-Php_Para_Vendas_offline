<?php

try{
$pdoLoja = new PDO("mysql:host=localhost;port=3306;dbname=loja", "root", "");
$createLoja = $pdoLoja->prepare("CREATE TABLE produtos (Nome varchar(80) NOT NULL,Quantidade INT NOT NULL,Valor double NOT NULL,product_id int NOT NULL AUTO_INCREMENT PRIMARY KEY)");
$createLoja->execute();
header("location: index.php");
} catch (PDOException $e) {
    
}