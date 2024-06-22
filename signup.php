<?php
session_start();
require_once('db_connect.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['menu'])) {
    header("Location: index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signupBtn'])) {

    function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = $email = $password = $phoneNb = $address = "";
    $nameErr = $emailErr = $passErr = $phoneNbErr = $addressErr = "";

    if (isset($_POST['email'])) {
        $email = validateInput($_POST['email']);
        if (empty($email)) {
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($checkEmailQuery);

            if ($result->num_rows > 0) {
                $emailErr = "Email already exists";
            }
        }
    }

    if (isset($_POST['password'])) {
        $password = validateInput($_POST['password']);
        if (empty($password)) {
            $passErr = "Password is required";
        } elseif (strlen($password) < 6) {
            $passErr = "Password is too short";
        }
    }

    if (isset($_POST['name'])) {
        $name = validateInput($_POST['name']);
        if (empty($name)) {
            $nameErr = "Name is required";
        }
    }

    if (isset($_POST['phoneNb'])) {
        $phoneNb = validateInput($_POST['phoneNb']);
        if (empty($phoneNb)) {
            $phoneNbErr = "Phone Number is required";
        }
    }

    if (isset($_POST['address'])) {
        $address = validateInput($_POST['address']);
        if (empty($address)) {
            $addressErr = "Address is required";
        }
    }

    

    if ($passErr == "" && $emailErr == "" && $nameErr == "" && $phoneNbErr == "" && $addressErr == "") {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, phoneNb, address) 
                VALUES ('$name', '$email', '$hashedPassword', '$phoneNb' , '$address')";
        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['user'] = $name;
            $_SESSION['id'] = $conn->insert_id;
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }  else {
        if ($passErr != "") {
            echo "<div>" . $passErr . "</div>";
        }
        if ($emailErr != "") {
            echo "<div>" . $emailErr . "</div>";
        }
        if ($nameErr != "") {
            echo "<div>" . $nameErr . "</div>";
        }
        if ($phoneNbErr != "") {
            echo "<div>" . $phoneNbErr . "</div>";
        }
        if ($addressErr != "") {
            echo "<div>" . $addressErr . "</div>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles.css">
  
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form method="post">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <input type="text" name="name" id="name" placeholder="Name" >
                    </div>

                    <div class="input-field">
                        <input type="text" name="email" id="email" placeholder="Email" >
                    </div>

                    <div class="input-field">
                        <input type="password" name="password" id="password" placeholder="Password" >
                    </div>
                    <div class="input-field">
                        <input type="tel" name="phoneNb" id="phoneNb" placeholder="Phone Number" >
                    </div>
                    <div class="input-field">
                        <input type="text" name="address" id="address" placeholder="Address" >
                    </div>
                </div>
                
                <div class="btn-field"> 
                    <button type="submit" name="signupBtn"  value="signupBtn">Sign Up</button>
                    <button type="submit" name="menu" value="menu">Back</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>