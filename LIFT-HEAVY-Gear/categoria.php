<?php
require_once("bootstrap.php");

$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$categoria = $dbh->getCategoriesById($id_cat);
$templateParams["titolo"] = $categoria["nome_categoria"];

$templateParams["categorie"]= $dbh->getCategories();

$templateParams["nome-main"] = "lista_prodotti.php";

$templateParams["lista-prodotti"] = $dbh->getProductByCategory($id_cat);
$templateParams["articoli"] = $dbh->getArticles();



require("template/base.php");
?>