function hide(event) {
    var span = event.target.getElementsByTagName("span");
    setTimeout(function () {
        for (var element of span) {
            element.style.visibility = "hidden";
        }
    }, 3000)

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
    let category = document.getElementById("category").value

    let http = new XMLHttpRequest()
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            resetBrowse()
            let xmlDocument = http.responseText;
            let obj = JSON.parse(xmlDocument)
            let json = obj.items
            for (items of json) {
                let div = document.createElement("div")
                div.className = "item-list row fit"

                let div1 = document.createElement("div")
                div1.className = "card"
                div1.id = items.picture
                div1.onmouseover = unhide
                div1.onmouseout = hide

                let div2 = document.createElement("div")
                div2.className = "body"

                let img = document.createElement("img")
                img.src = "../assets/" + items.picture
                img.className = "item-img"
                img.alt = "item"
                img.width = 100
                img.height = 200

                let div3 = document.createElement("div")
                div3.className = "pad-vertical-1"

                let span1 = document.createElement("span")
                span1.style.visibility = "hidden"
                span1.id = "itemName"
                span1.className = "text-center"
                span1.innerHTML = items.name

                let span2 = document.createElement("span")
                span2.style.visibility = "hidden"
                span2.id = "itemDesc"
                span2.innerHTML = items.description

                let span3 = document.createElement("span")
                span3.style.visibility = "hidden"
                span3.id = "itemPrice"
                span3.className = "text-center"
                span3.innerHTML = items.price

                let button = document.createElement("button")
                button.innerHTML = "Add to Cart"
                button.type = "button"
                button.addEventListener("click", function () { setCart(items.picture) }, false)

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
var modalQuantity = document.getElementById("itemQuantityModal")
function purchaseCart() {
    let total = parseFloat(document.getElementById("total").innerHTML.replaceAll(/[^\d.-]/g, ''))
    let payment = parseFloat(document.getElementById("payment").value)
    if (payment < total) {
        alert("Please enter a valid payment amount and try again.")
    }
    else if (payment >= total) {
        let http = new XMLHttpRequest()
        let user = document.getElementById("user").innerHTML.toLowerCase()
        let params = "purchaseCart=true&user=" + user + "&total=" + total + "&payment=" + payment
        http.open("get", "../includes/config.php?" + params, true);
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                alert("Payment Successful!")
                window.location.href = "./home.php"
            }
        };
        http.send();
    }
}
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
function addToCart() {
    let http = new XMLHttpRequest()
    let itemName = document.getElementById("itemNameModal").value
    let itemPrice = document.getElementById("itemPriceModal").value
    let itemQuantity = document.getElementById("itemQuantityModal").value
    let user = document.getElementById("user").innerHTML.toLowerCase()
    let params = "addToCart=true&user=" + user + "&itemName=" + itemName + "&itemCategory=" + "&itemPrice=" + itemPrice + "&itemQuantity=" + itemQuantity
    console.log(params)

    http.open("get", "../includes/config.php?" + params, true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("modal2").style.display = "block"
        }
    };
    http.send();
}
function showCheckoutModal(id) {
    var target = document.getElementById(id)
    var span = target.getElementsByTagName("td")
    var itemName = span[0].innerHTML
    var itemQuantity = span[2].innerHTML
    var itemPrice = span[1].innerHTML

    modalName.readonly = false
    modalPrice.readonly = false
    modalQuantity.readonly = false
    modalName.value = itemName
    modalPrice.value = itemPrice
    modalQuantity.value = itemQuantity
    modalName.readonly = true
    modalPrice.readonly = true
    modalQuantity.readonly = true
    document.getElementById("UpdateCheckoutModal").style.display = "block"
}
function updateCheckoutModal() {
    let http = new XMLHttpRequest()
    let itemName = document.getElementById("itemNameModal").value
    let itemQuantity = document.getElementById("itemQuantityModal").value
    let user = document.getElementById("user").innerHTML.toLowerCase()
    let params = "updateCartItem=true&user=" + user + "&itemName=" + itemName + "&itemQuantity=" + itemQuantity

    if (parseFloat(itemQuantity) < 1) {
        alert("Please enter a valid quantity and try again.")
    }
    else {
        http.open("get", "../includes/config.php?" + params, true);
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                document.getElementById("modal2").style.display = "block"
            }
        };
        http.send();
    }
}
function showDelete(id) {
    let itemName = id.split("|")
    document.getElementById("deletItemName").innerHTML = "Continue to Remove item [" + itemName[0] + "] from cart?"
    let deleteModal = document.getElementById("DeleteCheckoutModal")
    document.getElementById("itmDelete").onclick = function () { deleteCheckoutModal(id) }
    deleteModal.style.display = "block"
}
function deleteCheckoutModal(id) {
    let str = id.split("|")
    let http = new XMLHttpRequest()
    let user = document.getElementById("user").innerHTML.toLowerCase()
    let params = "?deleteCartItem=true&user=" + user + "&itemName=" + str[0] + "&itemPrice=" + str[1] + "&itemQuantity=" + str[2]

    http.open("get", "../includes/config.php" + params, true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            console.log(str[0])
            console.log(str[1])
            console.log(str[2])
            document.getElementById("modal3").style.display = "block"
        }
    };
    http.send();
}
function closeAllModal() {
    Array.from(document.getElementsByClassName("modal")).forEach(element => {
        element.style.display = "none"
    })
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}