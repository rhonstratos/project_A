function hide(event) {
    var span = event.target.getElementsByTagName("span");
    for (var element of span){
        element.style.visibility = "hidden";
    }
}
function unhide(event) {
    var span = event.target.getElementsByTagName("span");
    for (var element of span){
        element.style.visibility = "visible";
    }
}