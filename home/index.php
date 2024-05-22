<?php
include 'config.php';

if (isset($_POST['submit'])) {

    $user = $_POST['user'];
    $pass = $_POST['password'];

    $fire = mysqli_query($conn, "SELECT `id` FROM `admin` WHERE `user`='$user' && `password`='$pass'");

    if (mysqli_num_rows($fire) > 0) {
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $pass;
        header("Location:controller.php");
        exit();
    } else {
?>
        <script>
            alert('email address and password wrong!');
        </script>
<?php
    }
}


if (isset($_SESSION["user"]) && isset($_SESSION['password'])) {

    $u = $_SESSION['user'];
    $p = $_SESSION['password'];

    $fire = mysqli_query($conn, "SELECT `id` FROM `admin` WHERE `user`='$u' && `password`='$p'");

    if (mysqli_num_rows($fire) > 0) {
        header("Location:controller.php");
        exit();
    } else {
        session_unset();
        session_destroy();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="logo.png" /> <!-- Add your OG image URL here -->
    <link rel="shortcut icon" type="image/png" href="logo.png"/> <!-- Add your favicon image URL here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Yarana Smart Home Login</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins');

    /* BASIC */

    html {
        background-color: #56baed;
    }

    body {
        font-family: "Poppins", sans-serif;
        height: 100vh;
    }

    /* STRUCTURE */

    .wrapper {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        min-height: 100%;
        padding: 20px;
        margin-bottom: 50px;
    }

    #formContent {
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 10px 10px 10px 10px;
        background: #fff;
        padding: 30px;
        width: 90%;
        max-width: 450px;
        position: relative;
        padding: 0px;
        box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3);
        text-align: center;
    }

    #formFooter {
        background-color: #f6f6f6;
        border-top: 1px solid #dce8f1;
        padding: 25px;
        text-align: center;
        border-radius: 0 0 10px 10px;
    }



    /* FORM TYPOGRAPHY*/

    input[type=button],
    input[type=submit],
    input[type=reset] {
        background-color: #56baed;
        border: none;
        color: white;
        padding: 15px 80px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        text-transform: uppercase;
        font-size: 13px;
        box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
        border-radius: 5px 5px 5px 5px;
        margin: 5px 20px 40px 20px;
        transition: all 0.3s ease-in-out;
    }

    input[type=submit] {
        margin-top: 20px;
        cursor: pointer;
    }

    input[type=button]:hover,
    input[type=submit]:hover,
    input[type=reset]:hover {
        background-color: #39ace7;
    }

    input[type=button]:active,
    input[type=submit]:active,
    input[type=reset]:active {
        transform: scale(0.95);
    }

    input[type=text] {
        background-color: #f6f6f6;
        border: none;
        color: #0d0d0d;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 5px;
        width: 85%;
        border: 2px solid #f6f6f6;
        transition: all 0.5s ease-in-out;
        border-radius: 5px 5px 5px 5px;
    }

    input[type=text]:focus {
        background-color: #fff;
        border-bottom: 2px solid #5fbae9;
    }

    input[type=text]:placeholder {
        color: #cccccc;
    }

    .underlineHover:after {
        display: block;
        left: 0;
        bottom: -10px;
        width: 0;
        height: 2px;
        background-color: #56baed;
        content: "";
        transition: width 0.2s;
    }

    .underlineHover:hover {
        color: #0d0d0d;
    }

    .underlineHover:hover:after {
        width: 100%;
    }



    /* OTHERS */

    *:focus {
        outline: none;
    }

    #icon {
        height: 100px;
        width: 100px;
        border-radius: 50%;
        margin: 20px 0px;
    }

    * {
        box-sizing: border-box;
    }
</style>

<body>
    <!-- content -->

    <div class="row m-3">


        <div class="wrapper fadeInDown">
            <div id="formContent">

                <!-- Icon -->
                <div class="fadeIn first">
                    <img src="logo.png" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form action="" method="POST">
                    <input type="text" id="user" class="fadeIn second" name="user" placeholder="Username">
                    <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
                    <input type="submit" class="fadeIn fourth" value="Log In" name="submit">
                </form>

        <div class="youtube-subscriber" style="margin-top: 100px;">
    <div  class="g-ytsubscribe" data-channelid="UColOAMvdtSuwGFHAIF3cnnQ" data-layout="full" data-theme="dark" data-count="default"></div>
 <script src="https://apis.google.com/js/platform.js"></script>
            </div>
        </div>
        


        <?php include_once('footer.php'); ?>
</body>

</html>