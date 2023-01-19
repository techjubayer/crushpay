$(document).ready(function () {
  $(window).scroll(function () {
    if ($(window).scrollTop() >= 5) {
      $(".navfixed-top").addClass("navfixedscroll");
    } else {
      $(".navfixed-top").removeClass("navfixedscroll");
    }

    // if($(window).scrollTop() >= 100){
    //   $(".loginpopup").css({
    //     "position": "sticky",
    //     "top": "15%"
    //   });
    // }
  });
});

function toggleNavbar() {
  $(".navbar-toggler").toggleClass("collapsed");
  $(".navbar-collapse.collapse").toggleClass("show");

  if ($(".navbar-toggler").attr("aria-expanded")) {
    $(".navbar-toggler").attr("aria-expanded", "true");
  } else {
    $(".navbar-toggler").attr("aria-expanded", "false");
  }
}
