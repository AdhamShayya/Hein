<?php
session_start(); // Start the session
require_once('db_connect.php');
if (isset($_SESSION['user'])) {
	$loggedInUser = $_SESSION['user'];
}
// Check if the user is logged in
if (isset($_POST['Login'])) {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
}
if (isset($_POST['Logout'])) {
    $_SESSION = array();
    session_destroy();
	header("Location: index.php");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message'])) {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
        $message = $_POST['message'];
        if ($message != "") {
            $sql = "INSERT INTO comments (name, message) VALUES ('{$_SESSION['user']}', '$message')";
            if ($conn->query($sql) === TRUE) {
                echo " Comment added successfully thanks for your time!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Please add a comment:";
        }
    }

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap.min.css.map">
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
		<nav class="navbar">
			<h1 class="logo">AA Cafe</h1>
			<form method="POST" class="navbar-container container">
				<ul class="menu-items">
					<li class="col-sm-1 marr"><a href="#home">Home</a></li>
					<li class="col-sm-1 marr"><a href="#about">About</a></li>
					<li class="col-sm-1 marr"><a href="#contact">Contact</a></li>
					<li class="col-sm-1 marr"><a href="menu.php">Menu</a></li>
					<li class="col-sm-1 marr"><a href="#home">More</a></li> 
					<?php
                    if (isset($loggedInUser)) {
                        echo '<span >Welcome, ' . $loggedInUser . '<button name="Logout" class="btn btn-dark" style="color: white">Logout</button></span>';
                    } else {
                        echo '<button name="Login" class="btn btn-dark" style="color: white">Login</button>';
                    }
                    ?>
				</ul>
</form>
		</nav>
		<section class="anim">
			<div class="hero-text" id="home">
				<h1>Welcome to AA Cafe</h1>
				<p>Experience the taste of our delicious food</p>
			</div>
			<h1>Glimpse Of Our Menu</h1>
			<div class="container">
				<div class="row">
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px;">
							<img class="card-img-top" src="starters.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Starters</b></h4>
								<p class="card-text">Press down for more </p>
								<a href="menu.php#starters" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px;">
							<img class="card-img-top" src="breakfast.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Breakfast</b></h4>
								<p class="card-text">Press down for more </p>
								<a href="menu.php#breakfast" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px;">
							<img class="card-img-top" src="dinner.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Dinner</b></h4>
								<p class="card-text">Press down for more </p>
								<a href="menu.php#dinner" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<br>
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px;">
							<img class="card-img-top" src="download.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Burgers</b></h4>
								<p class="card-text">Press down for more </p>
								<a href="menu.php#burger" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px">
							<img class="card-img-top" src="sandwich.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Sandwiches</b></h4>
								<p class="card-text">Press down for more </p>
								<a href="menu.php#sandwich" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px">
							<img class="card-img-top" src="drink.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Drinks</b></h4>
								<p class="card-text">Press down for more </p>
								<a href="#" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
				</div>
					<br>
				<div class="row">
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px">
							<img class="card-img-top" src="forno.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Fornos</b></h4>
								<p class="card-text">Press down for more</p>
								<a href="#" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
					<br>
					<div class="col-sm-3 marr">
						<div class="card" style="width:300px">
							<img class="card-img-top" src="pizza.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Pizzas</b></h4>
								<p class="card-text">Press down for more</p>
								<a href="#" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
					<br>

					<div class="col-sm-3 marr">
						<div class="card" style="width:300px">
							<img class="card-img-top" src="dessert.jpg" alt="Card image" style="width:100%">
							<div class="card-body">
								<h4 class="card-title"><b>Desserts</b></h4>
								<p class="card-text">Press down for more</p>
								<a href="#" class="btn btn-secondary">Here</a>
							</div>
						</div>
					</div>
				</div>

				<section class="about" id="about">
					<h2>About Us</h2>
						<div class="about-text">
							<h3>Our Story</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultrices quam vel orci
								vehicula auctor. Suspendisse potenti. Nullam condimentum velit sit amet metus convallis,
								in ultricies mauris dapibus. Donec eu felis libero. Duis aliquam eget tellus et maximus.
								Vestibulum gravida justo lectus, vel tempor risus imperdiet eu. Quisque dignissim massa
								sit amet pharetra dapibus. Nulla auctor eleifend neque, eget suscipit sapien euismod
								vel. </p>
						</div>
					
				</section>

				<section class="contact" id="contact">
					<h2> Anything Wrong!! Contact Us</h2>
					
						<div class="contact-form">
							<h3>Send Us a Message</h3>
							<form method="POST" >
								<textarea name="message" placeholder="Your Message"></textarea>
								<button type="submit" id="message">Send Message</button>
							</form>
						</div>
						<div class="contact-info">
							<h3>Visit Us</h3>
							<P>Beirut</P>
							<p>Hamra</p>
							<h3>Call Us</h3>
							<p>(961) 12 345 678</p>
							<h3>Hours of Operation</h3>
							<p>Monday - Friday: 11am - 10pm</p>
							<p>Saturday - Sunday: 10am - 11pm</p>
						</div>
					<footer>
						<p>&copy; 2023 Resto Cafe. All rights reserved.</p>
					</footer>

				</section>
			</div>
		</section>
	<script>
		document.getElementById("message").addEventListener("click", function() {

  		var name = document.getElementById("nam").value;
  		var message = "Hello, " + name + "! We will try to solve this issue soon!";
 		alert(message);
	});
	</script>
</body>

</html>