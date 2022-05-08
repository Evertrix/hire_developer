<?php
require_once('../src/db.php');
//$dbClient = new DatabaseClient();
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
<form class="col-6 container" action="../src/action.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-12">
            <label for="developer_name" class="form-label">Name of Developer:</label>
            <input type="text" class="form-control" name="developer_name" id="developer_name"
                   placeholder="Name of Developer">
        </div>
        <div class="form-group col-12">
            <label for="developer_email" class="form-label">Email of Developer:</label>
            <input type="text" class="form-control" name="developer_email" id="developer_email"
                   placeholder="Email of Developer">
        </div>
        <div class="form-group col-12">
            <label for="phone" class="form-label">Phone of Developer:</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone of Developer">
        </div>
        <div class="form-group col-12">
            <label for="location" class="form-label">Location of Developer:</label>
            <input type="text" class="form-control" name="location" id="location" placeholder="Location of Developer">
        </div>
        <div class="form-group col-12">
            <label for="profile_picture" class="form-label">Profile Picture:</label>
            <input type="file" class="form-control" name="profile_picture" id="profile_picture"
                   placeholder="Profile Picture">
        </div>
        <div class="form-group col-12">
            <label for="price_per_hour" class="form-label">Price Per Hour:</label>
            <input type="number" class="form-control" name="price_per_hour" id="price_per_hour"
                   placeholder="Price Per Hour">
        </div>
        <div class="form-group col-12">
            <label for="inputState">Technology:</label>
            <select name="technology_selection" class="form-control">
                <option value="">---Select Option---</option>
                <option value="JavaScript">JavaScript</option>
                <option value="Java">Java</option>
                <option value=".NET">.NET</option>
                <option value="Flutter">Flutter</option>
                <option value="Python">Python</option>
                <option value="PHP">PHP</option>
            </select>
        </div>
        <div class="form-group col-12">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" class="form-control" rows="10" cols="70"></textarea>
        </div>
        <div class="form-group col-12">
            <label for="years_of_experience" class="form-label">Years of Experience: </label>
            <input type="number" class="form-control" name="years_of_experience" id="years_of_experience"
                   placeholder="Years of Experience">
        </div>
        <div class="form-group col-12">
            <label for="native_language" class="form-label">Native Language:</label>
            <select name="native_language_selection" class="form-control">
                <option value="">---Select Option---</option>
                <option value="english">English</option>
                <option value="serbian">Serbian</option>
                <option value="bulgarian">Bulgarian</option>
            </select>
        </div>
        <div class="form-group col-12">
            <label for="linkedin" class="form-label">Linkedin Profile Link:</label>
            <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin Profile Link">
        </div>
    </div>
    <br>
    <div class="d-flex justify-content-center">
        <button type="submit" name="submit" value="Submit" class="btn btn-primary">Add</button>
    </div>
    <!--    <br>-->
</form>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
        crossorigin="anonymous"></script>
</body>
</html>