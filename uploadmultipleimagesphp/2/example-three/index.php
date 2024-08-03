<?php 
include("../admin/includes/controller.php");
$form = new Form;
?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Xavier - PHP Login Script & User Registration </title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/checkbox.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
    <?php if(!$session->logged_in){ ?>
        <div class="login-page">
            <div class="form">
                
                <!-- Login -->
                <form class="login-form" action="../admin/includes/process.php" method="POST">
                    <input type="text" name="username" placeholder="username" value="<?php echo Form::value("username"); ?>"/>
                    <?php if(Form::error("username")) { echo "<div class='help-block' id='user-error'>".Form::error('username')."</div>"; } ?>
                    <input type="password" name="password" placeholder="password" value="<?php echo Form::value("password"); ?>"/>
                    <?php if(Form::error("password")) { echo "<div class='help-block' id='pass-error'>".Form::error('password')."</div>"; } ?>
                    <label class="check_container">Remember Me <input type="checkbox" name="remember" id="remember_me" /><span class="checkmark"></span></label>
                    <input type="hidden" name="form_submission" value="login">
                    <button>login</button>
                    <p class="message login">Not registered? <a href="#">Create an account</a></p>
                    <p class="message resetpassword">Forgot Password? <a href="#">Reset Here</a></p>
                </form>
                
                <!-- Register -->
                <?php
                if ($configs->getConfig('ACCOUNT_ACTIVATION') == 4){
                    echo "<div><h1>Registration Disabled</h1>";
                    echo "<p>We're sorry but registration is currently disabled. Please try again at a later time.</p></div>";
                } else if(isset($_SESSION['regsuccess'])){
                    if ($_SESSION['regsuccess']==6){
                        echo "<div class='login'><h1>Registration is currently disabled!</h1>";
                        echo "<p>We're sorry <b>".$_SESSION['reguname']."</b> but registration to this site is currently disabled. "
                        ."Please try again at a later time or contact the website owner.</p></div>";
                        
                    /* Registration was successful */    
                    } else if($_SESSION['regsuccess']==0 || $_SESSION['regsuccess']==5) {
                        echo "<div class='login'><h1>Registered!</h1>";
                        echo "<p>Thank you <b>".$_SESSION['reguname']."</b> for your registration. You may now log in.</p></div>";
                        
                    /* User Activation */  
                    } else if($_SESSION['regsuccess']==3){
                        echo "<div class='login'><h1>Registered!</h1>";
                        echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your account has been created. "
                        ."However, this board requires account activation. An activation key has been sent to the e-mail address you provided. "
                        ."Please check your e-mail for further information.</p></div>";
                    }
                    
                    /* Admin Activation */  
                    else if($_SESSION['regsuccess']==4){
                        echo "<div class='login'><h1>Registered!</h1>";
                        echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your account has been created. "
                        ."However, this board requires account activation by an Admin. You will be informed by e-mail when your account has been activated.</p></div>";
                    
                    /* Registration failed */
                    } else if ($_SESSION['regsuccess']==2){
                        echo "<div class='login'><h1>Registration Failed</h1>";
                        echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
                        ."could not be completed.<br>Please try again at a later time.</p></div>";
                    }
                    unset($_SESSION['regsuccess']);
                    unset($_SESSION['reguname']);
                } else {
                ?>
                <form class="register-form" action="../admin/includes/process.php" method="POST">
                    <input type="text" name="user" placeholder="Username" value="<?php echo Form::value("user"); ?>"/>
                    <?php if(Form::error("user")) { echo "<div class='help-block' id='user-error'>".Form::error('user')."</div>"; } ?>
                    <input type="text" name="firstname" placeholder="First Name" value="<?php echo Form::value("firstname"); ?>"/>
                    <?php if(Form::error("firstname")) { echo "<div class='help-block' id='firstname-error'>".Form::error('firstname')."</div>"; } ?>
                    <input type="text" name="lastname" placeholder="Last Name" value="<?php echo Form::value("lastname"); ?>"/>
                    <?php if(Form::error("lastname")) { echo "<div class='help-block' id='lastname-error'>".Form::error('lastname')."</div>"; } ?>
                    <input type="password" name="pass" placeholder="Password" value="<?php echo Form::value("pass"); ?>"/>
                    <?php if(Form::error("pass")) { echo "<div class='help-block' id='pass-error'>".Form::error('pass')."</div>"; } ?>
                    <input type="password" name="conf_pass" placeholder="Confirm Password" value="<?php echo Form::value("conf_pass"); ?>"/>
                    <?php if(Form::error("conf_pass")) { echo "<div class='help-block' id='pass-error'>".Form::error('conf_pass')."</div>"; } ?>
                    <input type="email" name="email" placeholder="Email Address" value="<?php echo Form::value("email"); ?>"/>
                    <?php if(Form::error("email")) { echo "<div class='help-block' id='email-error'>".Form::error('email')."</div>"; } ?>
                    <input type="email" name="conf_email" placeholder="Confirm Email Address" value="<?php echo Form::value("conf_email"); ?>"/>
                    <?php if(Form::error("email")) { echo "<div class='help-block' id='email-error'>".Form::error('email')."</div>"; } ?>   
                    
                    <!-- The following div displays a hidden form field in an attempt at tricking automated bots. -->
                    <div style='display:none; visibility:hidden;'><input type='text' name='killbill' maxlength='50' /></div>
                    
                    <?php
                        if ($configs->getConfig('ENABLE_CAPTCHA')){
                            echo "<div class='g-recaptcha captchsize' data-sitekey='6Lf4nUkUAAAAABquLdc-ll9icBH7xzK4GFjUfiI1'></div>";
                            if(Form::error("recaptcha")) { echo "<div class='help-block' id='email-error'>".Form::error('recaptcha')."</div>"; } 
                        }
                    ?>
                    
                    <input type="hidden" name="form_submission" value="register">
                    <button>Register</button>
                    <p class="message register">Already registered? <a href="#">Sign In</a></p>
                </form>
                <?php } ?>
                
                <!-- Forgot Password -->
                <?php
                if(isset($_SESSION['sentpassemail'])){
                /* New password was generated for user and sent to user's email address. */
                    if($_SESSION['sentpassemail']){
                        echo "<h1>Password Link Sent</h1>";
                        echo "<p>Thanks! A link to change your password has been sent to your e-mail address.</p>";
                    /* Email could not be sent. */
                    } else{
                        echo "<h1>Password Link Not Sent!</h1>";
                        echo "<p>We could not send an email with your password reset link. Please contact Admin for more assistance or <a href='login.php'>try again</a>.</p>";
                    }
                    unset($_SESSION['sentpassemail']);
                } else {
                unset($_SESSION['sentpassemail']);
                ?>
                <form class="forgot-password" action="../admin/includes/process.php" method="POST">
                    <input type="text" name="user" placeholder="username" <?php if(Form::error("user")) { echo 'class="alert-field"'; } ?> value="<?php echo Form::value("user"); ?>" />
                     <?php if(Form::error("user")) { echo "<div class='help-block' id='user-error'>".Form::error('user')."</div>"; } ?>
                    <input type="email" name="email" placeholder="email" <?php if(Form::error("email")) { echo 'class="alert-field"'; } ?> value="<?php echo Form::value("email"); ?>" />
                    <?php if(Form::error("email")) { echo "<div class='help-block' id='user-error'>".Form::error('email')."</div>"; } ?>
                    <input type="hidden" name="form_submission" value="forgot_password">
                    <button>Reset Password</button>
                    <p class="message forgot">Remembered? <a href="#">Back to Login Form</a></p>
                </form>
                <?php } ?>
            </div>
        </div>
        
        <!-- Activation -->
        <div class="form" id="form-activate" style="display: none">
            <?php if ((isset($_GET['mode'])) && ($_GET['mode'] == 'activate')) { $session->activateUser($_GET['user'], $_GET['activatecode']); } ?>
        </div>  
        
        <!-- Logged In -->
        <?php } else { ?>
        <div class="loggedin-page">
            <div class="form">
                <h4>Congratulations! You are logged in.</h4>
                <?php if($session->isAdmin()){ echo '<p><a href="../admin/index.php">Admin Control Panel</a></p>'; } ?> 
                <p><a href="user-profile.php" id="link-user-profile">User Profile</a></p>
                <p><a href="../admin/logout.php?path=referrer">Logout</a></p>
                <p>Member Total: <?php echo $session->getNumMembers();?></p>
                <p>There are <?php echo $functions->calcNumActiveUsers(); ?> registered members and <?php echo $session->calcNumActiveGuests(); ?> guests viewing the site.</p>
                <p>Users Online : <?php echo $functions->activeUserList(0); ?></p>
                <p>Most User's Online: <?php echo $configs->getConfig('record_online_users'); ?> on <?php echo date('M j, Y, g:i a', $configs->getConfig('record_online_date')); ?> </p>
            </div>
        </div>
        <?php } ?>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
