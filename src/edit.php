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
    <link rel="stylesheet" href="../../hire_developers/assets/css/style.css">
    <title>Edit Client</title>
</head>
<body>
<?php
include 'autoload.php';
include('../public/header.php'); ?>
<?php
$developer = new Developer();
if(isset($_POST['update'])) {
    $developer->updateDeveloper();
    header('Location: ../public/index.php');
    exit();
}
?>
<br>
<br><h3 class="text-center">Edit data:</h3><br>
<form class="col-6 container" name="form" method="POST" enctype="multipart/form-data"><br>
    <div class="row">
        <?php
        $selection_all_clients = $developer->query("SELECT * FROM developers WHERE id=:id", ["id" => $_GET['id']]);
        if (count($selection_all_clients)) {
        $selected_clients = $developer->query("SELECT * FROM developers WHERE id=:id", ["id" => $_GET['id']], PDO::FETCH_BOTH);
        foreach ($selection_all_clients as $row) {

        $technologies = ["JavaScript", "Java", ".NET", "Flutter", "Python", "PHP"];
        $native_languages = ["English", "Serbian", "Bulgarian"];
        ?>
        <div class="form-group col-12">
            <label for="name" class="form-label">Edit Developer name:</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?= $row['name'] ?? ''; // Alternative to: isset($rowing['name']) ? $rowing['name'] : '';  ?>"
                   placeholder="Edit Name">
        </div>
        <div class="form-group col-12">
            <label for="email" class="form-label">Edit Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?=$row['email'] ?>"
                   placeholder="Edit Email">
        </div>
        <div class="form-group col-12">
            <label for="phone" class="form-label">Edit Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?=$row['phone'] ?>"
                   placeholder="Edit Phone">
        </div>
        <div class="form-group col-12">
            <label for="location" class="form-label">Edit Location:</label>
            <input type="text" class="form-control" id="location" name="location"
                   value="<?=$row['location'] ?>" placeholder="Edit Location">
        </div>
        <div class="form-group col-12">
            <label for="profile_picture" class="form-label">Edit Profile Picture:</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                   value="<?= $_FILES["profile_picture"]["name"] ?? 0; // $_FILES["profile_picture"]["name"];  ?>"/>
            <!--            <input type='hidden' name='profile_picture_hidden' value='-->
            <?//= $_FILES["profile_picture"]["name"]; ?><!--' />-->
            <img id="profile_picture" src="<?= $row['profile_picture']; ?>" width="150px" height="100px"
                 alt="Profile image of the developer"/>
        </div>
        <div class="form-group col-12">
            <label for="price_per_hour" class="form-label">Edit Price Per Hour:</label>
            <input type="number" class="form-control" id="price_per_hour" name="price_per_hour"
                   value="<?=$row['price_per_hour'] ?>" placeholder="Edit Price Per Hour">
        </div>
        <div class="form-group col-12">
            <label for="inputState">Edit Technology:</label>
            <select name="technology" class="form-control">
                <?php $developer->selection_data_fetch($technologies, $row, "technology"); ?>
            </select>
        </div>
        <div class="form-group col-12">
            <label for="description" class="form-label">Edit Description:</label>
            <textarea id="description" name="description" class="form-control" rows="10"
                      cols="70"><?=$row['description'] ?></textarea>
        </div>
        <div class="form-group col-12">
            <label for="years_of_experience" class="form-label">Edit Years of experience:</label>
            <input type="text" class="form-control" id="years_of_experience" name="years_of_experience"
                   value="<?=$row['years_of_experience'] ?>" placeholder="Edit Years of experience">
        </div>
        <div class="form-group col-12">
            <label for="inputState">Edit selected Native Language:</label>
            <select id="inputState" name="native_language" class="form-control">
                <?php $developer->selection_data_fetch($native_languages, $row, "native_language"); ?>
            </select>
        </div>
        <div class="form-group col-12">
            <label for="linkedin_profile_link" class="form-label">Edit LinkdedIn profile link:</label>
            <input type="text" class="form-control" id="linkedin_profile_link" name="linkedin_profile_link"
                   value="<?=$row['linkedin_profile_link'] ?>" placeholder="Edit Linkedin Profile Link">
        </div>
        <div class="col-12 text-center">
            <button type="submit" name="update" value="Update" class="btn btn-primary ">Update</button>
        </div>
    </div>
</form>

<?php
}
}
?>
</body>
</html>