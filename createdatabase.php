<?php
try{
$pdo = new PDO("mysql:host=localhost;port=3306", "root", "");
$create = $pdo->prepare("CREATE DATABASE loja");
$create->execute();
header("location: createtable.php");
} catch (PDOException $e) {
header("location: createtable.php");
}