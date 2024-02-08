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
	margin-top: 40px;
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

.input-field label {
  font-size: 20px;
  transition: 0.15s ease;
}

.input-field input {
  width: 20%;
  height: 40px;
  background: transparent;
  font-size: 16px;
  color: #fff;
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
	margin-top: 60px;
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
    <form action="changepass.php" method="post">
	
	  
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?><br><br>
	  
      <div class="input-field">
        <label>Current Password</label><br>
		<input type="password" id="op" name="opass" required>
      </div><br>
      
      <div class="input-field">
	    <label>New Password</label><br>
        <input type="password" id="np" name="npass" required>
      </div><br>   
	  
	  <div class="input-field">
	    <label>Confirm password</label><br>
        <input type="password" id="c_np" name="cpass" required>
      </div>
	  
      <br><button name="submit" type="submit" value="submit">Change Password</button>
    </form>
    </section>
	
	<?php
if(isset($_POST['submit']))
{
	include("connection.php");
    $id=$_SESSION['user_id'];
    $opass=$_POST['opass'];
    $npass=$_POST['npass'];
	$cpass=$_POST['cpass'];
	if($npass==$cpass)
	{
	$sql="select password from users where password='$opass' and user_id='$id'";
    $r=mysqli_query($con,$sql);
    if(mysqli_num_rows($r)>0)
    {
       $sql1="update users set password='$npass' where user_id='$id'"; 
       if(mysqli_query($con,$sql1))
       {
         header("Location: changepass.php?success=Your password has been changed successfully");
       }  
    }
	else
	{
		header("Location: changepass.php?error=Incorrect password");
	}
	}
    else
    {
        header("Location: changepass.php?error=The confirmation password  does not match");
    }
}
?>
	
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>