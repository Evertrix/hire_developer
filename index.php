<?php
//require_once('action.php');
require_once('db.php');
//require_once('action.php');
$dbClient = new DatabaseClient();
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
    <link rel="stylesheet" href="../hire_developers/assets/css/style.css">
    <title>Babel</title>
</head>
<body>
<?php include('header.php'); ?>
<br>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
        crossorigin="anonymous"></script>
</body>
</html>
<?php
$selection_all_clients = $dbClient->select('developers', ['id', 'name', 'email', 'profile_picture', 'price_per_hour', 'technology']);
echo "<table class='table center col-10 mt-5 mb-5'>";
echo "<thead>";
echo "<tr>";
echo "<th scope='col'>ID</th>";
echo "<th scope='col'>Name</th>";
echo "<th scope='col'>Email</th>";
echo "<th scope='col'>Profile Picture</th>";
echo "<th scope='col'>Price Per Hour</th>";
echo "<th scope='col'>Technology</th>";
echo "<th scope='col'>Edit</th>";
echo "<th scope='col'>Delete</th>";
echo "</tr>";
echo "</thead>";
//if (mysqli_num_rows($selection_all_clients) > 0) {
while ($row = mysqli_fetch_assoc($selection_all_clients)) {
    $image_src = $row['profile_picture'];
    echo "<tbody>";
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>";
    if ($image_src !== '') {
        echo "<img src='$image_src' height='50' width=50'>";
    } else {
        echo '';
    }
    echo "</td>";
    echo "<td>" . $row['price_per_hour'] . "$" . "</td>";
    echo "<td>" . $row['technology'] . "</td>";
    ?>
    <td><a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
    <?php
    echo "</tr>";
    echo "</tbody>";
}
//}
echo "</table>";
echo "</div>";
?>
<?php include('footer.php'); ?>
