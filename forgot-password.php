<?php
// Include config file
require_once "config.php";
session_start();
$email = "";
$email_err = "";
$message = "";
$valid = 'true';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // // Validate firstname
    // if(empty(trim($_POST["email"]))){
    //     $email_err = "Vui lòng nhập email của bạn.";     
    // } else{
    //     $email = trim($_POST["email"]);
    // }

    $email_reg=mysqli_real_escape_string($link,$_POST['email']);
    $details=mysqli_query($link,"SELECT firstname,email FROM users WHERE email='$email_reg'");
    if (mysqli_num_rows($details)>0) { //if the given email is in database, ie. registered
        $message_success=" Please check your email inbox or spam folder and follow the steps";
        //generating the random key
        $key=md5(time()+123456789% rand(4000, 55000000));
        //insert this temporary key into database
        $sql_insert=mysqli_query($link,"INSERT INTO forget_password(email,temp_key) VALUES('$email_reg','$key')");
        //sending email about update
        $to      = $email_reg;
        $subject = 'Changing password DEMO- psuresh.com.np';
        $msg = "Please copy the link and paste in your browser address bar". "\r\n"."www.psuresh.com.np/misc/forgot-password.php/forgot_password_reset.php?key=".$key."&email=".$email_reg;
        $headers = 'From:Gentle Heart Foundation' . "\r\n";
        mail($to, $subject, $msg, $headers);
    }
    else{
        $message="Sorry! no account associated with this email";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                            <input type="text" style="margin-bottom:15px;" class="form-control form-control-user" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                            <?php if (isset($error)) {
                                                    echo"<div class='alert alert-danger' role='alert'>
                                                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                                    <span class='sr-only'>Error:</span>".$error."</div>";
                                            } ?>
                                            <?php if ($message<>"") {
                                                    echo"<div class='alert alert-danger' role='alert'>
                                                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                                    <span class='sr-only'>Error:</span>".$message."</div>";
                                                } ?>
                                            <?php if (isset($message_success)) {
                                                    echo"<div class='alert alert-success' role='alert'>
                                                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                                                    <span class='sr-only'>Error:</span>".$message_success."</div>";
                                                } ?>
                                            <!-- <span class="help-block">< echo $email_err; ?></span> -->
                                            <input type="submit" style="margin-top:15px" class="btn btn-primary btn-user btn-block"
                                                name="submit">
                                        </div>
                                        <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>