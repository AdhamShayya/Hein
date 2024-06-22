<?php
    require_once("db_connect.php");
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".delete-btn").on("click", function (e) {
                e.preventDefault();
                var item_id = $(this).data("item-id");
                var category = $(this).data("category");

                $.ajax({
                    type: "POST",
                    url: "delete_item2.php",
                    data: { item_id: item_id, category: category },
                    success: function (response) {
                    alert(response); 
                    location.reload();
                    },
                    error: function () {
                        alert("Error occurred while deleting item.");
                    }
                });
            });
        });
</script>
    <title>Document</title>
</head>
<body>
<nav class="navbar">
    <div class="navbar-container container">	
        <form method="POST">
            <ul class="menu-items">
                <li><h1 class="logo marr">AA Cafe</h1></li>
                <li><a class="marr" href="#starters">Starters</a></li>
                <li><a class="marr" href="#breakfast">Breakfast</a></li>
                <li><a class="marr" href="index.php">Home</a></li>
                <li><a class="marr" href="#dinner">Dinner</a></li>
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
                echo '<img class="card-img-top" src="' . $starter['image_url'] . '" alt="Card image" style="width:100%">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title"><b>' . $starter['name'] . '</b></h4>';
                echo '<p class="card-text price">' . $starter['price'] . '$</p>';
                echo '<form method="POST">';
                echo '<input type="hidden" name="item_id" value="' .  $starter['id'] . '">';
                echo '<button class="btn btn-danger delete-btn" data-item-id="' . $starter['id'] . '" data-category="Sdelete">Delete</button>';
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
        <div class="marr col d-flex justify-content-center">
            <?php
            echo '<div class="card" style="width:300px;">';
            echo '<img class="card-img-top" src="kabab.jpg" alt="Card image" style="width:100%">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title"><b>Resto\'s Kabab</b></h4>';
            echo '<p class="card-text price">3$</p>';
            echo '</div>';
            echo '</div>';
            ?>
        </div>
        <br>
    </div>
</div>
<hr>

<div  id="breakfast">
    <div >
        <h1><b>For Breakfast:</b></h1>
        <div class="row">
            <?php
           
            $result = mysqli_query($conn, "SELECT * FROM breakfast");
            if ($result) {
                $breakfast = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($breakfast as $item) {
                echo '<div class="col-sm-3 marr">';
                echo '<div class="card" style="width:300px;">';
                echo '<img class="card-img-top" src="' . $item['image_url'] . '" alt="Card image" style="width:100%">';
                echo '<div class="card-body">';
                echo '<h4 class="card-title"><b>' . $item['name'] . '</b></h4>';
                echo '<p class="card-text price">' . $item['price'] . '$</p>';
                echo '<form method="POST" action="delete_item.php">';
                echo '<input type="hidden" name="item_id" value="' .  $item['id'] . '">';
               echo '<button class="btn btn-danger delete-btn" data-item-id="' . $item['id'] . '" data-category="Bdelete">Delete</button>';
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
        <h2 style="text-align: center;"><b> --- AA's Special breakfast---</b></h2>
        <div class="marr col d-flex justify-content-center">
            <?php
            echo '<div class="card" style="width:300px;">';
            echo '<img class="card-img-top" src="Granola.jpg" alt="Card image" style="width:100%">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title"><b>Cafe\'s Granola</b></h4>';
            echo '<p class="card-text price">4$</p>';
            echo '</div>';
            echo '</div>';
            ?>
        </div>
        <br>
    </div>
</div>
<hr>
<div  id="dinner">
    <div >

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
                echo '<form method="POST" action="delete_item.php">';
                echo '<input type="hidden" name="item_id" value="' .  $item['id'] . '">';
                echo '<button class="btn btn-danger delete-btn" data-item-id="' . $item['id'] . '" data-category="Ddelete">Delete</button>';
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
        <h2 style="text-align: center;"><b> --- Resto Special Dinner---</b></h2>
        <div class="marr col d-flex justify-content-center">
            <?php
            echo '<div class="card" style="width:300px;">';
            echo '<img class="card-img-top" src="special.jpg" alt="Card image" style="width:100%">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title"><b>Special Dinner</b></h4>';
            echo '<p class="card-text price">4$</p>';
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