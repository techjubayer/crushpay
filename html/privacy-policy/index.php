<?php

require("../var/contact-us.php");
require("../var/var.php");

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
                            <a class="nav-link" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#services_container">Services</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="../terms-condition/">Terms & condition</a>
                        </li>
                        <li class="nav-item dropdown footer-a">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Policies
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item active" href="../privacy-policy/">Privacy policy</a></li>
                                <li><a class="dropdown-item" href="../refund-policy/">Refund policy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="../about-us">About us</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="../contact-us">Contact us</a>
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
                        <input type="tel" placeholder=" ">
                        <label for="">Enter your name *</label>
                        <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input type="tel" placeholder=" ">
                        <label for="">Enter mobile number *</label>
                        <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input type="tel" placeholder=" ">
                        <label for="">Enter email</label>
                        <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input type="password" placeholder=" ">
                        <label for="">Enter password *</label>
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="password_eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input type="password" placeholder=" ">
                        <label for="">Re enter password *</label>
                        <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="password_eye"><i class="fa fa-eye" aria-hidden="true"></i></span>
                    </div>
                    <div class="input_my_style">
                        <input type="tel" placeholder=" ">
                        <label for="">Friend's refer code</label>
                        <span><i class="fa fa-handshake-o" aria-hidden="true"></i></span>
                    </div>
                    <button class="btn_myStyle w-100">Submit</button>
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
                <p>Please enter otp send to your mobile number: 86*****107</p>
                <div>
                    <input type="number">
                    <input type="number">
                    <input type="number">
                    <input type="number">
                    <input type="number">
                </div>
                <button class="btn_myStyle w-100">Submit</button>
                <div class="loginactivity d-flex justify-content-end mt-4">
                    <h6 class="mt-2">Don't recieve the otp?</h6>
                    <div>
                        <button class="btn_myStyle">Resend</button>
                        <p class="text-center my_text"><small>01:59</small></p>
                    </div>
                </div>
            </div>
            <!-- OTP Verify---------------END -->



        </div>
    </section>

    <section class="details_container container my-5">
        <h3>Privacy Policy for Crush Pay</h3>

        <p class="my_text">At Crush Pay, accessible from https://crushpay.in/, one of our main priorities is the privacy of our
            visitors. This Privacy Policy document contains types of information that is collected and recorded by Crush
            Pay and how we use it.</p>

        <p class="my_text">If you have additional questions or require more information about our Privacy Policy, do not hesitate to
            contact us.</p>

        <p class="my_text">This Privacy Policy applies only to our online activities and is valid for visitors to our website with
            regards to the information that they shared and/or collect in Crush Pay. This policy is not applicable to
            any information collected offline or via channels other than this website. Our Privacy Policy was created
            with the help of the <a href="https://www.privacypolicygenerator.info">Free Privacy Policy Generator</a>.
        </p>

        <h4>Consent</h4>

        <p class="my_text">By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

        <h4>Information we collect</h4>

        <p class="my_text">The personal information that you are asked to provide, and the reasons why you are asked to provide it, will
            be made clear to you at the point we ask you to provide your personal information.</p>
        <p class="my_text">If you contact us directly, we may receive additional information about you such as your name, email address,
            phone number, the contents of the message and/or attachments you may send us, and any other information you
            may choose to provide.</p>
        <p class="my_text">When you register for an Account, we may ask for your contact information, including items such as name,
            company name, address, email address, and telephone number.</p>

        <h4>How we use your information</h4>

        <p class="my_text">We use the information we collect in various ways, including to:</p>

        <ul class="my_text">
            <li>Provide, operate, and maintain our website</li>
            <li>Improve, personalize, and expand our website</li>
            <li>Understand and analyze how you use our website</li>
            <li>Develop new products, services, features, and functionality</li>
            <li>Communicate with you, either directly or through one of our partners, including for customer service, to
                provide you with updates and other information relating to the website, and for marketing and
                promotional purposes</li>
            <li>Send you emails</li>
            <li>Find and prevent fraud</li>
        </ul>

        <h4>Log Files</h4>

        <p class="my_text">Crush Pay follows a standard procedure of using log files. These files log visitors when they visit websites.
            All hosting companies do this and a part of hosting services' analytics. The information collected by log
            files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time
            stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that
            is personally identifiable. The purpose of the information is for analyzing trends, administering the site,
            tracking users' movement on the website, and gathering demographic information.</p>

        <h4>Cookies and Web Beacons</h4>

        <p class="my_text">Like any other website, Crush Pay uses 'cookies'. These cookies are used to store information including
            visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is
            used to optimize the users' experience by customizing our web page content based on visitors' browser type
            and/or other information.</p>

        <p class="my_text">For more general information on cookies, please read <a href="https://www.iubenda.com/privacy-policy/28386499" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Cookie Policy</a>
            <script type="text/javascript">
                (function(w, d) {
                    var loader = function() {
                        var s = d.createElement("script"),
                            tag = d.getElementsByTagName("script")[0];
                        s.src = "https://cdn.iubenda.com/iubenda.js";
                        tag.parentNode.insertBefore(s, tag);
                    };
                    if (w.addEventListener) {
                        w.addEventListener("load", loader, false);
                    } else if (w.attachEvent) {
                        w.attachEvent("onload", loader);
                    } else {
                        w.onload = loader;
                    }
                })(window, document);
            </script>.
        </p>

        <h4>Google DoubleClick DART Cookie</h4>

        <p class="my_text">Google is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads
            to our site visitors based upon their visit to www.website.com and other sites on the internet. However,
            visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy
            Policy at the following URL – <a href="https://policies.google.com/technologies/ads">https://policies.google.com/technologies/ads</a></p>


        <h4>Advertising Partners Privacy Policies</h4>

        <P class="my_text">You may consult this list to find the Privacy Policy for each of the advertising partners of Crush Pay.</p>

        <p class="my_text">Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are
            used in their respective advertisements and links that appear on Crush Pay, which are sent directly to
            users' browser. They automatically receive your IP address when this occurs. These technologies are used to
            measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that
            you see on websites that you visit.</p>

        <p class="my_text">Note that Crush Pay has no access to or control over these cookies that are used by third-party advertisers.
        </p>

        <h4>Third Party Privacy Policies</h4>

        <p class="my_text">Crush Pay's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to
            consult the respective Privacy Policies of these third-party ad servers for more detailed information. It
            may include their practices and instructions about how to opt-out of certain options. </p>

        <p class="my_text">You can choose to disable cookies through your individual browser options. To know more detailed information
            about cookie management with specific web browsers, it can be found at the browsers' respective websites.
        </p>

        <h4>CCPA Privacy Rights (Do Not Sell My Personal Information)</h4>

        <p class="my_text">Under the CCPA, among other rights, California consumers have the right to:</p>
        <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces
            of personal data that a business has collected about consumers.</p>
        <p class="my_text">Request that a business delete any personal data about the consumer that a business has collected.</p>
        <p class="my_text">Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
        <p class="my_text">If you make a request, we have one month to respond to you. If you would like to exercise any of these
            rights, please contact us.</p>

        <h4>GDPR Data Protection Rights</h4>

        <p class="my_text">We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled
            to the following:</p>
        <p class="my_text">The right to access – You have the right to request copies of your personal data. We may charge you a small
            fee for this service.</p>
        <p class="my_text">The right to rectification – You have the right to request that we correct any information you believe is
            inaccurate. You also have the right to request that we complete the information you believe is incomplete.
        </p>
        <p class="my_text">The right to erasure – You have the right to request that we erase your personal data, under certain
            conditions.</p>
        <p class="my_text">The right to restrict processing – You have the right to request that we restrict the processing of your
            personal data, under certain conditions.</p>
        <p class="my_text">The right to object to processing – You have the right to object to our processing of your personal data,
            under certain conditions.</p>
        <p class="my_text">The right to data portability – You have the right to request that we transfer the data that we have
            collected to another organization, or directly to you, under certain conditions.</p>
        <p class="my_text">If you make a request, we have one month to respond to you. If you would like to exercise any of these
            rights, please contact us.</p>

        <h4>Children's Information</h4>

        <p class="my_text">Another part of our priority is adding protection for children while using the internet. We encourage parents
            and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

        <p class="my_text">Crush Pay does not knowingly collect any Personal Identifiable Information from children under the age of 13.
            If you think that your child provided this kind of information on our website, we strongly encourage you to
            contact us immediately and we will do our best efforts to promptly remove such information from our records.
        </p>
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
    <!-- MY Scripts-------------------------END -->
</body>

</html>