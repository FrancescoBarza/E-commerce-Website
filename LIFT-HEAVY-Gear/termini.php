<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Termini e Condizioni";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "termini_pagina.php";
$templateParams["show-aside"] = false;

require("template/base.php");
?>