<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Login";
$templateParams["categorie"]= $dbh->getCategories();

$templateParams["nome-main"] = "form-login";




require("template/base.php");
?>