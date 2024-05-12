<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();
}

// Fetch current user information
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
$userData = mysqli_fetch_assoc($sql) ?? null;

if (!$userData) {
    header("location: login.php");
    exit();
}

include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="form settings">
            <header>Account Settings</header>
            <form action="update_settings.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="field input">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                </div>
                <div class="field input">
                    <label>First Name</label>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($userData['fname']); ?>" required>
                </div>
                <div class="field input">
                    <label>Last Name</label>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($userData['lname']); ?>" required>
                </div>
                <div class="field image">
                    <label>Change Image</label>
                    <input type="file" name="new_image">
                </div>
                <div class="field button">
                    <input type="submit" value="Update Settings">
                </div>
            </form>
            <div class="back">
                <a href="users.php">Back to chat</a>
            </div>
        </section>
    </div>

    <script src="javascript/settings.js"></script>
</body>
</html>
