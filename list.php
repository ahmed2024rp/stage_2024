<?php 
session_start();
include_once "php/config.php"; 
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();
}
include_once "header2.php";
?>

<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <a href="users.php" class="btn btn-secondary">Back</a>
        <h4>User List</h4>
    </div>

    <!-- Department Filter Form -->
    <form action="list.php" method="GET" class="mb-3">
        <div class="form-group">
            <label for="filter_dept">Filter by Department:</label>
            <select name="dept_id" id="filter_dept" class="form-control">
                <option value="">All Departments</option>
                <?php
                $dept_query = "SELECT * FROM departments";
                $dept_result = mysqli_query($conn, $dept_query);
                if(mysqli_num_rows($dept_result) > 0){
                    while($dept_row = mysqli_fetch_assoc($dept_result)){
                        $selected = (isset($_GET['dept_id']) && $_GET['dept_id'] == $dept_row['dept_id']) ? 'selected' : '';
                        echo "<option value='".$dept_row['dept_id']."' $selected>".$dept_row['dept_name']."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- User Listing Table -->
    <form class="form-group" action="send_group_message.php" method="post">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dept_filter = isset($_GET['dept_id']) && !empty($_GET['dept_id']) ? $_GET['dept_id'] : null;
                    $sql = "SELECT users.unique_id, users.fname, users.lname, users.email, departments.dept_name FROM users LEFT JOIN departments ON users.dept_id = departments.dept_id";
                    if ($dept_filter) {
                        $sql .= " WHERE users.dept_id = $dept_filter";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <td>{$row['unique_id']}</td>
                                <td>{$row['fname']} {$row['lname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['dept_name']}</td>
                                <td><input type='checkbox' name='user_ids[]' value='{$row['unique_id']}'></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex">
            <input class="form-control me-2" type="text" name="group_message" placeholder="Enter your message here..." required>
            <button class="btn btn-dark" type="submit">Send Message</button>
        </div>
    </form>
</div>

<script src="javascript/users.js"></script>
</body>
</html>
