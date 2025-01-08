<?php 
    session_start();
    require "connect.php"; // Ensure this file sets up the $con variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<style>
   body {
    background-image: url('buku2.jpg');
   }
    .main {
        height: 100vh;
    }
    .login-box {
        background-color: transparent;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(167, 165, 165, 0.5);
        width: 50vw;
        height: 60vh;
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }
    .login-form {
        width: 100%;
        max-width: 300px;
        text-align: left;
        margin-top: 140px;
    }
    .login-image {
        max-width: 45%; /* Adjust the width as needed */
        height: auto;
        margin-left: 430px; /* Space between the image and the form */
        margin-top: -330px; /* Adjust the margin as needed */
    }
    .www-image {
        max-width: 30%; /* Adjust the width as needed */
        height: auto;
        margin-left: 30px; /* Space between the image and the form */
        margin-top: -620px; /* Adjust the margin as needed */
    }
    .login-form label {
        color: white; /* Change label color to white */
    }
    .signup-text {
        color: white;
    }
    .signup-text a {
        color: rgb(198, 135, 0);
        text-decoration: none;
    }
    .btn-success {
        background-color:rgb(194, 134, 4);
        border-color:rgb(255, 255, 255);
    }
    .btn-success:hover {
        background-color:rgb(99, 68, 0);
        border-color:rgb(255, 255, 255);
    }
</style>

<body>
    <div class="main">
        <div class="main d-flex flex-column justify-content-center align-items-center">
            <div class="login-box p-5 shadow">
                <form action="" method="post" class="login-form">
                    <div>
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div>
                        <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                    </div>
                   
                </form>
                
                <p class="mt-2 signup-text">Belum Punya Akun? <a href="Register.php">sign up Here!</a></p>
                
                <img src="LOGO.png" alt="Login Image" class="login-image">
                <img src="www2.png" alt="Login www" class="www-image">
            </div>
    </div>
    <div class="mt-6 d-flex flex-column justify-content-center align-items-center">
        <?php
        if (isset($_POST['loginbtn'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($con) {
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION['username'] = $username;
                $_SESSION['login'] = true;
                header("Location: index.php");
            } else {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Login Gagal!
                    </div>
                <?php
            }
        } else {
            echo "Database connection failed.";
        }
        }
        ?>
    </div>

    
</body>
</html>