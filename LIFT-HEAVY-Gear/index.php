<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "LIFT HEAVY Gear";

$templateParams["categorie"]= $dbh->getCategories();
$templateParams["prodottirandom"] = $dbh->getRandomProduct();
$templateParams["articolirecenti"] = $dbh->getArticles();



require("template/base.php");
?>