<?php
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = check_login($con);

// Check if the form is submitted to confirm a booking
if (isset($_POST['confirm_booking'])) {
    // Get the car ID from the form
    $car_id = $_POST['car_id'];

    // Get the user ID from the session
    $user_id = $user_data['id'];

    // Update the "confirm" attribute in the "orders" table to 1 for the selected car and user
    $sql = "UPDATE orders SET confirm = 1 WHERE carid = $car_id AND id = $user_id";
    mysqli_query($con, $sql);
    
    // You can also update other values in the "users" and "cars" tables here as needed
    // For example, you can deduct the booked car's price from the user's balance and mark the car as booked in the "cars" table.
    
    // Redirect back to the book_request.php page after confirming the booking
    header("Location: book_request.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ST - Motors</title>
    <style>
	/* book_request.php styles */
body {
    background: black;
}

.header {
    position: fixed;
    width: 100%;
    background-color: black;
    color: white;
    padding: 10px 0;
}

.book-requests {
    text-align: center;
    color: white;
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px;
    background-color: black;
}

.book-requests h2 {
    color: white;
    font-family: "brush script mt", cursive;
    font-size: 50px;
    text-align: center;
}

.book-requests ul {
    list-style: none;
    padding: 0;
}

.book-requests li {
    background-color: black;
    border: 1px solid #ddd;
    padding: 20px;
    margin: 10px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.book-requests h3 {
    font-size: 20px;
    color: white;
    margin: 0;
}

.book-requests p {
    font-size: 15px;
    color: red;
    margin: 0;
}

.book-requests form {
    margin: 0;
}

.book-requests button[type="submit"] {
    background-color: brown;
    color: black;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 17px;
    font-family: "consolas", Arial, sans-serif;
    border-color: brown;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.book-requests button[type="submit"]:hover {
    background-color: #0056b3;
}

footer {
    text-align: center;
    padding: 20px 0;
    background-color: black;
    color: white;
    margin-top: 50px;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.jpg" width="170" height="60"></div>
			
            <ul class="nav-links">
			    
                <li><b href="#">Home</b></li>
				<li><a href="profile.php">Profile</a></li>
                <li><a href="about-index.php">About Us</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
    <section class="book-requests">
        <h2>Your Booking Requests</h2>
        <ul>
            <?php
            // Fetch booking requests for the user
            $user_id = $user_data['id'];
            $sql = "SELECT * FROM orders WHERE id = $user_id AND confirm = 0";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                // Get car information for the booking request
                $car_id = $row['carid'];
                $car_sql = "SELECT * FROM cars WHERE carid = $car_id";
                $car_result = mysqli_query($con, $car_sql);
                $car_row = mysqli_fetch_assoc($car_result);

                echo "<li>";
                echo "<h3>" . $car_row['company'] . " " . $car_row['model'] . "</h3>";
                echo "<p>Price: $" . $car_row['price'] . "</p>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='car_id' value='$car_id'>";
                echo "<button type='submit' name='confirm_booking'>Confirm Booking</button>";
                echo "</form>";
                echo "</li>";
            }
            ?>
        </ul>
	</section>
    <footer>
        <p>&copy; 2023 ST-MOTORS. All rights reserved.</p>
    </footer>
</body>
</html>