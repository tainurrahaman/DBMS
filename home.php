<?php 
session_start();

	include("connection.php");
	include("functions.php");

	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST - Motors</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
            <ul class="nav-links">
                <li><b href="#">Home</b></li>
                <li><a href="about-home.php">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <h1>WELCOME TO YOUR</h1>
		<h2>ST-MOTORS EXPERIENCE</h2>
        <a href="#" class="cta-button">View Cars</a>
    </section>
    
	<div class="product-row">
<?php


// Fetch car data from the database
$sql = "SELECT * FROM cars";
$result = mysqli_query($con, $sql);

// Loop through the results and generate product cards
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='product-card'>";
    echo "<img src='" . $row['image'] . "' alt='Car Image'>";
    echo "<h2>" . $row['company'] . "</h2>";
    echo "<p>" . $row['model'] . "</p>";
    echo "<p>Starting from $" . $row['price'] . "</p>";
    echo "</div>";
}

// Close the database connection
mysqli_close($con);
?>
</div>
	
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>