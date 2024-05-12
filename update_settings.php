<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id']) || !isset($_POST)) {
    header("location: login.php");
    exit();
}

$unique_id = $_SESSION['unique_id'];
$email = mysqli_real_escape_string($conn, $_POST['email']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);

// Handle image upload
if (!empty($_FILES['new_image']['name'])) {
    $img_name = $_FILES['new_image']['name'];
    $tmp_name = $_FILES['new_image']['tmp_name'];
    $img_explode = explode('.', $img_name);
    $img_ext = end($img_explode);

    $extensions = ["jpeg", "png", "jpg"];
    if (in_array($img_ext, $extensions) === true) {
        $time = time();
        $new_img_name = $time . $img_name;
        if (move_uploaded_file($tmp_name, "php/images/" . $new_img_name)) {
            $update_query = mysqli_query($conn, "UPDATE users SET email='$email', fname='$fname', lname='$lname', img='$new_img_name' WHERE unique_id='$unique_id'");
        }
    }
} else {
    $update_query = mysqli_query($conn, "UPDATE users SET email='$email', fname='$fname', lname='$lname' WHERE unique_id='$unique_id'");
}

if ($update_query) {
    echo "Successfully updated";
} else {
    echo "Update failed";
}

header("location: users.php"); // Redirect to chat page
exit();
?>
