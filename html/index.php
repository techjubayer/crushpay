<?php

require("./var/contact-us.php");
require("./var/var.php");

require("./auth/auth.php");
require("./control/datavalidation.php");
require("./control/db_config.php");


function redirectWithClear($callBackUrl)
{
    session_start();
    session_destroy();

    setcookie("token", "", -1, "/", DOMAIN, true, true);
    setcookie("user_id", "", -1, "/", DOMAIN, true, true);
    setcookie("user_phone", "", -1, "/", DOMAIN, true, true);

    header("location: " . $callBackUrl);
}


$callBackUrl = "./home/";
if (
    isset($_COOKIE['token']) &&
    isset($_COOKIE['user_id']) &&
    isset($_COOKIE['user_phone'])
) {

    session_start();
    if (
        isset($_SESSION['token']) &&
        isset($_SESSION['user_id']) &&
        isset($_SESSION['user_phone'])
    ) {


        $data_validation_token = "aj2M31ds@JKbf&873";
        $DataValidation = new DataValidation($data_validation_token);

        $token_session = $DataValidation->sanitize($_SESSION['token']);
        $user_id_session = $DataValidation->sanitize($_SESSION['user_id']);
        $user_phone_session = $DataValidation->sanitize($_SESSION['user_phone']);

        $token_cookie = $DataValidation->sanitize($_COOKIE['token']);
        $user_id_cookie = $DataValidation->sanitize($_COOKIE['user_id']);
        $user_phone_cookie = $DataValidation->sanitize($_COOKIE['user_phone']);

        if (
            $token_session == $token_cookie &&
            $user_id_session == $user_id_cookie &&
            $user_phone_session == $user_phone_cookie
        ) {
            $DBConnection = new DBConnection("2M31ds@f8JKbfajdsb73");       //My outer class
            $conn = $DBConnection->dbConn("crush_user", "ziKuT@iW5.aB72pz", "crushpay_users");

            //Auth file Class-------------------
            $UserValidation = new UserValidation("3545aehnq6SJOEnt487lge4c");
            $checkUser = $UserValidation->checkUser($conn, $token_cookie, $user_id_cookie, $user_phone_cookie);

            if ($checkUser) {
                $balance = $checkUser['balance'];
                $userName = $checkUser['user_name'];
            } else {
                redirectWithClear($callBackUrl);
            }
        } else {
            redirectWithClear($callBackUrl);
        }
    } else {
        redirectWithClear($callBackUrl);
    }
} else {
    redirectWithClear($callBackUrl);
}


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
    <meta property="og:image" content="./images/icon_logo.svg" />
    <meta name="theme-color" content="#0e406a">
    <meta name="msapplication-TileColor" content="#0e406a">
    <link rel="icon" href="./images/icon_logo.svg" type="image/svg">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Google font -->
    <link href="http://fonts.cdnfonts.com/css/arial-rounded-mt-bold" rel="stylesheet">
    <!-- Font Awsome -->
    <link rel="stylesheet" href="./css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.default copy.css">



    <!-- MyStyle--------------------------START -->
    <link rel="stylesheet" href="./css/vendor/main.css">
    <link rel="stylesheet" href="./css/vendor/navbar.css">
    <link rel="stylesheet" href="./css/vendor/rc_style.css">
    <!-- <link rel="stylesheet" href="./css/vendor/loginpopup.css"> -->
    <!-- MyStyle--------------------------END -->
</head>

<body>

    <div id="preloader">

    </div>


    <section class="navfixed-top">
        <nav class=" navbar container navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./images/banner_logo.svg" width="150px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav-list navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item footer-a">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#">Add Money</a>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#">Send Money</a>
                        </li>
                        <li class="nav-item dropdown footer-a">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Histories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Recharge history</a></li>
                                <li><a class="dropdown-item" href="#">Recharge history</a></li>
                                <li><a class="dropdown-item" href="#">Recharge history</a></li>
                            </ul>
                        </li>
                        <li class="nav-item footer-a">
                            <a class="nav-link" href="#">Profile</a>
                        </li>
                        <hr>
                        <li class="nav-item nav_login_btn footer-a">
                            <a class="nav-link" id="btn_logout" href="#"><?php echo $userName ?> <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <section class="mainbody">

        <div class="rc_from_container container">
            <div class="rc_header">
                <div class="rc_header_icon d-flex justify-content-around">
                    <span id="prerc_icon_tab" class="rc_icon active"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                    <span id="dthrc_icon_tab" class="rc_icon "><i class="fa fa-television" aria-hidden="true"></i></span>
                </div>
                <div class="rc_header_balance">
                    <p>Available balance</p>
                    <p id="rc_header_balance">₹ <?php echo $balance; ?></p>
                </div>
            </div>
            <div class="rc_body row">
                <div class="rc_form col-lg">
                    <h3 id="rc_head_title">Prepaid Recharge</h3>
                    <form action="">
                        <div class="input_my_style">
                            <input type="tel" placeholder=" ">
                            <label for="">Enter mobile number</label>
                            <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                        </div>
                        <div class="row">
                            <div id="pre_opt_container" class="col input_my_style selection">
                                <select name="" id="">
                                    <option value="" selected="true" disabled="disabled">Operator</option>
                                    <option value="">Jio</option>
                                    <option value="">Airtel</option>
                                    <option value="">VI</option>
                                    <option value="">BSNL</option>
                                </select>
                            </div>
                            <div id="dth_opt_container" class="col input_my_style selection d-none">
                                <select name="" id="">
                                    <option value="" selected="true" disabled="disabled">Operator</option>
                                    <option value="">Dish TV</option>
                                    <option value="">Tata Sky</option>
                                    <option value="">Sun Disk</option>
                                    <option value="">BSNL</option>
                                </select>
                            </div>
                            <div id="circle_container" class="col input_my_style selection">
                                <select name="" id="">
                                    <option value="" selected="true" disabled="disabled">Circle</option>
                                    <option value="">Jio</option>
                                    <option value="">Airtel</option>
                                    <option value="">VI</option>
                                    <option value="">BSNL</option>
                                </select>
                            </div>
                        </div>
                        <div class="input_my_style">
                            <input id="input_amount" type="tel" placeholder=" " onfocus="fetchPlan()">
                            <label for="">Enter amount</label>
                            <span><i class="fa fa-inr" aria-hidden="true"></i></span>
                            <span id="view_plan" onclick="toggleLoginPopup()">View plan+</span>
                        </div>
                        <button class="btn_myStyle w-100">Submit</button>
                    </form>
                </div>
                <div class="slide_img col-lg"><img src="./images/refer_banner.svg" alt="" width="100%"></div>
            </div>
        </div>

    </section>

    <section id="loginpopup" class="loginpopup toggleshow">
        <div class="popupbody plan_container">
            <div class="plan_head">
                <span onclick="toggleLoginPopup()"><i class="fa fa-times" aria-hidden="true"></i></span>
                <!-- <img class="pop_head_comm d-block m-auto mb-4" src="./images/banner_logo.svg" width="150px" alt=""> -->
                <h4 id="pop_title pop_head_comm d-block m-auto mb-4" class="pop_head_comm">View Plan</h4>

                <div class="row my-5">
                    <p class="col-md-6">Browse Plans: </p>
                    <div class="col-md-6 input_my_style selection">
                        <select name="" id="">
                            <option value="" selected="true" disabled="disabled">All Plan</option>
                            <option value="">Jio</option>
                            <option value="">Airtel</option>
                            <option value="">VI</option>
                            <option value="">BSNL</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="planbody">
                <table class="table w-100 table-hover border">
                    <tbody id="plan">
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="plan_desc text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>
                        <tr>
                            <td class="text-5 my_text text-center align-middle">₹15 <span class="text-1 my_text d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 my_text d-block">Validity</span></td>
                            <td class="text-1 my_text align-middle">Pack validity Active Plan Total data 1 GB Data at high speed (Post which unlimited @ 64 Kbps) 1 GB</td>
                            <td class="page-link-recharge" data-id="15"> <button class="btn_myStyle w-100 px-2 py-0">Recharge Now</button> </td>
                        </tr>



                        <tr>
                            <td class="text-5 text-primary text-center align-middle">₹25 <span class="text-1 text-muted d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 text-muted d-block">Validity</span></td>
                            <td class="text-1 text-muted align-middle">Pack validity Active Plan Total data 2 GB Data at high speed (Post which unlimited @ 64 Kbps) 2 GB</td>
                            <td class="page-link-recharge" data-id="25">
                                <button class="btn_myStyle w-100">Recharge Now</button>
                                <button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="submit">Recharge Now</button>
                            </td>
                        </tr>



                        <tr>
                            <td class="text-5 text-primary text-center align-middle">₹61 <span class="text-1 text-muted d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 text-muted d-block">Validity</span></td>
                            <td class="text-1 text-muted align-middle">Pack validity Active Plan Total data 6 GB Data at high speed (Post which unlimited @ 64 Kbps) 6 GB</td>
                            <td class="page-link-recharge" data-id="61"><button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="submit">Recharge Now</button></td>
                        </tr>



                        <tr>
                            <td class="text-5 text-primary text-center align-middle">₹121 <span class="text-1 text-muted d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">N/A<span class="text-1 text-muted d-block">Validity</span></td>
                            <td class="text-1 text-muted align-middle">Pack validity Active Plan Total data 12 GB Data at high speed (Post which unlimited @ 64 Kbps) 12 GB</td>
                            <td class="page-link-recharge" data-id="121"><button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="submit">Recharge Now</button></td>
                        </tr>



                        <tr>
                            <td class="text-5 text-primary text-center align-middle">₹181 <span class="text-1 text-muted d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">30 days<span class="text-1 text-muted d-block">Validity</span></td>
                            <td class="text-1 text-muted align-middle">WORK FROM HOME DATA PACK Pack validity 30 days Total data 30 GB Data at high speed (Post which unlimited @ 64 Kbps) 30 GB</td>
                            <td class="page-link-recharge" data-id="181"><button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="submit">Recharge Now</button></td>
                        </tr>



                        <tr>
                            <td class="text-5 text-primary text-center align-middle">₹241 <span class="text-1 text-muted d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">30 days<span class="text-1 text-muted d-block">Validity</span></td>
                            <td class="text-1 text-muted align-middle">WORK FROM HOME DATA PACK Pack validity 30 days Total data 40 GB Data at high speed (Post which unlimited @ 64 Kbps) 40 GB</td>
                            <td class="page-link-recharge" data-id="241"><button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="submit">Recharge Now</button></td>
                        </tr>



                        <tr>
                            <td class="text-5 text-primary text-center align-middle">₹301 <span class="text-1 text-muted d-block">Amount</span></td>

                            <td class="text-3 text-center align-middle">30 days<span class="text-1 text-muted d-block">Validity</span></td>
                            <td class="text-1 text-muted align-middle">WORK FROM HOME DATA PACK Pack validity 30 days Total data 50 GB Data at high speed (Post which unlimited @ 64 Kbps) 50 GB</td>
                            <td class="page-link-recharge" data-id="301"><button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="submit">Recharge Now</button></td>
                        </tr>




                        <!-- <script>
                        
                    </script> -->
                    </tbody>
                </table>
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
                    <div class="d-flex align-items-center mb-3"> <a class="footer_img navbar-brand" href="<?php echo DOMAIN_ORIGIN; ?>"><img src="./images/banner_logo.svg" width="150px" alt=""></a></div>
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






    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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
    <script src="./scripts/main.js"></script>
    <script src="./scripts/nav.js"></script>
    <script src="./scripts/rc.js"></script>
    <!-- MY Scripts-------------------------END -->
</body>

</html>