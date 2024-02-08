<?php
session_start();
include('connection.php');
include('functions.php');

// Check if the user is an admin
$user_data = check_admin($con);

if (!$user_data) {
    header("Location: adminlogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submissions here
    if (isset($_POST['update']) && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $active = $_POST['active'];

        $sql = "UPDATE users SET active = '$active' WHERE user_id = '$user_id'";
        $update_result = mysqli_query($con, $sql);

        if (!$update_result) {
            echo "Error updating user: " . mysqli_error($con);
        }
    }

    if (isset($_POST['delete']) && isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $sql = "DELETE FROM users WHERE user_id = '$user_id'";
        $delete_user = mysqli_query($con, $sql);
        if (!$delete_user) {
            echo "Error deleting user: " . mysqli_error($con);
        }
    }
}

$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql);

if (!$result) {
    echo "Error: " . mysqli_error($con);
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST - Motors</title>
        <style>
		
		/* style.css */

body {
    font-family: "consolas", Arial, sans-serif;
    background-color: black;
    color: white;
    margin: 0;
    padding: 0;
}

header {
    background-color: black;
    color: white;
    padding: 10px 0;
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin-right: 20px;
}

.nav-links a {
    color: red;
	font-size:20px;
    text-decoration: none;
}

.nav-links b {
    color: white;
	font-size:20px;
    text-decoration: none;
}


.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
	margin-top:50px;
}

h2 {
    font-size: 24px;
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid white;
    padding: 10px;
    text-align: center;
}

th {
    background-color: red;
    color: white;
}

tr:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.1);
}

tr:hover {
    background-color: rgba(255, 255, 255, 0.2);
}

select {
    padding: 5px;
}

button {
    background: #fff;
    color: #000;
    font-family: "consolas";
    font-weight: 600;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 3px;
    font-size: 14px;
    border: 2px solid transparent;
    transition: 0.3s ease;
}

button:hover {
    color: #fff;
    border-color: #fff;
    background: rgba(255, 255, 255, 0.15);
}

footer {
    text-align: center;
    padding: 20px 0;
    background-color: black;
    color: white;
    margin-top: 0px;
}

		
        </style>
    </head>
    <body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
			
            <ul class="nav-links">
			    
                <li><a href="index-admin.php">Home</a></li>
                <li><a href="add-car.php">Manage Cars</a></li>
                <li><b href="#">Manage Users</b></li>
                <li><a href="adminlogout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            
            <table>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    
                    
                    <th>Action</th>
                    <th>Delete</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['user_id']}</td>";
                    echo "<td>{$row['user_name']}</td>";
                    echo "<td>{$row['user_email']}</td>";
                    echo "<td>{$row['user_location']}</td>";
                    
                    
                    echo "<td>
                        <form action='' method='post'>
                            <input type='hidden' name='user_id' value='{$row['user_id']}'>
                            <select name='active'>
                                <option value='0' " . ($row['active'] == 0 ? 'selected' : '') . ">Active</option>
                                <option value='1' " . ($row['active'] == 1 ? 'selected' : '') . ">Inactive</option>
                            </select>
                            <input type='submit' name='update' value='Update'>
                        </form>
                    </td>";
                    echo "<td>
                        <form action='' method='post'>
                            <input type='hidden' name='user_id' value='{$row['user_id']}'>
                            <input type='submit' name='delete' value='Delete'>
                        </form>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>

    </body>
    </html>
    <?php
}

mysqli_close($con);
?>