<?php include("../admin/includes/controller.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $configs->getConfig('SITE_NAME'); ?> - Forgot Password</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <div class="login">

<?php
/* Forgot Password form has been submitted and no errors were found */
if(isset($_SESSION['forgotpass'])){
    /* New password was generated for user and sent to user's email address. */
    if($_SESSION['forgotpass']){
        echo "<h1>New Password Generated</h1>";
        echo "<p>Your new password has been generated and sent to the email associated with your account.</p>"
            ."<p><a href='index.php'>Go Back</a>.</p>";
    }
    /* Email could not be sent, therefore password was not edited in the database. */
    else{
        echo "<h1>New Password Failure</h1>";
        echo "<p>There was an error sending you the email with the new password, so your password has not been changed.</p>"
            ."<p><a href='index.php'>Go Back</a></p>";
    }
       
   unset($_SESSION['forgotpass']);
}
else{
$form = new Form;
/* Forgot password form is displayed, if error found, it is displayed. */
?>

    <h1>Forgot Password</h1>
    <form action="../admin/includes/process.php" method="POST">
        <p>Please fill out the form below. You'll need your username and the e-mail address you used to register (unless you have since changed it).</p>
        <?php echo Form::error("user"); ?>
        <p><input type="text" name="user" placeholder="Username" value="<?php echo Form::value("user"); ?>"></p>
        <p><input type="text" name="email" placeholder="E-mail" value="<?php echo Form::value("email"); ?>"></p>
        <p class="submit"><input type="submit" value="Get New Password"></p>
        <input type="hidden" name="form_submission" value="forgot_password">
    </form>

<?php
}
?>
</div>
    
<div class="form-help">
    <p>Not registered? <a href="register.php">Sign-Up!</a> - Ready to Login? <a href="<?php echo $configs->homePage(); ?>">Back to Home Page</a>.</p>
</div>
</body>
</html>