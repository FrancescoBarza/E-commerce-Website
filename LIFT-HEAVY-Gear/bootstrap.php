<?php
session_start();
define("UPLOAD_DIR_UPLOADS", "./images/uploads/");
define("UPLOAD_DIR_ARTICLES", "./images/articles/");
define("UPLOAD_DIR_LOGINS", "./images/login/");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "liftheavygear", 3307);


?>