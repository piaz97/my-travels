function selectProfileNavbar(indice){
    var list = document.getElementById("leftBarProfile").getElementsByTagName("li");
    list[indice].style.backgroundColor = "#035c6e";
}

$(document).ready(function() {
    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    if(sPage.includes("area_personale.php"))
        selectProfileNavbar(0);
    if(sPage.includes("miei_viaggi.php"))
        selectProfileNavbar(1);
    if(sPage.includes("miei_coupon.php"))
        selectProfileNavbar(2);
});