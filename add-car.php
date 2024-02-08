<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_admin($con);

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
	margin-top: -60px;
    padding: 40px;
	background-color: black;
}

.featured-cars button {
  background: #fff;
  color: #000;
  font-family:"consolas";
  font-weight: 600;
  border: none;
  padding: 12px 20px;
  cursor: pointer;
  border-radius: 3px;
  font-size: 16px;
  border: 2px solid transparent;
  transition: 0.3s ease;
}

input[type="file"] {
    width: 10px;
	font-family:"consolas";
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 0px;
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
	margin-bottom:0px;
	margin-top: -5px;
}
</style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
			
            <ul class="nav-links">
			    
                <li><a href="index-admin.php">Home</a></li>
                <li><b href="#">Manage Cars</b></li>
                <li><a href="Manage_user.php">Manage Users</b></li>
                <li><a href="adminlogout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <section class="featured-cars">
    <form method="POST" enctype="multipart/form-data">
	  
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?><br><br>
	  
      <div class="input-field">
        <label>Car Image</label><br>
		<input type="file" id="image" name="image" required>
      </div><br>
      
      <div class="input-field">
	    <label>Brand Name</label><br>
        <input type="text" id="company" name="company" required>
      </div><br>   
	  
	  <div class="input-field">
	    <label>Model</label><br>
        <input type="text" id="model" name="model" required>
      </div>
	  
	  <div class="input-field">
	    <label>Type</label><br>
        <input type="text" id="type" name="type" required>
      </div>
	  
	  <div class="input-field">
	    <label>Price</label><br>
        <input type="text" id="price" name="price" required>
      </div>
       	    
      <br><button name="submit" type="submit" value="submit">Add Car</button>
    </form>
    </section>
    
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    // Retrieve form data
    $image = $_FILES["image"]["name"];
    $company = $_POST["company"];
    $model= $_POST["model"];
    $type = $_POST["type"];
    $price = $_POST["price"];
    
    if(!is_numeric($company) && !is_numeric($model) && !is_numeric($type) && is_numeric($price))
	{
    // Insert data into the database
    $sql = "INSERT INTO cars (image, company, model, type, price,status) VALUES ('$image', '$company', '$model', '$type', $price,1)";

    if (mysqli_query($con, $sql)) {
        // Upload the image to a specified directory
        move_uploaded_file($_FILES["image"]["tmp_name"], "car_images/" . $image);
        header("Location: add-car.php?success=Car added successfully");
    }
	else {
        header("Location: add-car.php?error=Invalid Input !!");
    }

    // Close the database connection
    mysqli_close($con);
	}
	else{
		header("Location: add-car.php?error=Invalid Input !!");
	}
}
?>