<?php
session_start();
include_once "php/config.php";

if (!isset($_SESSION['unique_id']) || empty($_POST['group_message'])) {
    header("location: login.php");
    exit();
}

$outgoing_id = $_SESSION['unique_id'];
$message = mysqli_real_escape_string($conn, $_POST['group_message']);
$user_ids = $_POST['user_ids'] ?? [];

foreach ($user_ids as $incoming_id) {
    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}')") or die(mysqli_error($conn));
    }
}

header("location: users.php"); 
?>
