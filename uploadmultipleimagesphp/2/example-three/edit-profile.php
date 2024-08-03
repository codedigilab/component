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
    <?php if($session->logged_in){ ?>
            <div class="login-page"><div class="form" id="form-edituser">
                <h2>Edit Account</h2>
                <form action="../admin/includes/process.php" method="POST">
                    <input type="password" name="curpass" placeholder="Current Password" value="<?php echo Form::value("curpass"); ?>">
                    <?php if(Form::error("curpass")) { echo "<div class='help-block' id='pass-error'>".Form::error('curpass')."</div>"; } ?>
                    <input type="password" name="newpass" placeholder="New Password" value="<?php echo Form::value("newpass"); ?>">
                    <?php if(Form::error("newpass")) { echo "<div class='help-block' id='pass-error'>".Form::error('newpass')."</div>"; } ?>
                    <input type="password" name="conf_newpass" placeholder="Confirm New Password" value="<?php echo Form::value("conf_newpass"); ?>">
                    <?php if(Form::error("conf_newpass")) { echo "<div class='help-block' id='pass-error'>".Form::error('conf_newpass')."</div>"; } ?>
                    <input type="text" name="email" placeholder="New E-mail Address" value="<?php 
                    if (Form::value("email") == "") {
                        echo $session->userinfo['email'];
                    } else {
                        echo Form::value("email");
                    }
                    ?>">
                    <?php if(Form::error("email")) { echo "<div class='help-block' id='email-error'>".Form::error('email')."</div>"; } ?>

                    <input type="hidden" name="form_submission" value="edit_account">
                    <button>Edit Account</button>
                </form>
                </div>
            </div>
    <?php } ?>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
