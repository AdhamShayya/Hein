<?php
session_start();
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = $password = "";
    $emailErr = $passErr = "";

    if (isset($_POST['email'])) {
        $email = validateInput($_POST['email']);
        if (empty($email)) {
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (isset($_POST['password'])) {
        $password = validateInput($_POST['password']); 
        if (empty($password)) {
            $passErr = "Password is required";
        }else if($password < 6){
            $passErr = "Password is too Short";
        }
    }
    if (isset($_POST['signinBtn']) && $passErr == "" && $emailErr == "") {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Authentication successful
        $row = mysqli_fetch_assoc($result);

            $_SESSION['user'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            if ($_SESSION['id'] == 1) {
                header("Location: menu2.php");
                exit;
            }
            else{
            header("Location: index.php");
            }
        } else {
            echo "<div class='alert alert-danger'>Error Invalid Credentials: " . $conn->error . "</div>";
        }
    }elseif(isset($_POST['signupBtn'])){
        header("Location: signup.php");
    }else{
        
        echo json_encode(["error" => "Fill all cred"]);
    }
}

$conn->close();
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
    <h1>Welcome to AA Cafe</h1>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Login</h1>
            <form method="post">
                <div class="input-group">

                    <div class="input-field">
                        <input type="text" name="email" id="email" placeholder="Email" >
                    </div>

                    <div class="input-field">
                        <input type="password" name="password" id="password" placeholder="Password" >
                    </div>
                    <p>Forgotten Password: <a href="#">Click Here!</a></p>
                </div>
                
                <div class="btn-field"> 
                    <button type="submit" name="signinBtn"value="signinBtn">Login</button>
                    <button type="submit" name="signupBtn" value="signupBtn">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>