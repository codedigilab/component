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
    </head>
    <body>
    <?php if($session->logged_in){ ?>
        <div class="login-page">
            <div class="form" id="form-userprofile">
                <h2>User Profile</h2>
                <?php
                /* get requested user information from database - add/delete as applicable */
                $user_info = $functions->getUserInfo($session->username);

                /* Display the user's info */
                echo "<p><strong>Username: </strong>".$user_info['username']."</p>";
                echo "<p><strong>First Name: </strong>".$user_info['firstname']."</p>";
                echo "<p><strong>Last Name: </strong>".$user_info['lastname']."</p>";
                echo "<p><strong>Email: </strong> ".$user_info['email']."</p>";
                ?>
                <a href="edit-profile.php" id="link-edit-user">Edit Account</a>
            </div>  
        </div>
    <?php } ?>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>
