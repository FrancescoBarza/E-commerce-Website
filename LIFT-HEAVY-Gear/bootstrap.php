<?php
session_start();
define("UPLOAD_DIR_UPLOADS", "./images/uploads/");
define("UPLOAD_DIR_ARTICLES", "./images/articles/");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "liftheavygear", 3306);


?>