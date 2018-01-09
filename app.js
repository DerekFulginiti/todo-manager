$(document).ready(function() {
  var urlPath = window.location.pathname;
  var urlPage = urlPath.substring(urlPath.lastIndexOf("/") + 1);
  $(".form-group").on("keyup", "input", function() {
    var error_div = $(this).closest(".form-group").find(".vfb");
    var email_ret, pass_ret;
    if($(this).is("#email")) { // user is entering an email
      var email = $(this).val();
      email_ret = validateEmail(email);
      if(email_ret) { // email passes
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        error_div.empty();
        error_div.append("<p class='ok'>Valid</p>");
      } else { // email does not pass
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        error_div.empty();
        error_div.append("<p class='invalid'>Please enter a valid email.</p>");
      }
    } else if($(this).is("#password")) { // user is entering a password
        var password = $.trim($(this).val());
        pass_ret = validatePassword(password);
        if(pass_ret == 0) { // valid
          $(this).removeClass("is-invalid");
          $(this).addClass("is-valid");
          error_div.empty();
          error_div.append("<p class='ok'>Valid</p>");
        } else if(pass_ret == 1) { //less than 6 chars
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            error_div.empty();
            error_div.append("<p class='invalid'>Must be at least 6 characters.</p>");
        } else if(pass_ret ==2) { // more than 20 chars
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            error_div.empty();
            error_div.append("<p class='invalid'>Cannot be more than 20 characters.</p>");
        } else if(pass_ret == 3) { // contains spaces
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            error_div.empty();
            error_div.append("<p class='invalid'>Must not contain spaces.</p>");
        } else if(pass_ret == 4) {
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            error_div.empty();
            error_div.append("<p class='invalid'>Invalid Password.</p>");
      }
    } else if($(this).is("#flname")) { // user is entering full name
        var full_name = $.trim($(this).val());
        flname_ret = validateName(full_name);
        if(flname_ret) { // name passes
          $(this).removeClass("is-invalid");
          $(this).addClass("is-valid");
          error_div.empty();
          error_div.append("<p class='ok'>Valid</p>");
        } else { // name does not pass
            $(this).removeClass("is-valid");
            $(this).addClass("is-invalid");
            error_div.empty();
            error_div.append("<p class='invalid'>Ex: Roy Geebiv.</p>");
        }
    } else if($(this).is("#phone")) { // user is entering phone number
      var phone = $.trim($(this).val());
      phone_ret = validatePhone(phone);
      if(phone_ret) { // phone passes
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
        error_div.empty();
        error_div.append("<p class='ok'>Valid</p>");
      } else { // name does not pass
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
        error_div.empty();
        error_div.append("<p class='invalid'>Ex: (999)-999-9999.</p>");
      }
    }

    if(urlPage == "index.php") { // logic is slighly different for signup form
      if($("#email-vfb p").hasClass("ok") && $("#password-vfb p").hasClass("ok")){
        $("#submit-button").removeAttr("disabled");
      } else {
        $("#submit-button").attr("disabled", "disabled");
      }
    } else if(urlPage == "signup.php") {
        if($("#flname-vfb p").hasClass("ok") && $("#email-vfb p").hasClass("ok") && $("#phone-vfb p").hasClass("ok") && $("#password-vfb p").hasClass("ok")){
          $("#submit-button").removeAttr("disabled");
        } else {
          $("#submit-button").attr("disabled", "disabled");
      }
    }
  });
});

function validateEmail(email) {
   var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   return re.test(email.toLowerCase());
}

function validatePassword(password) {
  var re = /^([^ ]){6,20}$/;
  if(password.length < 6) {
    return 1;
  } else if(password.length > 20) {
    return 2;
  } else if(password.indexOf(" ") >= 0) {
    return 3;
  } else if(re.test(password) == false) {
    return 4;
  } else {
    return 0;
  }
}

function validateName(full_name) {
  var re = /^([a-z]{1,20}) ([a-z]{1,20})$/;
  return re.test(full_name.toLowerCase());
}

function validatePhone(phone) {
   var re = /^\(?[0-9]{3}\)?\-?[0-9]{3}\-?[0-9]{4}$/;
   return re.test(phone);
}
