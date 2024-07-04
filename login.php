<?php
session_start();
    include_once 'conn.php';
    $error= '';

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $pass = $_POST['pwd'];
        $select = "select * from users where email='$email';";
        $result = mysqli_query($conn, $select);
        $order= mysqli_fetch_assoc($result);

        // var_dump($pass . $order['password']);
        // var_dump(password_verify($pass ,$order['password']));
        if(!password_verify($pass ,$order['Password'])){
            $error=" wrong password";
        }
        else{
            $_SESSION['user']=$order;
            echo 'redirect';
            header("location:dashboard.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagus login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    require_once 'vendor/autoload.php';
    require_once 'controller.Class.php';

    // init configuration
    $clientID = '259745037641-hvethjvleo33o0o7ueo0omt9ud90385l.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/Authent/login.php';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");
    $login_url = $client->createAuthUrl();

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    //insert data
    $Controller = new Controller;
    echo $Controller -> insertData(array(
        'email' => $google_account_info['email'],
        'avatar' => $google_account_info['picture'],
        'familyName' => $google_account_info['familyName'],
        'givenName' => $google_account_info['givenName'],

    ));

?>
            <!-- <div class="third">
            <?php /*echo $picture;*/ ?>
                <label for="email">Emailid:</label><input type="email" placeholder=" <?php /*echo $email;*/ ?>">
                <label for="name">Name:</label><input type="text" placeholder="<?php /*echo $name;*/ ?>">
            </div>
            <a class="dash" href="dashboard.php">Go to dashboard</a> -->
            <?php echo "<pre>";
            //  var_dump($token);
             var_dump($google_account_info); echo "</pre>" ?>

<?php    } else {
    
?>

<div class="second">
        <center><h3>SIGN IN</h3></center>
        <form action="" method="POST">
            <input type="Email"  name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="password">
            <p class="err"><?php echo $error??NULL; ?></p>

            <center><input type="submit" name="login" value="login" class="sub">
            </center>
        </form>
        <p> Don't have an account? <a href="index.php">Sign Up</a></p>
        <center><h5>-------Or sign in using-------</h5></center>

        <a href="<?php echo $login_url ?>"><img src="images/google1.png" alt=""></a>

        <a href="https://www.facebook.com/"><img src="images/facebook1.png" alt=""></a> 

        <a href="https://www.github.com/login"><img src="images/github1.png" alt=""></a>

    </div>
    <?php
    }
    ?>
</body>
</html>