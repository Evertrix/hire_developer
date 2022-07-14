<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'autoload.php'; // Autoloading the Database class
$developer = new Developer();
if(isset($_POST['submit'])) {
    $developer->createDeveloper();
    header('Location: ../public/index.php');
    exit();
}


