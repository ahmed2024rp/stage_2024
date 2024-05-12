<?php 
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();  // Ensure that the script stops executing after the redirect
}

$userFound = false;  // Flag to track if a user is found

$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $userFound = true;  // Set flag to true as user is found
}

if (!$userFound) {
    // No user found, redirect to the login page
    header("location: login.php");
    exit();  // Stop further execution
}
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php if ($userFound): ?>
            <img src="php/images/<?php echo htmlspecialchars($row['img']); ?>" alt="">
            <div class="details">
              <span><?php echo htmlspecialchars($row['fname']) . " " . htmlspecialchars($row['lname']) ?></span>
              <p><?php echo htmlspecialchars($row['status']); ?></p>
            </div>
            <div >
              <a href="php/logout.php?logout_id=<?php echo htmlspecialchars($row['unique_id']); ?>"  >
                <img id="im1" src="assets/logout3.png" alt="">
              </a>
              <?php endif; ?>
              <a href="list.php">
              <img src="assets/img.avif" alt="">
              </a>
              <a  href="settings.php"><i  class="fa fa-cog" aria-hidden="true"></i></a>
            </div>          
        </div>
      </header>
      <div class="search">
        <span class="text">Select a user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
