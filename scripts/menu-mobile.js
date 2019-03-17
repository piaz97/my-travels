function openNav(myname) {
        document.getElementById(myname).style.width = "78%";
        $("#darkener").show();
}

function closeNav(myname) {
    document.getElementById(myname).style.width = null;
    $("#darkener").hide();
}
