function otpSned() {
  $("#otp_btn").hide();
  // show that something is loading
  $("#response").html(
    '<center><div class="alert alert-primary" role="alert"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div></center>'
  );

  // Call ajax for pass data to other place
  //   let i = 0;
  // for (let i = 312345; i < 987654; i++)
  let i = 312345;
  while (i < 987654) {
    console.log(i);
    $.ajax({
      type: "POST",
      url: "../auth_page/auth.php?otp_verify",
      data: { otp: i }, // getting filed value in serialize form
    })
      .done(function (data) {
        // if getting done then call.
        $("#otp_btn").show();
        console.log(data);
        // document.getElementById('userForm').reset();
        // show the response
        var info = JSON.parse(data);
        if (info.status === "success") {
          console.log("SUCCESS");
          $("#response").html(
            '<center><div class="alert alert-success" role="alert">' +
              info.message +
              "</div></center>"
          );
          // $('#login_div').hide();
          //    $('#otp_div').show();
          window.location = "home";
          $("#otp_btn").show();
        } else {
          i++;
          $("#response").html(
            '<center><div class="alert alert-danger" role="alert">' +
              info.message +
              "</div></center>"
          );
          $("#otp_btn").show();
          console.log(info.message);
        }

        // Clear form
      })
      .fail(function () {
        // if fail then getting message

        // just in case posting your form failed
        $("#response").html(
          '<center><div class="alert alert-danger" role="alert">Try again</div></center>'
        );
        $("#otp_btn").show();
      });
  }
  // to prevent refreshing the whole page page
  return false;
}
