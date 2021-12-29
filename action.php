<?php
require_once('db.php');
$dbClient = new DatabaseClient();


$developer_name = $_POST['developer_name'];
$developer_email = $_POST['developer_email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$profile_picture = $_POST['profile_picture'];
$price_per_hour = $_POST['price_per_hour'];
$technology_selection = $_POST['technology_selection'];
$description = $_POST['description'];
$years_of_experience = $_POST['years_of_experience'];
$native_language_selection = $_POST['native_language_selection'];
$linkedin = $_POST['linkedin'];

if (isset($_POST['submit'])) {
    if (!empty($developer_name) || !empty($developer_email) || !empty($technology_selection)) {
        $profile_picture_filename = $_FILES["profile_picture"]["name"];
        $tempname = $_FILES["profile_picture"]["tmp_name"];
        $image_path = "assets/images/" . $profile_picture_filename;
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
//    header("Location: index.php");
//    exit();
}


