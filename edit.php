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
<?php include('header.php'); ?>
<br>
</body>
</html>
<?php
require_once('db.php');
//include_once('action.php');
$dbClient = new DatabaseClient();

$client_name = $dbClient->real_escape_string($_POST['client_name']);
$code_type = $dbClient->real_escape_string($_POST['type_code']);
$technology = $_POST['technology'];
$native_language = $_POST['native_language'];
$mat_quantity = $_POST['quantity'];


$where_condition_select = array(
    'id' => $_GET['id']
);

$query = $dbClient->select_where('developers', $where_condition_select);

if (isset($_POST['update'])) {

    $profile_picture_filename = $_FILES["profile_picture"]["name"];
    $tempname = $_FILES["profile_picture"]["tmp_name"];
    $image_path = "assets/images/" . $profile_picture_filename;

    if (move_uploaded_file($tempname, $image_path)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    $c = count($technology);
    $price = 0;


    if ($technology == "javascript") {
        $technology = "JavaScript";
    }
    if ($technology == "java") {
        $technology = "Java";
    }
    if ($technology == "dotnet") {
        $technology = "dotnet";
    }
    if ($technology == "flutter") {
        $technology = "Flutter";
    }
    if ($technology == "python") {
        $technology = "Python";
    }
    if ($technology == "php") {
        $technology = "PHP";
    }
    if ($native_language == "english") {
        $native_language = "English";
    }
    if ($native_language == "serbian") {
        $native_language = "Serbian";
    }
    if ($native_language == "bulgarian") {
        $native_language = "Bulgarian";
    }
//    }

    $name = $_POST['name'];
    $code_type = $_POST['code_type'];

    $update_data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'location' => $_POST['location'],
        'profile_picture' => $image_path,
        'price_per_hour' => $_POST['price_per_hour'],
        'technology' => $_POST['technology'],
        'description' => $_POST['description'],
        'years_of_experience' => $_POST['years_of_experience'],
        'native_language' => $_POST['native_language'],
        'linkedin_profile_link' => $_POST['linkedin_profile_link'],
    );

    $where_condition = array(
        'id' => $_GET['id']
    );

    $edit = $dbClient->update("developers", $update_data, $where_condition);
    if ($edit) {
        // Close connection
        header("Location:index.php"); // redirects to all records page
        exit;
    }

}
?>
<br><h3 class="text-center">Edit data:</h3><br>
<form class="col-6 container" name="form" method="POST" enctype="multipart/form-data"><br>
    <div class="row">
        <?php
        $id = $_GET['id'];
        $selection_all_clients = $dbClient->select('developers', ['*'], "id='$id'");
        if (mysqli_num_rows($selection_all_clients) > 0) {
        while ($rowing = mysqli_fetch_array($selection_all_clients)) {
        $technologies = ["JavaScript", "Java", ".NET", "Flutter", "Python", "PHP"];
        $native_languages = ["English", "Serbian", "Bulgarian"];
        ?>
        <div class="form-group col-12">
            <label for="name" class="form-label">Edit Developer name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $rowing['name'] ?>"
                   placeholder="Edit Name">
        </div>
        <div class="form-group col-12">
            <label for="email" class="form-label">Edit Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $rowing['email'] ?>"
                   placeholder="Edit Email">
        </div>
        <div class="form-group col-12">
            <label for="phone" class="form-label">Edit Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $rowing['phone'] ?>"
                   placeholder="Edit Phone">
        </div>
        <div class="form-group col-12">
            <label for="location" class="form-label">Edit Location:</label>
            <input type="text" class="form-control" id="location" name="location"
                   value="<?php echo $rowing['location'] ?>" placeholder="Edit Location">
        </div>
        <div class="form-group col-12">
            <label for="profile_picture" class="form-label">Edit Profile Picture:</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture"
                   value="<?=$_FILES["profile_picture"]["name"]; ?>"/>
            <img src="<?=$rowing['profile_picture']; ?>" width="150px" height="100px" />
        </div>
        <div class="form-group col-12">
            <label for="price_per_hour" class="form-label">Edit Price Per Hour:</label>
            <input type="number" class="form-control" id="price_per_hour" name="price_per_hour"
                   value="<?php echo $rowing['price_per_hour'] ?>" placeholder="Edit Price Per Hour">
        </div>
        <div class="form-group col-12">
            <label for="description" class="form-label">Edit Description:</label>
            <textarea name="description" rows="10" cols="70"><?php echo $rowing['description'] ?></textarea>
        </div>
        <div class="form-group col-12">
            <label for="years_of_experience" class="form-label">Edit Years of experience:</label>
            <input type="text" class="form-control" id="years_of_experience" name="years_of_experience"
                   value="<?php echo $rowing['years_of_experience'] ?>" placeholder="Edit Years of experience">
        </div>
        <div class="form-group col-12">
            <label for="linkedin_profile_link" class="form-label">Edit LinkdedIn profile link:</label>
            <input type="text" class="form-control" id="linkedin_profile_link" name="linkedin_profile_link"
                   value="<?php echo $rowing['linkedin_profile_link'] ?>" placeholder="Edit Linkedin Profile Link">
        </div>
        <div class="form-group col-12">
            <label for="inputState">Edit selected Native Language:</label>
            <select name="native_language" class="form-control"> <?php
                foreach ($native_languages as $native_language) {
                    if ($native_language == $rowing['native_language'] || $native_language == $rowing['native_language'] || $native_language == $rowing['native_language']) {
                        ?>
                        <option value="<?php echo $native_language ?>" selected><?php echo $native_language ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $native_language ?>"><?php echo $native_language ?></option>
                        <?php
                    }
                }
                ?></select>
        </div>
        <div class="form-group col-12">
            <label for="inputState">Edit technology:</label>
            <select name="technology" class="form-control">
                <?php
                foreach ($technologies as $technology) {
                    if ($technology == $rowing['technology'] || $technology == $rowing['technology'] || $technology == $rowing['technology'] || $technology == $rowing['technology'] || $technology == $rowing['technology'] || $technology == $rowing['technology']) {
                        ?>
                        <option value="<?php echo $technology ?>" selected><?php echo $technology ?></option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $technology ?>"><?php echo $technology ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-12 text-center">
            <button type="submit" name="update" value="Update" class="btn btn-primary ">Edit</button>
        </div>
    </div>
</form>

<?php
}
}
?>