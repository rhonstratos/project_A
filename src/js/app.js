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
function resetBrowse(){
    document.getElementById("browse").innerHTML=""
}
function fillBrowseByCategory(){
    var category = document.getElementById("category").value

    var http = new XMLHttpRequest()
    http.onreadystatechange = function(){
        if(http.readyState == 4 && http.status == 200)
        {
            resetBrowse()
            var xmlDocument = http.responseText;
            console.log(JSON.parse(xmlDocument))
            var obj = JSON.parse(xmlDocument)
            var json = obj.items
            for(items of json)
            console.log((items.picture))

            for (items of json){
                var div = document.createElement("div")
                div.className = "item-list row fit"

                var div1 = document.createElement("div")
                div1.className = "card"
                div1.onmouseover = unhide
                div1.onmouseout = setTimeout(()=>{hide(event)},1000)

                var div2 = document.createElement("div")
                div2.className = "body"

                var img = document.createElement("img")
                img.src = "../assets/"+items.picture
                img.className = "item-img"
                img.alt = "item"
                img.width = 100
                img.height = 200

                var div3 = document.createElement("div")
                div3.className = "pad-vertical-1"

                var span1 = document.createElement("span")
                span1.style.visibility="hidden"
                span1.className = "text-center"
                span1.innerHTML = items.name

                var span2 = document.createElement("span")
                span2.style.visibility="hidden"
                span2.innerHTML = items.description

                var span3 = document.createElement("span")
                span3.style.visibility="hidden"
                span3.className = "text-center"
                span3.innerHTML = items.price

                var input = document.createElement("input")
                input.value = "Add to Card"
                input.type = "button"
                input.onclick = location.href='#'

                div3.appendChild(span1)
                div3.appendChild(span2)
                div3.appendChild(span3)

                div2.appendChild(img)
                div2.appendChild(div3)
                div2.appendChild(input)

                div1.appendChild(div2)
                div.appendChild(div1)

                document.getElementById("browse").appendChild(div)
            }
        }
    };
    http.open("GET","../includes/config.php?category="+category,true);
    http.send();
}