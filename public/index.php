<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../src/autoload.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
          crossorigin="anonymous">
    <link rel="stylesheet" href="../../hire_developers_corrections/resources/css/style.css">
    <title>Babel</title>
</head>
<body>
<?php include('header.php'); ?>
<br>
<?php
$selection_all_developer = Developer::readDeveloper("developers");
?>
<table class='table center col-10 mt-5 mb-5'>
    <thead>
    <tr>
        <th scope='col'>ID</th>
        <th scope='col'>Name</th>
        <th scope='col'>Email</th>
        <th scope='col'>Profile Picture</th>
        <th scope='col'>Price Per Hour</th>
        <th scope='col'>Technology</th>
        <th scope='col'>Edit</th>
        <th scope='col'>Delete</th>
    </tr>
    </thead>
    <?php
    Developer::list_automation($selection_all_developer, ["id", "name", "email", "profile_picture", "price_per_hour", "technology"], ["edit", "delete"]);
    ?>
</table>
</div>
<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
        crossorigin="anonymous"></script>
</body>
</html>
