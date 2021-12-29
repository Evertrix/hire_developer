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
    <link rel="stylesheet" href="../hire_developers/assets/css/style.css">
    <title>Edit Client</title>
</head>
<body>
<?php
include('header.php');
require_once('db.php');
$dbClient = new DatabaseClient();
$selection_all_developers = $dbClient->select('developers', ['id', 'name', 'email', 'price_per_hour', 'technology']);
?>
<div class="form-group col-12">
    <form class="col-6 container" method="post" action="hiring.php" enctype="multipart/form-data">
        <h4>Hire Available Developers</h4>
        Start Date: <input type="date" name="start_date"/>
        End Date: <input type="date" name="end_date"/>
        <div class="row">
            <!--Show all existing developers from db in a select field-->
            <select name="select_developer_to_hire[]" class="form-control" multiple="multiple" aria-label="multiple select example">>
                <?php
                while ($rows = mysqli_fetch_assoc($selection_all_developers)) {
                    ?>
                    <option value="<?= $rows['name']; ?>"><?= $rows['name']; ?></option>
                    <?php
                }
                ?>
            </select>

            <input class="form-group col-12" type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>
<br>
<?php include('footer.php'); ?>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    $now = date("Y-m-d H:i:s");
    $select_developer_to_hire = $_POST['select_developer_to_hire'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    foreach ($select_developer_to_hire as $single_dev) {
        // SQL selection for a single developer. Check if there is an overlap with the dates of hire.
        $developer_for_hire_from_db_select = $dbClient->select('hire_developers', ['names'], "(names = '$single_dev') AND ('$start_date' <= end_date AND '$end_date' >= start_date)"); // , "start_date = $start_date AND end_date = $end_date"
        $check_rows = mysqli_num_rows($developer_for_hire_from_db_select);
        if ($check_rows > 0) {
            header('Location: hiring.php');
            die("Select valid date");
        }

        // Validation checks.
        if ($end_date < $start_date) {
            header('Location: hiring.php');
            die("Select valid date");
        }
        if ($start_date < $now || $end_date < $now) {
            header('Location: hiring.php');
            die("Select valid date");
        }
        // Insert a single developer in the db as a record. If multiple developers are selected, foreach all the selected before exiting.
        $dbClient->insert('hire_developers', ['names', 'start_date', 'end_date'], [$single_dev, $_POST['start_date'], $_POST['end_date']]);

    }
    header('Location: hiring.php');
    exit();
}

$select_hired_developers = $dbClient->select('hire_developers', ['names', 'start_date', 'end_date']);
echo "<table class='table center col-10 mt-5 mb-5'>";
echo "<thead>";
echo "<tr>";
echo "<th scope='col'>Names</th>";
echo "<th scope='col'>Start Date</th>";
echo "<th scope='col'>End Date</th>";
echo "</tr>";
echo "</thead>";

while ($row = mysqli_fetch_assoc($select_hired_developers)) {
    $image_src = $row['profile_picture'];
    echo "<tbody>";
    echo "<tr>";
    echo "<td>" . $row['names'] . "</td>";
    echo "<td>" . $row['start_date'] . "</td>";
    echo "<td>" . $row['end_date'] . "</td>";
    echo "</tr>";
    echo "</tbody>";
}
echo "</table>";

