<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Privacy";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "privacy_pagina.php";
$templateParams["show-aside"] = false;

require("template/base.php");
?>