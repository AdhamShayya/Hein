<?php
//user's menu
session_start();
require_once("db_connect.php");

// add to cart 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add']) ) {
	if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }else{
    // Retrieve form data
    $item_name = $_POST["item_name"];
    $item_price = $_POST["item_price"];
	$sql = "INSERT INTO shopping_cart (user_id, item_name, item_price) 
    VALUES ('{$_SESSION['id']}', '$item_name', '$item_price')";

if ($conn->query($sql) === TRUE) {
    header("Location: menu.php");
    echo "Item added to the shopping cart successfully!";
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
}
if (isset($_POST['cart'])) {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }else{
		header("Location: delivery.php");
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css.map" >
    <link rel="stylesheet" href="bootstrap.min.css" >
    <link rel="stylesheet" href="style.css"> 
	
    <title>Document</title>
</head>
<body>
	<nav class="navbar">
		<div class="navbar-container container">	
			<form method="POST">
			<ul class="menu-items">
			<li><h1 class="logo marr" >AA Cafe</h1></li>
				<li class="marr"><a href="#starters">Starters</a></li>
				<li class="marr"><a href="#breakfast">Breakfast</a></li>
				<li class="marr"><button name="cart" class="btn btn-dark" style="color: white">View Cart</button></li>
				<li class="marr"><a href="index.php">Home</a></li>
				<li class="marr"><a href="#dinner">Dinner</a></li>
				
			</ul>
            </form>
		</div>
	</nav>
	<section class="anim">
    <h1 style="text-align: center;">Welcome To Our Menu</h1>

<div  id="starters">
    <div >
        <h1><b>For Starters:</b></h1>
        <div class="row">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM starters");
            if ($result) {
                $starters = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($starters as $starter) {
                echo '<div class="col-sm-3 marr">';
                echo '<div class="card" style="width:300px;">';
                echo '<img class="card-img-top" src="images/' . $starter['image_url'] . '" alt="Card image" style="width:100%">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title"><b>' . $starter['name'] . '</b></h4>';
                echo '<p class="card-text price">' . $starter['price'] . '$</p>';
                echo '<form method="POST" name="add">';
                echo '<input type="hidden" name="item_name" value="' . $starter['name'] . '">';
                echo '<input type="hidden" name="item_price" value="' . $starter['price'] . '">';
                echo '<button type="submit" name="add" class="btn btn-secondary">Add for Delivery</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
            }
        }
            ?>
        </div>
        <br>
        <h2 style="text-align: center;"><b> --- Cafe Special Starters---</b></h2>
        <?php
            echo '<div class="marr col d-flex justify-content-center">';
            echo '<div class="card" style="width:300px;">';
            echo '<img class="card-img-top" src="images/kabab.jpg" alt="Card image" style="width:100%">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title"><b>Resto\'s Kabab</b></h4>';
            echo '<p class="card-text price">3$</p>';
            echo '<a href="delivery.html" class="btn btn-secondary">add for delivery</a>';
            echo '</div>';
            echo '</div>';
            ?>
        </div>
        <br>
    </div>
</div>
<hr>

<div id="breakfast">
    <div>
        <h1><b>For Breakfast:</b></h1>
        <div class="row">
            <?php
           
            $result = mysqli_query($conn, "SELECT * FROM breakfast");
            if ($result) {

                $breakfast = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($breakfast as $item) {
                echo '<div class="col-sm-3 marr">';
                echo '<div class="card" style="width:300px;">';
                echo '<img class="card-img-top" src="images/' . $item['image_url'] . '" alt="Card image" style="width:100%">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title"><b>' . $item['name'] . '</b></h4>';
                echo '<p class="card-text price">' . $item['price'] . '$</p>';
                echo '<form method="POST" name="add">';
                echo '<input type="hidden" name="item_name" value="' . $item['name'] . '">';
                echo '<input type="hidden" name="item_price" value="' . $item['price'] . '">';
                echo '<button type="submit" name="add" class="btn btn-secondary">Add for Delivery</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
            }
        }
            ?>
        </div>
        <br>
        </div>
    <div class="contanier">
        <h2 style="text-align: center;"><b> --- AA's Special breakfast---</b></h2>
        <div class="marr col d-flex justify-content-center">
            <?php
            // Additional card for AA's Special breakfast
            echo '<div class="card" style="width:300px;">';
            echo '<img class="card-img-top" src="Granola.jpg" alt="Card image" style="width:100%">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title"><b>Cafe\'s Granola</b></h4>';
            echo '<p class="card-text price">4$</p>';
            echo '<a href="delivery.html" class="btn btn-secondary">add for delivery</a>';
            echo '</div>';
            echo '</div>';
            ?>
        </div>
        <br>
    </div>
</div>
<hr>
<div id="dinner">
    <div>
        <h1><b>For Dinner:</b></h1>
        <div class="row">
            <?php
             $result = mysqli_query($conn, "SELECT * FROM dinner");
             if ($result) {

                 $dinner = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach ($dinner as $item) {
                echo '<div class="col-sm-3 marr">';
                echo '<div class="card" style="width:300px;">';
                echo '<img class="card-img-top" src="' . $item['image_url'] . '" alt="Card image" style="width:100%">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title"><b>' . $item['name'] . '</b></h4>';
                echo '<p class="card-text price">' . $item['price'] . '$</p>';
                echo '<form method="POST" name="add">';
                echo '<input type="hidden" name="item_name" value="' . $item['name'] . '">';
                echo '<input type="hidden" name="item_price" value="' . $item['price'] . '">';
                echo '<button type="submit" name="add" class="btn btn-secondary">Add for Delivery</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
            }
        }
            ?>
        </div>
        <br>
        </div>
    <div class="contanier">
        <h2 style="text-align: center;"><b> --- Resto Special Dinner---</b></h2>
        <div class="marr col d-flex justify-content-center">
            <?php
            // Additional card for Resto Special Dinner
            echo '<div class="card" style="width:300px;">';
            echo '<img class="card-img-top" src="special.jpg" alt="Card image" style="width:100%">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title"><b>Special Dinner</b></h4>';
            echo '<p class="card-text price">4$</p>';
            echo '<a href="delivery.html" class="btn btn-secondary">add for delivery</a>';
            echo '</div>';
            echo '</div>';
            ?>
        </div>
        <br>
    </div>
</div>
<hr>
<br>
<br>

<hr>
<br>
<br>
<h2>-- We are Working on Adding More Items to the Menu --</h2>
<h3>             --  Hope You Enjoyed!!  -- </h3>
	
</body>
</html>