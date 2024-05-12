<?php 
  session_start();
  include_once "php/config.php";
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
$departments = [];
$dept_query = "SELECT * FROM departments";
$dept_result = mysqli_query($conn, $dept_query);
if ($dept_result && mysqli_num_rows($dept_result) > 0) {
    while ($dept_row = mysqli_fetch_assoc($dept_result)) {
        $departments[] = $dept_row;
    }
} else {
    $error = "Failed to load departments. Check database connection.";
}
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field input">
                    <label for="department">Department:</label>
                    <select name="dept_id" id="department" required>
                        <option value="">Select a Department</option>
                        <?php
                        if (!empty($departments)) {
                            foreach ($departments as $dept) {
                                echo "<option value='" . htmlspecialchars($dept['dept_id']) . "'>" . htmlspecialchars($dept['dept_name']) . "</option>";
                            }
                        } else {
                            echo "<option value=''>No departments available</option>";
                        }
                        ?>
                    </select>
                </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
