<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
						if($user_data['active'] == 0){
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
						}
						header("Location: login.php?success=Your'e not active !!");
						die;
					}
					
				}
				header("Location: login.php?error=Wrong username or password !!");
			}
			
			/*header("Location: login.php?error=Wrong username or password !!");*/
		}else
		{
			header("Location: login.php?error=Wrong username or password !!");
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
        <nav class="navigation">
		    <a href="home.php">Home</a>
			<a href="adminlogin.php">Admin</a>
            <a href="about-home.php">About</a>
            <a href="#">Contact</a>
            <b>Login</b>
			
            <!--<a href="login.php"><button class="Login">Login</button></a>-->
        </nav>
    </header>
  <div class="wrapper">
    <form method="post">
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" id="name" name="user_name" required>
        <label>Username</label>
      </div>
      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label>Enter your password</label>
      </div>
	  
	  <div class="error">
	  <?php if (isset($_GET['success'])) { ?>
     		<p class="error"><?php echo $_GET['success']; ?></p>
      <?php } ?>
	  </div>
	  <div class="error">
	  <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
      <?php } ?>
	  </div>
	  
      <button type="submit">Log In</button>
      <div class="register">
        <p>Don't have an account? <a href="signup.php">Register</a></p>
      </div>
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