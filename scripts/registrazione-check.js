/* eslint-env jquery browser */
const registerButton = $("#registerButton");

function disableButton(){

  registerButton.attr("disabled", "disabled");
  registerButton.attr("class", "materialButton disabledButton _70");
}
function enableButton(){
  registerButton.removeAttr("disabled");
  registerButton.attr("class", "materialButton _70");
}

$(document).ready(function() {
  $('.script').css('display', 'block');
  $('.script-inline').css('display', 'inline-block');
  // check password
  $("#pwd-repeat").keyup(function () {
    const val1 = $("#pwdreg").val();
    const val2 = $("#pwd-repeat").val();
    if (val1 != val2 && val2 != "") {
      $("#error-pswd").show();
      disableButton();
      $("#pwd-repeat").attr("class", "LoginInputDanger");
    } else {
      $("#error-pswd").hide();
      enableButton();
      $("#pwd-repeat").attr("class", "LoginInput");
    }
  });

  $("#pwdreg").keyup(function () {
    const val1 = $("#pwdreg").val();
    const val2 = $("#pwd-repeat").val();
    if(val1.length<8){
      $("#error-pswd-length").show();
      disableButton();
      $("#pwdreg").attr("class", "LoginInputDanger");
    }
    else{
      $("#error-pswd-length").hide();
      $("#pwdreg").attr("class", "LoginInput");
      if (val1 != val2 && val2 != "") {
        $("#error-pswd").show();
        disableButton();
        $("#pwd-repeat").attr("class", "LoginInputDanger");
      } else {
        $("#error-pswd").hide();
        enableButton();
        $("#pwd-repeat").attr("class", "LoginInput");
      }

    }

  });

  // errore sullo username
  $("#username").keyup(function () {
    if($(this).val().length <4) {
      $("#error-username-length").show();
      disableButton();
      $(this).attr("class", "LoginInputDanger");
    }
    else if(/\s/.test($(this).val())){
      $("#error-username-spazi").show();
      disableButton();
      $(this).attr("class", "LoginInputDanger");
    }
    else {
      $("#error-username-length").hide();
      $("#error-username-spazi").hide();
      $.ajax({
        url: "registrazione.php",
        type: "POST",
        data: {
          username: $("#username").val(),
          checkUser: 1,
        },
        success(data) {
          if (data == 1) {
            $("#error-username").show();
            disableButton();
            $("#username").attr("class", "LoginInputDanger");
          } else {
            $("#error-username").hide();
           enableButton();
            $("#username").attr("class", "LoginInput");
          }
        }
      });
    }
  });
  // errore sulla mail
  $("#mail").keyup(function () {
    if (!(/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(this.value))){
      $("#error-mail-format").show();
      disableButton();
      $(this).attr("class", "LoginInputDanger");
    }
    else{
      $("#error-mail-format").hide();
      $.ajax({
        url: "registrazione.php",
        type: "POST",
        data: {
          mail: $("#mail").val(),
          checkMail: 1,
        },
        success(data) {
          if (data == 1) {
            $("#error-mail").show();
            disableButton();
            $("#mail").attr("class", "LoginInputDanger");
          } else {
            $("#error-mail").hide();
            enableButton();
            $("#mail").attr("class", "LoginInput");
          }
        },
      });
    }



  });

  // submit del form
  registerButton.click(function() {
    // la funzionalità di base del bottone non verrà triggerata, non parte la registrazione
    // di base ma solo questa funzione
    $.ajax({
      url: "registrazione.php",
      type: "POST",
      data: {
        username: $("#username").val(),
        password: $("#pwdreg").val(),
        passwordRepeat: $("#pwd-repeat").val(),
        mail: $("#mail").val(),
        registration: 1,
      },
      success(data) {
        if (data == 1) {
          // hide the registration form
          $("#registrationForm").hide();
          $("#registrationSuccess").show();
        } else {
          $("#registrationError").show();
        }
      },

    });

  });


  $("#loginButton").click(function(event){
      event.returnValue = false;
      if (event.stopPropagation) {
          event.preventDefault();
      }
      $.ajax({
      url: "login.php",
      type: "POST",
      data: {
        username: $("#loginUsername").val(),
        password: $("#loginPassword").val(),
        script: 1,

      },
      success(data) {
        if (data == 1) {
          // login riuscito, ricaricare la pagina e settre le variabili di sessione
          location.reload();
        } else {
          // showare il messaggio di login fallito
          $("#loginError").show();
        }
      },
    });
  });

});
