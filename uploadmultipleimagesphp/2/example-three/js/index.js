// Reveal Register Form
$('.login a').click(function(){
    $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //hide login
    $('.register-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //reveal register
});

// Reveal Forget Password Form
$('.resetpassword a').click(function(){
   $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //hide login
   $('.forgot-password').animate({height: "toggle", opacity: "toggle"}, "slow"); //reveal forget password
});

// Reveal Login Form
$('.register a').click(function(){
   $('.register-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //hide register form
   $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //reveal login
});

$('.forgot a').click(function(){
   $('.forgot-password').animate({height: "toggle", opacity: "toggle"}, "slow"); //hide register form
   $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //reveal login
});

if (window.location.hash === '#reset') {
   $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //hide login
   $('.forgot-password').animate({height: "toggle", opacity: "toggle"}, "slow"); //reveal forget password
}

if (window.location.hash === '#register') {
    $('.login-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //hide login
    $('.register-form').animate({height: "toggle", opacity: "toggle"}, "slow"); //reveal register
}