function showDiv(target){
    if(target.style.display === "none"){
        target.style.display = "flex";
    }
    else
        target.style.display = "none";
}

function loadFile(event) {
    //mostra la scritta "anteprima"
    document.getElementById("anteprimaFoto").style.display = "block";
    //prendo il div contenitore della foto
    const divOutput = document.getElementById('output');
    if(divOutput.getElementsByTagName("img").length!==0){
        divOutput.getElementsByTagName("img").item(0).src = URL.createObjectURL(event.target.files[0]);
    }
    else{
        const photo = document.createElement("img");
        photo.setAttribute("src", URL.createObjectURL(event.target.files[0]));
        photo.setAttribute("alt", "anteprima della nuova foto profilo");
        divOutput.appendChild(photo);
    }

}