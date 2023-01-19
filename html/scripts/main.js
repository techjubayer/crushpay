
$(document).ready(function(){

    $('#preloader').css('display','none');

});

function toggleLoginPopup() {
    if ($(".navbar-collapse.collapse").hasClass("show")) {
      toggleNavbar();
    }
    $("#loginpopup").toggleClass("toggleshow");
  }


function validatePhone(txtPhone) {
    let filter = /^[6-9]\d{9}$/;
    if (filter.test(txtPhone)) {
        return true;
    }
    else {
        return false;
    }
}

function validateEmail (textEmail) {
    let filter = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (filter.test(textEmail)) {
        return true;
    }
    else {
        return false;
    }
  }
function validatePassword (textPassword) {
    if (textPassword.length >= 6) {
        return true;
    }
    else {
        return false;
    }
  }