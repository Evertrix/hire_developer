<?php
require_once('db.php');
//include_once('action.php');

    function updateQuery()
    {
        $dbClient = new DatabaseClient();
//        $code_type = $dbClient->real_escape_string($_POST['type_code']);
        $technology = $_POST['technology'];
        $native_language = $_POST['native_language'];


        $where_condition_select = array(
            'id' => $_GET['id']
        );

        $query = $dbClient->select_where('developers', $where_condition_select);

        if (isset($_POST['update'])) {

            $profile_picture_filename = $_FILES["profile_picture"]["name"];
            $tempname = $_FILES["profile_picture"]["tmp_name"];
            $image_path = "../resources/images/" . $profile_picture_filename;

            if (move_uploaded_file($tempname, $image_path)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }

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

//            $name = $_POST['name'];
//            $code_type = $_POST['code_type'];

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

            if(empty($_FILES["profile_picture"]["name"])) {
                unset($update_data['profile_picture']);
                $dbClient->update("developers", $update_data, $where_condition);
            } else {
                $dbClient->update("developers", $update_data, $where_condition);
            }

            // Close connection
            header("Location: ../public/index.php"); // redirects to all records page
            exit;

        }
    }


    function foreachNativeLanguage($native_param, $row_param) {
        foreach ($native_param as $native_language) {
            if ($native_language == $row_param['native_language'] || $native_language == $row_param['native_language'] || $native_language == $row_param['native_language']) {
                ?>
                <option value="<?php echo $native_language ?>" selected><?php echo $native_language ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $native_language ?>"><?php echo $native_language ?></option>
                <?php
            }
        }
    }


    function foreachTechnologies($teachno_param, $row_param) {
        foreach ($teachno_param as $technology) {
            if ($technology == $row_param['technology'] || $technology == $row_param['technology'] || $technology == $row_param['technology'] || $technology == $row_param['technology'] || $technology == $row_param['technology'] || $technology == $row_param['technology']) {
                ?>
                <option value="<?php echo $technology ?>" selected><?php echo $technology ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $technology ?>"><?php echo $technology ?></option>
                <?php
            }
        }
    }


    function submit_developer_for_hire($db_client_parameter) {
        if (isset($_POST["submit"])) {
            $now = date("Y-m-d H:i:s");
            $select_developer_to_hire = $_POST['select_developer_to_hire'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            foreach ($select_developer_to_hire as $single_dev) {
                // SQL selection for a single developer. Check if there is an overlap with the dates of hire.
                $developer_for_hire_from_db_select = $db_client_parameter->select('hire_developers', ['names'], "(names = '$single_dev') AND ('$start_date' <= end_date AND '$end_date' >= start_date)"); // , "start_date = $start_date AND end_date = $end_date"
                $check_rows = mysqli_num_rows($developer_for_hire_from_db_select);
                if ($check_rows > 0) {
                    header('Location: ../public/hiring.php');
                    die("Select valid date");
                }

                // Validation checks.
                if ($end_date < $start_date) {
                    header('Location: ../public/hiring.php');
                    die("Select valid date");
                }
                if ($start_date < $now || $end_date < $now) {
                    header('Location: ../public/hiring.php');
                    die("Select valid date");
                }
                // Insert a single developer in the db as a record. If multiple developers are selected, foreach all the selected before exiting.
                $db_client_parameter->insert('hire_developers', ['names', 'start_date', 'end_date'], [$single_dev, $_POST['start_date'], $_POST['end_date']]);

            }

            if($db_client_parameter->select_where('hire_developers', "NOW() > 'end_date'")) {
                //    DELETE FROM hire_developers WHERE end_date < NOW()
                $db_client_parameter->delete('hire_developers', ['end_date'], [$_POST['end_date']]);
                header('Location: ../public/hiring.php');
                die("Select valid date");
            }

            header('Location: ../public/hiring.php');
            exit();
        }
    }

    function selection_all_developers($dev_parm) {
        while ($rows = mysqli_fetch_assoc($dev_parm)) {
            ?>
            <option value="<?= $rows['name']; ?>"><?= $rows['name']; ?></option>
            <?php
        }
    }

    function select_hired_developers($row_rams) {
        while ($row = mysqli_fetch_assoc($row_rams)) {
            $image_src = $row['profile_picture'];
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $row['names'] . "</td>";
            echo "<td>" . $row['start_date'] . "</td>";
            echo "<td>" . $row['end_date'] . "</td>";
            ?>
            <td><a href="../src/delete_hired_developer.php?id=<?php echo $row['id']; ?>">Delete</a></td>
            <?php
            echo "</tr>";
            echo "</tbody>";
        }
    }