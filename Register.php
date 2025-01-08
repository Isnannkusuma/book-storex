<?php
    require "connect.php";

    if (isset($_POST['registerbtn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $error = "Password dan konfirmasi password tidak cocok!";
        } else {
            $queryCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
            if (mysqli_num_rows($queryCheck) > 0) {
                $error = "Username sudah ada!";
            } else {
                $queryInsert = mysqli_query($con, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
                if ($queryInsert) {
                    $success = "Akun berhasil dibuat. Silakan login.";
                    header("Location: loginN.php");
                    exit();
                } else {
                    $error = "Terjadi kesalahan saat membuat akun: " . mysqli_error($con);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <form action="" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>
            <div>
                <button class="btn btn-primary form-control mt-3" type="submit" name="registerbtn">Register</button>
            </div>
        </form>
        <?php 
            if (isset($error)) {
                ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $error; ?>
                </div>
                <?php
            }
            if (isset($success)) {
                ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $success; ?>
                </div>
                <?php
            }
        ?>
        <p class="mt-2">Sudah punya akun? <a href="loginN.php">Login di sini</a></p>
    </div>
</body>
</html>