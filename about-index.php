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
    margin: 0;
    padding: 0;
}


body {
    font-family: "consolas",Arial, sans-serif;
}

header {
	
	position:fixed;
	width:100%;
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

.about-us{
  height: 65vh;
  width: 100%;
  padding: 90px 0;
  background:black;
}

.about{
  width: 1130px;
  max-width: 85%;
  margin: 0 auto;
  margin-top:30px;
  display: flex;
  align-items: center;
  justify-content: space-around;
}
.text{
  width: 540px;
}
.text h2{
  font-size: 70px;
  color: white;
  font-weight: 600;
  margin-bottom: -15px;

}
.text h5{
  font-size: 22px;
  color: white;
  font-weight: 500;
  margin-bottom: 20px;
}

.text p{
  font-size: 18px;
  color: white;
  line-height: 25px;
  letter-spacing: 1px;
}

footer {
    text-align: center;
    padding: 20px 0;
    background-color: black;
    color: white;
}
	
	
	</style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
				<li><a href="profile.php">Profile</a></li>
                <li><b href="#">About Us</b></li>
                <li><a href="#">Contact</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <section class="about-us">
    <div class="about">
      <div class="text">
        <h2>About Us</h2>
        <h5>Buy or Rent a car</h5>
          <p> At ST-MOTORS, we are passionate about automobiles. With a rich history spanning over two decades, we have become a trusted name in the automotive industry. Our mission is to provide our customers with the best vehicles and services in the market.</p>
		  <p>Thank you for choosing ST-MOTORS. We look forward to serving you and being a part of your automotive journey.</p>
        
      </div>
    </div>
    </section>
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>