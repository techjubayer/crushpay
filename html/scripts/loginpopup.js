function loginPopToggle() {
  $("#pop_title").text("Login");
  $("#login-pop").removeClass("hide");
  $("#signup-pop").addClass("hide");
  $("#reset-pop").addClass("hide");
  $("#otp-verify-pop").addClass("hide");
}

function signUpPopToggle() {
  $("#pop_title").text("Sign Up");
  $("#signup-pop").removeClass("hide");
  $("#login-pop").addClass("hide");
  $("#reset-pop").addClass("hide");
  $("#otp-verify-pop").addClass("hide");
}
function resetPopToggle() {
  $("#pop_title").text("Reset Password");
  $("#reset-pop").removeClass("hide");
  $("#login-pop").addClass("hide");
  $("#signup-pop").addClass("hide");
  $("#otp-verify-pop").addClass("hide");
}

function otpReserPopToggle() {
  $("#otp-verify-pop").removeClass("hide");
  $("#login-pop").addClass("hide");
  $("#signup-pop").addClass("hide");
  $("#reset-pop").addClass("hide");
  $(".pop_head_comm").toggleClass("hide");
}

$("#btn_web_login").click(function (e) {
  e.preventDefault();
  toggleLoginPopup();
});
$("#btn_reset_submit").click(function (e) {
  e.preventDefault();
  otpReserPopToggle();
});

$(".password_eye").click(function (e) {
  if ($(this).children("i").hasClass("fa-eye")) {
    $(this).children("i").removeClass("fa-eye");
    $(this).children("i").addClass("fa-eye-slash");
    $(this).siblings("input").attr("type", "text");
  } else {
    $(this).children("i").addClass("fa-eye");
    $(this).children("i").removeClass("fa-eye-slash");
    $(this).siblings("input").attr("type", "password");
  }
});

$(".otp_input").keyup(function () {
  if (this.value.length == this.maxLength) {
    $(this).next(".otp_input").focus();
  } else {
    $(this).prev(".otp_input").focus();
  }
});

var interval;
function countdown() {
  clearInterval(interval);
  interval = setInterval(function () {
    var timer = $("#otp_timer_txt").html();
    timer = timer.split(":");
    var minutes = timer[0];
    var seconds = timer[1];
    seconds -= 1;
    if (minutes < 0) return;
    else if (seconds < 0 && minutes != 0) {
      minutes -= 1;
      seconds = 59;
    } else if (seconds < 10 && length.seconds != 2) seconds = "0" + seconds;

    $("#otp_timer_txt").html(minutes + ":" + seconds);

    if (minutes == 0 && seconds == 0) {
      clearInterval(interval);
      $("#btn_otp_resend").prop("disabled", false);
    }
  }, 1000);
}
function restartTimer() {
  $("#otp_timer_txt").text("3:00");
  $("#btn_otp_resend").prop("disabled", true);
  clearInterval(interval);
  countdown();
}

// LOGIN EVENT--------------------------------START

$("#btn_loginSubmit").click(function (e) {
  e.preventDefault();
  $("#btn_loginSubmit").prop("disabled", true);

  let phoneEmail = $("#login_EP").val();
  let login_Pass = $("#login_Pass").val();

  if (validatePhone(phoneEmail) || validateEmail(phoneEmail)) {
    if (validatePassword(login_Pass)) {
      const data = {
        em_ph: phoneEmail,
        pass: login_Pass,
        from: "login",
      };
      let extraData = null;
      genTokenPass(data, extraData);
    } else {
      $("#btn_loginSubmit").prop("disabled", false);
      alert("Invalid password, it must be 6 character length");
      $("#login_Pass").focus();
    }
  } else {
    $("#btn_loginSubmit").prop("disabled", false);
    alert("Invalid email or phone");
    $("#login_EP").focus();
  }
});

function genTokenPass(data, extraData) {
  const api = DOMAIN_ORIGIN + "/auth/gen_.php";

  $.ajax({
    type: "POST",
    url: api,
    data: data,
    dataType: "json",
    success: function (resultData) {
      $("#btn_loginSubmit").prop("disabled", false);
      if (resultData.response) {
        // console.log(resultData.cs);
        // console.log(resultData.pass);
        if (data.from == "login") {
          const dataPost = {
            em_ph: data.em_ph,
            pass: resultData.pass,
            cs: resultData.cs,
          };
          loginDataPost(dataPost);
        } else if (data.from == "sign_up") {
          const dataPost = {
            user_name: extraData.user_name,
            user_phone: extraData.user_phone,
            user_email: extraData.user_email,
            plane_pass: extraData.plane_pass,
            user_pass: resultData.pass,
            cs: resultData.cs,
          };

          signUpDataPost(dataPost);
        }
      } else {
        alert(resultData.message);
      }
    },
  });
}

function loginDataPost(data) {
  console.log(data.pass);

  const api = DOMAIN_ORIGIN + "/auth/login.php";

  $("<form/>", { action: api, method: "POST" })
    .append(
      $("<input>", {
        type: "hidden",
        name: "em_ph",
        value: data.em_ph,
      }),
      $("<input>", {
        type: "hidden",
        name: "pass",
        value: data.pass,
      }),
      $("<input>", {
        type: "hidden",
        name: "cs",
        value: data.cs,
      })
    )
    .appendTo("body")
    .submit();
}

// LOGIN EVENT--------------------------------END

// SIGN-UP EVENT--------------------------------START
$("#btn_signup").click(function (e) {
  e.preventDefault();
  $("#btn_signup").prop("disabled", true);

  // console.log(DOMAIN);
  // console.log(DOMAIN_ORIGIN);

  let userName = $("#inpt_name_sgn").val();
  let userPhone = $("#inpt_tel_sgn").val();
  let userEmail = $("#inpt_email_sgn").val();
  let userPass1 = $("#inpt_pass1_sgn").val();
  let userPass2 = $("#inpt_pass2_sgn").val();

  if (userName != "") {
    if (userPhone != "" && validatePhone(userPhone)) {
      if (userEmail != "") {
        if (!validateEmail(userEmail)) {
          $("#btn_signup").prop("disabled", false);
          alert("Please enter valid email");
          $("#inpt_email_sgn").focus();
          return false;
        }
      }

      if (validatePassword(userPass1)) {
        if (validatePassword(userPass2) && userPass1 == userPass2) {
          const data = {
            em_ph: userPhone,
            pass: userPass2,
            from: "sign_up",
          };
          const extraData = {
            user_name: userName,
            user_phone: userPhone,
            user_email: userEmail,
            plane_pass: userPass2,
          };
          genTokenPass(data, extraData);
        } else {
          $("#btn_signup").prop("disabled", false);
          alert("Confirm password not match, please check");
          $("#inpt_pass2_sgn").focus();
        }
      } else {
        $("#btn_signup").prop("disabled", false);
        alert("Invalid password, it must be 6 character length");
        $("#inpt_pass1_sgn").focus();
      }
    } else {
      $("#btn_signup").prop("disabled", false);
      alert("Please enter valid number");
      $("#inpt_tel_sgn").focus();
    }
  } else {
    $("#btn_signup").prop("disabled", false);
    alert("Please enter your name");
    $("#inpt_name_sgn").focus();
  }
});

function signUpDataPost(data) {
  // console.log(data.pass);

  const api = DOMAIN_ORIGIN + "/auth/signup_otp_seneder.php";

  $.ajax({
    type: "POST",
    url: api,
    data: data,
    dataType: "json",
    success: function (resultData) {
      $("#btn_signup").prop("disabled", false);
      if (resultData.response) {
        console.log(resultData.token);
        otpReserPopToggle();
        countdown();
        $("#otp_to_phone").text("Please enter otp send to your mobile number: " + data.user_phone);
      } else {
        alert(resultData.message);
      }
    },
  });
}

// SIGN-UP EVENT--------------------------------END
