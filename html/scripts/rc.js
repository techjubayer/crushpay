$(document).ready(function () {
  $(".rc_icon").click(function () {
    $(".rc_icon").toggleClass("active");
    $(".input_my_style.selection").toggleClass("d-none");
    if ($("#rc_head_title").text() == "Prepaid Recharge") {
      $("#rc_head_title").text("DTH Recharge");
    } else {
      $("#rc_head_title").text("Prepaid Recharge");
    }
  });

  $("#btn_logout").click(function (e) {
    e.preventDefault();
    let msg = "Do you want to log out?";
    if (confirm(msg) == true) {
      window.location.href = "./auth/logout.php";
    }
  });
});

// Popup Scroll Tab------------------START
$(".page-link-recharge").on("click", function () {
  toggleLoginPopup();
  var amount = $(this).data("id");
  // $('#close_plan').click();
  $("#input_amount").val(amount);
  // $('#show_amount').text(amount);
});


function fetchPlan() {
  const api = "https://crushpay.in/api/plan_fetch/";
  let data = null;

  $.ajax({
    type: "POST",
    url: api,
    data: data,
    dataType: "json",
    success: function (resultData) {
      if (resultData.response) {
        console.log(resultData.data);
      } else {
        alert(resultData.message);
      }
    },
  });
}

// Popup Scroll Tab------------------END
