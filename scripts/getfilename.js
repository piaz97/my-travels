function getFileName(image, text) {
    var path = document.getElementById(image).value;
    var filename = path.replace(/^.*\\/, "");
    document.getElementById(text).innerHTML = "immagine selezionata: " + filename;
}