<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$user_email = $_POST['user_email'];
		$user_location = $_POST['user_location'];
		
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		if(!empty($user_name) && !empty($user_email) && !empty($user_location) && !is_numeric($user_name) && $password === $password2)
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,user_email,user_location,password) values ('$user_id','$user_name','$user_email','$user_location','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			header("Location: signup.php?error=Enter valid information!!");
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Form</title>
  <link rel="stylesheet" href="signup.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    
	<header>
        <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
        <nav class="navigation">
		    <a href="home.php">Home</a>
            <a href="about-home.php">About</a>
            <a href="#">Contact</a>
            <a href="login.php">Login</a>
			
            <!--<a href="login.php"><button class="Login">Login</button></a>-->
        </nav>
    </header>
	
  <div class="wrapper">
    <form method="post">
      <h2>Sign Up</h2>
      <div class="input-field">
        <input type="text" id="name" name="user_name" required>
        <label>Your Name</label>
      </div>
      <div class="input-field">
        <input type="text" id="email" name="user_email" required>
        <label>Email</label>
      </div>
      <div class="input-field">
	    <input type="text" id="location" name="user_location" required>
        
        <label>Address</label>
      </div>
      
      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label>Password</label>
      </div>     
	  <div class="input-field">
        <input type="password" id="password2" name="password2" required>
        <label>Confirm password</label>
      </div>
	  <div class="error">
	  <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
	  </div>
      <button type="submit">Submit</button>
    </form>
  </div>
  <div class="social-icons">
  <footer>
        <a>&copy; 2023 ST-MOTORS. All rights reserved.&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        
  </footer>
  </div>
</body>
</html>