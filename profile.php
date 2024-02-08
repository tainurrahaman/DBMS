<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST - Motors</title>
    <style>
	
	body, h1, h2, h3, p {
    margin: 0 auto;
    padding: 0;
	background-color: black;
}

/* Basic styling */
body {
    font-family: "consolas",Arial, sans-serif;
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


.featured-cars {
	text-align: center;
	color: white;
    max-width: 1400px;
    margin: 0 auto;
	margin-top: 100px;
    padding: 40px;
	background-color: black;
}

.featured-cars button {
  background: #fff;
  color: #000;
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}

.featured-cars button:hover {
  color: #fff;
  border-color: #fff;
  background: rgba(255, 255, 255, 0.15);
}


footer {
    text-align: center;
    padding: 20px 0;
    background-color: black;
    color: white;
	margin-bottom:20px;
	margin-top: 150px;
}
	
	</style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
				<li><b href="profile.php">Profile</b></li>
                <li><a href="about-index.php">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <section class="featured-cars">
        <h1>Name : <?php echo $user_data['user_name']; ?></h1><br>
        <h1>Email : <?php echo $user_data['user_email']; ?></h1><br>
		<h1>Location : <?php echo $user_data['user_location']; ?></h1><br>
		<a href="changepass.php"><button type="submit">Change Password</button></a>
    </section>
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>