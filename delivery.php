
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css.map">
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
        .invoice-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            margin-bottom: 15px;
        }

        .total-price {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="invoice-container">
        <h2>AA Cafe Invoice</h2>

        <?php
        session_start();
        require_once("db_connect.php");
        $userId = $_SESSION['id'];
        $sql = "SELECT * FROM shopping_cart WHERE user_id = '$userId'";
        $result = $conn->query($sql);
        $sum = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='cart-item'  data-item-id='" . $row['id'] . "'>";
                echo "<p><b>Item:</b> " . $row['item_name'] . "<br>";
                echo "<b>Price:</b> $" . $row['item_price'] . "<br></p>";
                echo "<button class='btn btn-danger delete-btn'>Delete</button>";
                echo "</div>";
                $sum += $row['item_price'];
            }

            echo "<div class='total-price'><p><b>Total Price:</b> $" . $sum . "</p></div>";
        } else {
            echo "<p>Your shopping cart is empty.</p>";
        }
        echo '<form method="POST">';
        echo '<button type="submit" name="back" class="btn btn-secondary">Back</button>';
        echo '</form>';
        if (isset($_POST['back'])) {
           header("Location: menu.php");
        }
        $conn->close();
        ?>

    </div>
    <script>
$(document).ready(function () {
    $(".delete-btn").on("click", function () {
        var cartItemId = $(this).closest(".cart-item").data("item-id");

        $.ajax({
            type: "POST",
            url: "delete_item.php", 
            data: { cartItemId: cartItemId },
            success: function (response) {
                window.location.href = "delivery.php" ;
            },
            error: function () {
                alert("Error occurred while deleting item.");
            }
        });
    });
});
</script>

</body>

</html>