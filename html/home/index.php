<?php
require("../control/datavalidation.php");
require("../var/contact-us.php");
require("../var/var.php");

$isMessage = false;
if (isset($_GET['error'])) {
    $isMessage = true;

    $data_validation_token = "aj2M31ds@JKbf&873";
    $DataValidation = new DataValidation($data_validation_token);
    $message = $DataValidation->sanitize($_GET['error']);
}
// if(isset($_COOKIE['token'])) {
//     if(isset($_COOKIE['user_id'])){
//         if(isset($_COOKIE['user_phone'])){
//             header("location: ../");
//         }
//     }
// }
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta name="generator" content="Crush Pay 1.0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crush Pay | Prepaid & DTH Recharge</title>
    <meta name="description" content="Best prepaid and dth recharge app">
    <meta name="keywords" content="recharge app, cashback recharge, crush pay, margin recharge">
    <meta name="robots" content="all,follow">
    <meta property="og:image" content="../images/icon_logo.svg" />
    <meta name="theme-color" content="#0e406a">
    <meta name="msapplication-TileColor" content="#0e406a">
    <link rel="icon" href="../images/icon_logo.svg" type="image/svg">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google font -->
    <link href="http://fonts.cdnfonts.com/css/arial-rounded-mt-bold" rel="stylesheet">
    <!-- Font Awsome -->
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.default copy.css">
    <link rel="stylesheet" href="../css/mock-up.css">



    <!-- MyStyle--------------------------START -->
    <link rel="stylesheet" href="../css/vendor/main.css">
    <link rel="stylesheet" href="../css/vendor/navbar.css">
    <link rel="stylesheet" href="../css/vendor/loginpopup.css">
    <!-- MyStyle--------------------------END -->
</head>

<body>

    <div id="preloader">

    </div>



    <section class="navfixed-top">
        <nav class=" navbar container navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../images/banner_logo.svg" width="150px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav-list navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item footer-a">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#services_container">Services</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#">Terms & condition</a>
                        </li>
                        <li class="nav-item dropdown footer-a">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Policies
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Privacy policy</a></li>
                                <li><a class="dropdown-item" href="#">Refund policy</a></li>
                                <li><a class="dropdown-item" href="#">Cookie policy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#">About us</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#">Contact us</a>
                        </li>
                        <hr>
                        <li class="nav-item nav_login_btn footer-a" onclick="toggleLoginPopup()">
                            <a class="nav-link" href="#">Login/Signup <i class="fa fa-sign-in" aria-hidden="true"></i></a>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <section id="loginpopup" class="loginpopup toggleshow">
        <div class="popupbody">
            <span onclick="toggleLoginPopup()"><i class="fa fa-times" aria-hidden="true"></i></span>
            <img class="pop_head_comm d-block m-auto mb-4" src="../images/banner_logo.svg" width="150px" alt="">
            <h4 id="pop_title" class="pop_head_comm">Login</h4>

            <!-- Login Popup---------------START -->
            <div id="login-pop" class="replace_popup">
                <form action="">
                    <div class="input_my_style">
                        <input id="login_EP" type="tel" placeholder=" " required>
                        <label for="">Enter email or phone</label>
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input id="login_Pass" type="password" placeholder=" " required>
                        <label for="">Enter password</label>
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="password_eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                    <button id="btn_loginSubmit" class="btn_myStyle w-100">Submit</button>
                </form>
                <div class="loginactivity d-flex justify-content-end align-items-center mt-4">
                    <h6>Forgot password?</h6>
                    <button onclick="resetPopToggle()" class="btn_myStyle">Reset</button>
                </div>
                <div class="loginactivity d-flex justify-content-end align-items-center mt-3">
                    <h6>Do not have an account?</h6>
                    <button class="btn_myStyle" onclick="signUpPopToggle()">Sign Up</button>
                </div>
            </div>
            <!-- Login Popup---------------END -->


            <!-- Sign Up Popup---------------START -->
            <div id="signup-pop" class="replace_popup hide">
                <form action="">
                    <div class="input_my_style">
                        <input id="inpt_name_sgn" type="text" placeholder=" ">
                        <label for="">Enter your name *</label>
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input id="inpt_tel_sgn" type="tel" placeholder=" ">
                        <label for="">Enter mobile number *</label>
                        <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input id="inpt_email_sgn" type="email" placeholder=" ">
                        <label for="">Enter email</label>
                        <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input id="inpt_pass1_sgn" type="password" placeholder=" ">
                        <label for="">Enter password *</label>
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="password_eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input id="inpt_pass2_sgn" type="password" placeholder=" ">
                        <label for="">Re enter password *</label>
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="password_eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                    <button id="btn_signup" class="btn_myStyle w-100">Submit</button>
                </form>
                <div class="loginactivity d-flex justify-content-end align-items-center mt-4">
                    <h6>Already have an account?</h6>
                    <button class="btn_myStyle" onclick="loginPopToggle()">Login</button>
                </div>
            </div>
            <!-- Sign Up Popup---------------END -->


            <!-- Reset Pass---------------START -->
            <div id="reset-pop" class="replace_popup hide">
                <form action="">
                    <div class="input_my_style">
                        <input type="tel" placeholder=" ">
                        <label for="">Enter email or phone</label>
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <button id="btn_reset_submit" class="btn_myStyle w-100">Submit</button>
                </form>
                <div class="loginactivity d-flex justify-content-end align-items-center mt-4">
                    <h6>Remember password?</h6>
                    <button onclick="loginPopToggle()" class="btn_myStyle">Login</button>
                </div>
            </div>
            <!-- Reset Pass---------------END -->



            <!-- OTP Verify---------------START -->
            <div id="otp-verify-pop" class="replace_popup hide otp-verify-div">
                <img class="d-block m-auto mb-4" src="../images/icons/ic_phone_varify.png" width="80px" alt="">
                <h5>Phone Number Verify</h5>
                <p id="otp_to_phone"></p>
                <div>
                    <input class="otp_input" type="tel" maxlength="1">
                    <input class="otp_input" type="tel" maxlength="1">
                    <input class="otp_input" type="tel" maxlength="1">
                    <input class="otp_input" type="tel" maxlength="1">
                    <input class="otp_input" type="tel" maxlength="1">
                    <input class="otp_input" type="tel" maxlength="1">
                </div>
                <button class="btn_myStyle w-100">Submit</button>
                <div class="loginactivity d-flex justify-content-end mt-4">
                    <h6 class="mt-2">Don't recieve the otp?</h6>
                    <div>
                        <button id="btn_otp_resend" class="btn_myStyle" disabled>Resend</button>
                        <p class="text-center my_text"><small id="otp_timer_txt">3:00</small></p>
                    </div>
                </div>
            </div>
            <!-- OTP Verify---------------END -->



        </div>
    </section>

    <section class="mainbody">

        <div class="container row py-lg-5 m-auto">
            <div class="col-lg-6 py-5">
                <h1 class="font-weight-bold">Download Crush Pay app from play store</h1>
                <p class="my-4 my_text">Crushpay is an indian multi bill payment softwere. You can do any recharge from
                    here and get cashback for each and every recharge.</p>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mb-2 mb-lg-0"><a class="btn_myStyle btn btn-primary btn-lg px-4" href="https://play.google.com/store/apps/details?id=com.crushpay.android"><img src="../images/icons/i_google_play.svg" alt="" width="40px"> Google Play</a></li>
                    <li id="btn_web_login" class="list-inline-item mb-2 mb-lg-0" onclick=""><a class="btn_myStyle btn btn-primary btn-lg px-4" href="#!"> <img src="../images/icons/i_chrome.svg" alt="" width="40px">Web Login</a></li>

                </ul>
            </div>
            <div class="col-lg-6 ml-auto">
                <div class="temp-wrapper">
                    <div class="px">
                        <div class="px__body">
                            <div class="px__body__cut"></div>
                            <div class="px__body__speaker"></div>
                            <div class="px__body__sensor"></div>

                            <div class="px__body__mute"></div>
                            <div class="px__body__up"></div>
                            <div class="px__body__down"></div>
                            <div class="px__body__right"></div>
                        </div>

                        <div class="px__screen">
                            <div class="px__screen__">
                                <div class="px__screen__frame" style="background-image: url('../images/screenshot_app.jpg')">
                                    <!-- <i class="fa fa-apple"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="services_container" class="pb-5">
        <div class="container pb-5">
            <header>
                <h2 class="h3 mb-5">Services</h2>
                <!-- <p class="text-muted text-sm mb-5">Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p> -->
            </header>
            <div class="row text-center align-items-stretch gy-4">
                <div class="col-lg-4">
                    <div class="card border-0 shadow h-100 hover-transition">
                        <div class="card-body p-4 p-lg-5">
                            <div class="essential-tool-img mb-4 mx-auto"> <svg class="svg-icon svg-icon-light" style="width:60px;height:60px;color:#ff00dd">
                                    <use xlink:href="#smartphone-1"> </use>
                                </svg></div>
                            <h3 class="h5"> <a class="stretched-link reset-anchor" href="#">Prepaid Recharge</a></h3>
                            <p class="service_desc text-sm  mb-0">You can do any mobile recharge and get cashback for
                                every recharge.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow h-100 hover-transition">
                        <div class="card-body p-4 p-lg-5">
                            <div class="essential-tool-img mb-4 mx-auto"><svg class="svg-icon svg-icon-light" style="width:60px;height:60px;color:#0af1c3">
                                    <use xlink:href="#tv-1"> </use>
                                </svg></div>
                            <h3 class="h5"> <a class="stretched-link reset-anchor" href="#">DTH Recharge</a>
                            </h3>
                            <p class="service_desc text-sm mb-0">You can do any tv recharge and get cashback for every
                                recharge.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 shadow h-100 hover-transition">
                        <div class="card-body p-4 p-lg-5">
                            <div class="essential-tool-img mb-4 mx-auto"><svg class="svg-icon svg-icon-light" style="width:60px;height:60px;color:#fa0a7a">
                                    <use xlink:href="#bank-cards-1"> </use>
                                </svg></div>
                            <h3 class="h5"> <a class="stretched-link reset-anchor" href="#">Bill Payments</a></h3>
                            <p class="service_desc text-sm mb-0">You can also pay bill like electricity,fastag and many
                                more</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer style="background: #0e406a;">
        <section class="section-site-adv shadow-md pt-4 pb-3 text-white">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="site-adv featured-box text-center">
                            <span><i class=" mb-3 fa fa-lock" aria-hidden="true"></i></span>
                            <h5>100% Secure Payments</h5>
                            <p class="">Moving your card details to a much more secured place.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="site-adv featured-box text-center">
                            <span><i class=" mb-3 fa fa-thumbs-up" aria-hidden="true"></i></span>
                            <h5>Trust pay</h5>
                            <p class="">100% Payment Protection. Easy Return Policy.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="site-adv featured-box text-center">
                            <span><i class=" mb-3 fa fa-bullhorn" aria-hidden="true"></i></span>
                            <h5>Refer &amp; Earn</h5>
                            <p class="">Invite a friend to sign up and earn up to ₹100 .</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="site-adv featured-box text-center">
                            <span><i class=" mb-3 fa fa-clock-o" aria-hidden="true"></i></span>
                            <h5>24X7 Support</h5>
                            <p class="">We're here to help. Have a query and need help ? <a href="#">Click here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container py-4">
            <div class="row py-5 gy-3">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="d-flex align-items-center mb-3"> <a class="footer_img navbar-brand" href="<?php echo DOMAIN_ORIGIN; ?>"><img src="../images/banner_logo.svg" width="150px" alt=""></a></div>
                    <p class="text-white text-sm fw-light mb-3">Crushpay is an indian multi bill payment softwere. You
                        can do any recharge from here and get cashback for every recharge.</p>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <h4 class="pt-2 text-white">Contact Info</h4>
                    <p class="text-white text-sm"><?php echo ADDRESS; ?></p>
                    <ul class="footer-a list-unstyled text-muted mb-0 mb-3 me-4">
                        <li><a href="tel:<?php echo SUPPORT_PHONE; ?>" class="text-sm text-decoration-none text-white"><?php echo SUPPORT_PHONE; ?></a></li>
                        <li><a href="mailto:<?php echo SUPPORT_EMAIL; ?>" class="text-sm text-decoration-none text-white"><?php echo SUPPORT_EMAIL; ?></a>
                        </li>
                    </ul>

                    <ul class="list-inline mb-0 text-white social-icon">
                        <li class="list-inline-item"><a class="reset-anchor text-sm" href="https://wa.me/+91<?php echo SUPPORT_WHATSAPP; ?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="reset-anchor text-sm" href="<?php echo SUPPORT_FACEBOOK; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="reset-anchor text-sm" href="<?php echo SUPPORT_TWITER; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li class="list-inline-item"><a class="reset-anchor text-sm" href="<?php echo SUPPORT_INSTAGRAM; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <!-- <li class="list-inline-item"><a class="reset-anchor text-sm" href="#!"><i class="fa fa-envelope" aria-hidden="true"></i></a></li> -->
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <h4 class="text-white">Quick links</h4>
                    <div class="d-flex flex-wrap">
                        <ul class="footer-a list-unstyled text-muted mb-0 mb-3 me-4">
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Privacy Policy</a></li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Terms and Condition</a>
                            </li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Refund Policy</a></li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Cookie Policy</a></li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">About Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                    <h4 class="text-white">Services</h4>
                    <div class="d-flex flex-wrap">
                        <ul class="footer-a list-unstyled text-muted mb-0 mb-3 me-4">
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Prepaid Recharge</a></li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">DTH Recharge</a></li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Wallet Money Transfer</a>
                            </li>
                            <li><a class="text-sm text-decoration-none text-white" href="#!">Bill & Payments</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights py-4" style="background: #0e406a">
            <div class="container">
                <p class="mb-0 mb-0 text-sm text-white text-center">Copyright &copy; 2022 All rights reserved by <a href="">Crush Pay</a></p>
            </div>
        </div>
    </footer>



    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {

            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
    </script>

    <!-- MY Scripts-------------------------START -->
    <script src="../scripts/main.js"></script>
    <script src="../scripts/nav.js"></script>
    <script src="../scripts/loginpopup.js"></script>
    <script>
        let DOMAIN = "<?php echo DOMAIN; ?>";
        let DOMAIN_ORIGIN = "<?php echo DOMAIN_ORIGIN; ?>";
    </script>
    <!-- MY Scripts-------------------------END -->

    <script>
        <?php

        if ($isMessage) {
        ?>
            alert("<?php echo $message ?>");
            let url = document.location.origin + document.location.pathname;
            // window.location = url;
            window.history.pushState("data", "Title", url);
        <?php
        }

        ?>
    </script>
</body>

</html>