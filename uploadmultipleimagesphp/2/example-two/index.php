<?php
include("../admin/includes/controller.php");
/*
 * This is an example of the index page of a website. Here users will be able to login. 
 * However, like on most sites the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether the user has logged in or not.
*/
?>
<html>
<head>
    <title>Xavier - PHP Login Script & User Registration </title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<?php

/* Activation Query String was included in URL - try to activate */
if ((isset($_GET['mode'])) && ($_GET['mode'] == 'activate')) { 
    
    echo "<div class='login'>";
    $session->activateUser($_GET['user'], $_GET['activatecode']); 
    echo "</div>";

/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
} else if($session->logged_in) {
?>
<div class='login'>
<h1>Logged In</h1>
    <p>Welcome <strong><?php echo $session->username; ?></strong>, you are logged in.</p>
    <p>[<a href="userinfo.php?user=<?php echo $session->username; ?>">Profile</a>]
<?php
    if($session->isAdmin()){
        echo "[<a href=\"../admin/index.php\">Admin Control Panel</a>] ";
    }
?>   
    [<a href="../admin/logout.php?path=referrer">Logout</a>]
    </p>
        <?php
        echo "<p>Member Total: " . $session->getNumMembers() . "</p>";
        echo "<p>There are " . $functions->calcNumActiveUsers() . " registered members and " . $session->calcNumActiveGuests() . " guests viewing the site.</p>";

        echo "<p>User's Online:";
        echo $functions->activeUserList(1);
        echo "<p>Most User's Online: " . $configs->getConfig('record_online_users') . " on " . date('M j, Y, g:i a', $configs->getConfig('record_online_date')) . "</p>";
        ?>
</div>
<?php
} else {
$form = new Form;
/**
 * User not logged in, display the login form. If the user has already tried to login, 
 * but errors were found, they will be displayed.
 */
?>

<div class="login">
    <h1>Login</h1>
    <form action="../admin/includes/process.php?path=referrer" method="POST">
        <p>
            <input type="text" name="username" placeholder="Username" value="<?php echo Form::value("username"); ?>">
        </p>
        <?php echo Form::error("username"); ?>
        <p>
            <input type="password" name="password" placeholder="Password" value="<?php echo Form::value("password"); ?>">
        </p>
        <?php echo Form::error("password"); ?>
        <p class="remember_me">
            <input type="checkbox" name="remember" id="remember_me" <?php if(Form::value("remember") != ""){ echo "checked"; } ?>>
            Remember me on this computer
        </p>
        <p class="submit">
            <input type="submit" name="commit" value="Login">
        </p>
        <input type="hidden" name="form_submission" value="login">
    </form>  
</div>

<div class="form-help">
    <p>Not registered? <a href="register.php">Sign-Up!</a> - Forgot your password? <a href="forgotpass.php">Click here to reset it</a></p>
</div>
        
<?php
}
?>

</body>
</html>