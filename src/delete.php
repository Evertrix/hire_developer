<?php

require_once('db.php');
$dbClient = new DatabaseClient(); // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = $dbClient->delete('developers', ['id'], [$_GET['id']]); // delete query

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