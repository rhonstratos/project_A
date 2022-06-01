function hide(event) {
    var span = event.target.getElementsByTagName("span");
    setTimeout(function () {
        for (var element of span) {
            element.style.visibility = "hidden";
        }
    },3000)

}
function unhide(event) {
    var span = event.target.getElementsByTagName("span");
    for (var element of span) {
        element.style.visibility = "visible";
    }
}
function resetBrowse() {
    document.getElementById("browse").innerHTML = ""
}
function fillBrowseByCategory() {
    var category = document.getElementById("category").value

    var http = new XMLHttpRequest()
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            resetBrowse()
            var xmlDocument = http.responseText;
            console.log(JSON.parse(xmlDocument))
            var obj = JSON.parse(xmlDocument)
            var json = obj.items
            for (items of json)
                console.log((items.picture))

            for (items of json) {
                var div = document.createElement("div")
                div.className = "item-list row fit"

                var div1 = document.createElement("div")
                div1.className = "card"
                div1.id = items.picture
                div1.onmouseover = unhide
                div1.onmouseout = hide

                var div2 = document.createElement("div")
                div2.className = "body"

                var img = document.createElement("img")
                img.src = "../assets/" + items.picture
                img.className = "item-img"
                img.alt = "item"
                img.width = 100
                img.height = 200

                var div3 = document.createElement("div")
                div3.className = "pad-vertical-1"

                var span1 = document.createElement("span")
                span1.style.visibility = "hidden"
                span1.id = "itemName"
                span1.className = "text-center"
                span1.innerHTML = items.name

                var span2 = document.createElement("span")
                span2.style.visibility = "hidden"
                span2.id = "itemDesc"
                span2.innerHTML = items.description

                var span3 = document.createElement("span")
                span3.style.visibility = "hidden"
                span3.id = "itemPrice"
                span3.className = "text-center"
                span3.innerHTML = items.price

                var button = document.createElement("button")
                button.innerHTML = "Add to Cart"
                button.type = "button"
                button.addEventListener("click",function(){setCart(items.picture)},false)

                div3.appendChild(span1)
                div3.appendChild(span2)
                div3.appendChild(span3)

                div2.appendChild(img)
                div2.appendChild(div3)
                div2.appendChild(button)

                div1.appendChild(div2)
                div.appendChild(div1)

                document.getElementById("browse").appendChild(div)
            }
        }
    };
    http.open("GET", "../includes/config.php?category=" + category, true);
    http.send();
}

// Get the modal
var modal = document.getElementById("myModal");
var modalName = document.getElementById("itemNameModal")
var modalPrice = document.getElementById("itemPriceModal")
function setCart(id) {
    var target = document.getElementById(id)
    var span = target.getElementsByTagName("span")
    var itemName = span[0].innerHTML
    var itemPrice = span[2].innerHTML

    modalName.readonly = false
    modalPrice.readonly = false
    modalName.value = itemName
    modalPrice.value = itemPrice
    modalName.readonly = true
    modalPrice.readonly = true
    modal.style.display = "block"
}
function addToCart(){
    var http = new XMLHttpRequest()
    let itemName = document.getElementById("itemNameModal").value
    let itemPrice = document.getElementById("itemPriceModal").value
    let itemQuantity = document.getElementById("itemQuantityModal").value
    let params = "addToCart=true&&itemName="+itemName+"&itemPrice="+itemPrice+"&itemQuantity="+itemQuantity
    console.log(params)
    
    http.open("get", "../includes/config.php?"+params, true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("modal2").style.display = "block"
        }
    };
    http.send();
}

function closeModal() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}