<?php
include "autoload.php";
//require_once('Developer.php');
$developer = new Developer(); // Using database connection file here

$id = $_GET['id']; // get id through query string

//$del = $developer->deleteDeveloper("developers"); // delete query
$del = $developer->query("DELETE d.*, h.* FROM developers d
INNER JOIN hire_developers h ON d.name = h.names
WHERE d.name = h.names;
");

if($del)
{
    // Close connection
    header("Location: ../public/index.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}