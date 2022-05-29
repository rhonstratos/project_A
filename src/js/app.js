function hide(event) {
    var span = event.target.getElementsByTagName("span");
    for (var element of span){
        element.style.display = "none";
    }
}
function unhide(event) {
    var span = event.target.getElementsByTagName("span");
    for (var element of span){
        element.style.display = "block";
    }
}