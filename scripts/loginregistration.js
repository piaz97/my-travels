// Get the modal
var modallog = document.getElementById("logincanvas");
var modalreg = document.getElementById("registrazionecanvas");
var darkener = document.getElementById("darkener");
function openPopup(toOpen) {
    if(toOpen=="registrazionecanvas") {
        modallog.style.display="none";
        modalreg.style.display="block";
        modalreg.querySelector("a").focus();
        document.getElementById("linkRegistrazionePopup").addEventListener("focus",
            function(){
                        modalreg.querySelector("a").focus();
                    });
    }
    else {
        modalreg.style.display="none";
        modallog.style.display="block";
        modallog.querySelector("a").focus();
        document.getElementById("linkLoginPopup").addEventListener("focus",
            function(){
                modallog.querySelector("a").focus();
            });
    }

    document.body.style.overflow='none';
    closeNav("menu-login");

    if(toOpen=="registrazionecanvas")
        $('#registrationError').hide();
    if(toOpen=="logincanvas")
        $('#loginError').hide();
}
function closePopup(popup) {
    document.getElementById(popup).style.display='none';
    document.getElementById(popup).setAttribute("close", "close");
    if(popup=="registrazionecanvas")
        $('#registrationError').hide();
    if(popup=="logincanvas")
        $('#loginError').hide();
}

//mostrare la password premendo sull'occhiolino
function showpwd() {
    if (document.getElementById("logincanvas").style.display==="block") {
        var password = document.getElementById("loginPassword");
        var eye = document.getElementById("pwdeyelog");
    }
    else if (document.getElementById("registrazionecanvas").style.display==="block") {
        var password = document.getElementById("pwdreg");
        var eye = document.getElementById("pwdeyereg");
    }
    if (password.type === "password") {
        password.type = "text";
        eye.src = "img/hide.svg"
    }
    else {
        password.type = "password";
        eye.src = "img/view.svg"
    }
}
//mostrare la password premendo sull'occhiolino nel campo di password ripetuto
function showrepeatpwd() {
    var password = document.getElementById("pwd-repeat");
    var eye = document.getElementById("pwdeyeregrep");
    if (password.type === "password") {
        password.type = "text";
        eye.src = "img/hide.svg"
    }
    else {
        password.type = "password";
        eye.src = "img/view.svg"
    }
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modallog) {
        modallog.style.display = "none";
        document.body.style.overflow='auto';
    }
    if(event.target == modalreg) {
        modalreg.style.display = "none";
        document.body.style.overflow='auto';
    }
    if(event.target==darkener){
        closeNav('menu-login');
        closeNav('menu');
        $("#darkener").hide();

    }
};