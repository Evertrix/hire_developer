<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include('header.php');
include "autoload.php";
$developer = new Developer();
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
    <title>Edit Client</title>
</head>
<body>
<div class="form-group col-12">
    <form class="col-6 container" method="post" action="hiring.php" enctype="multipart/form-data">
        <h4>Hire Available Developers</h4>
        Start Date: <input type="date" name="start_date"/>
        End Date: <input type="date" name="end_date"/>
        <div class="row">
            <!--Show all existing developers from db in a select field-->
            <select name="select_developer_to_hire[]" class="form-control" multiple="multiple"
                    aria-label="multiple select example">>
                <?php
                $developer->fetch_hireable_developers($developer->readDeveloper("developers"));
                ?>
            </select>

            <input class="form-group col-12" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>
<br>
<?php
$developer->submit_developer_for_hire();

$select_hired_developers = $developer->readDeveloper("hire_developers");
?>
<table class='table center col-10 mt-5 mb-5'>
    <thead>
    <tr>
        <th scope='col'>Names</th>
        <th scope='col'>Start Date</th>
        <th scope='col'>End Date</th>
        <th scope='col'>Delete</th>
    </tr>
    </thead>

    <?php
    $developer->list_hired_developers($select_hired_developers);
    ?>

</table>
<?php
include('footer.php');
?>
</body>
</html>