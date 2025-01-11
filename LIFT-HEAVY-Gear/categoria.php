<?php
require_once("bootstrap.php");
$id_cat = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$categoria = $dbh->getCategoriesById($id_cat);
$templateParams["titolo"] = isset($categoria["nome_categoria"]) ? $categoria["nome_categoria"] : "Categoria non trovata";
$templateParams["titolo-main"] =  isset($categoria["nome_categoria"]) ? $categoria["nome_categoria"] : "Categoria non trovata";
$templateParams["categorie"] = $dbh->getCategories();
$templateParams["nome-main"] = "lista_prodotti.php";
$templateParams["lista-prodotti"] = $dbh->getProductByCategory($id_cat);
$templateParams["show-aside"] = true;
$templateParams["articoli"] = $dbh->getArticles();
require("template/base.php");
?>
