<?php
include "autoload.php";
//require_once('Developer.php');
$developer = new Developer(); // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = $developer->deleteDeveloper("hire_developers"); // delete query

if ($del) {
    // Close connection
    header("Location: ../public/hiring.php"); // redirects to all records page
    exit;
} else {
    echo "Error deleting record"; // display error message if not delete
}