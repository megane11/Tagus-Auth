<?php
    session_start();
    $error = "";
    include_once 'conn.php';

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $pass = $_POST['pwd'];
        $cpass = $_POST['cpwd'];
        $dob = $_POST['DOB'];

        if(empty($pass)){
            $error = "Password is required";
            $_SESSION['error'] = $error;
            // header('location:create.php');
        }

        if($cpass!=$pass){
           $_SESSION['perror'] = "Password does not match";
           header("location:index.php");
            die;
        }

        // if(isset($_FILES['img'])){
        //     $image = $_FILES['img']['name'];
        //     move_uploaded_file($_FILES['img']['tmp_name'], "./assets/uploads/".$_FILES['img']['name']);
        // }

        $hash = password_hash($pass,PASSWORD_DEFAULT);

        $sql = "insert into users(Name, Email, Password, dob) values('$fname','$email','$hash','$dob');";
        $result = mysqli_query($conn, $sql);
        if(!$result){
            die("connection failed");
        }else{
            header("location:login.php");
            die;
        }
    
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>yo</h1>
</body>
</html>