<?php
require_once('db.php');
$dbClient = new DatabaseClient();


$developer_name = $dbClient->real_escape_string($_POST['developer_name']);
$developer_email = $dbClient->real_escape_string($_POST['developer_email']);
$phone = $dbClient->real_escape_string($_POST['phone']);
$location = $dbClient->real_escape_string($_POST['location']);
$profile_picture = $dbClient->real_escape_string($_POST['profile_picture']);
$price_per_hour = $dbClient->real_escape_string($_POST['price_per_hour']);
$technology_selection = $dbClient->real_escape_string($_POST['technology_selection']);
$description = $dbClient->real_escape_string($_POST['description']);
$years_of_experience = $dbClient->real_escape_string($_POST['years_of_experience']);
$native_language_selection = $dbClient->real_escape_string($_POST['native_language_selection']);
$linkedin = $dbClient->real_escape_string($_POST['linkedin']);

if (isset($_POST['submit'])) {
    if (!empty($developer_name) || !empty($developer_email) || !empty($technology_selection)) {
        $profile_picture_filename = $_FILES["profile_picture"]["name"];
        $tempname = $_FILES["profile_picture"]["tmp_name"];
        $image_path = "../resources/images/" . $profile_picture_filename;
        // Get all the submitted data from the form

        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $image_path)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }

        $dbClient->insert('developers',
            [
                'name',
                'email',
                'phone',
                'location',
                'profile_picture',
                'price_per_hour',
                'technology',
                'description',
                'years_of_experience',
                'native_language',
                'linkedin_profile_link'
            ], [
                $developer_name,
                $developer_email,
                $phone,
                $location,
                $image_path,
                $price_per_hour,
                $technology_selection,
                $description,
                $years_of_experience,
                $native_language_selection,
                $linkedin,
            ]);
    } else {
        echo "<script>alert('Add Valid Data!');window.location.href='create_developer.php';</script>";
    }
    header("Location: ../public/index.php");
    exit();
}


