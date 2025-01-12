<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "About Us";
$templateParams["categorie"]= $dbh->getCategories();
$templateParams["nome-main"] = "about_pagina.php";
$templateParams["show-aside"] = false;

require("template/base.php");
?>