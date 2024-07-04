<?php
session_start();
include_once 'conn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagus register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="first">
        <center><h3>REGISTER</h3></center>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="Email"  name="email" placeholder="Email" required>
            <input type="password" name="pwd" placeholder="password" required><p><?php if(isset($_SESSION['error'])) echo $_SESSION['error']??NULL; unset($_SESSION['error']);?></p>
            <input type="password" name="cpwd" placeholder="confirm password" required>
            <p><?php echo $_SESSION['perror']??NULL; unset($_SESSION['perror']);?></p>
            <input type="date" placeholder="date" name="DOB">
            <center><input type="submit" name="submit" value="Submit" class="sub">
</center>
        </form>
        <p>Already have an account ?<a href="login.php" > Login</a></p>

    </div>
</body>
</html>