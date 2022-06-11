function hide(event) {
    var span = event.target.getElementsByTagName("span");
    setTimeout(function () {
        for (var element of span) {
            element.style.display = "none";
        }
    }, 3000)

}
function unhide(event) {
    var span = event.target.getElementsByTagName("span");
    for (var element of span) {
        element.style.display = "block";
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
            let body = document.getElementById("browse")
            body.innerHTML = ''
            for (items of json) {
                body.innerHTML = `${body.innerHTML}
                <div class="card mx-5" style="width: 18rem;" id="${items.picture}" onmouseover="unhide(event);" onmouseout="hide(event);">
                    <img src="../assets/${items.picture}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span style="display: none;" class="text-center h5 wordBreak">${items.name}</span>
                        <br>
                        <span style="display: none;" class="p wordBreak">${items.description}</span>
                        <br>
                        <span style="display: none;" class="text-center wordBreak">${items.price}</span>
                        <br>
                        <button class="btn btn-primary" type="button" onclick="setCart('${items.picture}')">Add to Cart</button>
                    </div>
                </div>
                `
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
function updateInventoryItem(id) {
    let str = Array.from(id.split("|"))
    let modal = document.getElementById("UpdateInventoryModal")
    let itemInvName = document.getElementById("itemInventoryNameModal")
    let itemIvnPrice = document.getElementById("itemInventoryPriceModal")
    let itemIvnQuantity = document.getElementById("itemInventoryQuantityModal")
    let updateBtn = document.getElementById("invUpdate")
    updateBtn.setAttribute("category", str[3])
    itemInvName.value = str[0]
    itemIvnPrice.value = parseFloat(str[1].replaceAll(/[^\d.-]/g, ''))
    itemIvnQuantity.value = parseFloat(str[2])
    //modal.style.display = "block"
}
function updateInventoryModal() {
    let http = new XMLHttpRequest()
    let itemInvName = document.getElementById("itemInventoryNameModal").value
    let itemIvnPrice = document.getElementById("itemInventoryPriceModal").value
    let itemIvnQuantity = document.getElementById("itemInventoryQuantityModal").value
    let updateBtn = document.getElementById("invUpdate")
    let category = updateBtn.getAttribute("category")
    let params = "updateInventoryCart=true&itemName=" + itemInvName + "&itemPrice=" + itemIvnPrice + "&itemQuantity=" + itemIvnQuantity + "&Invcategory=" + category

    if (itemIvnQuantity < 1 || itemIvnPrice < 1)
        alert("Please enter avalid parameters and try again.")
    else {
        http.open("get", "../includes/config.php?" + params, true);
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                alert('Inventory Item Successfully Updated')
                location.reload()
            }
        };
        http.send();
    }
}
function deleteInventoryItem(id) {
    let deleteBtn = document.getElementById("itmDelete")
    deleteBtn.setAttribute("item", id + "")
    let modal = document.getElementById("DeleteInventoryModal")
    //modal.style.display = "block"
}
function deleteInventoryModal() {
    let http = new XMLHttpRequest()
    let deleteBtn = document.getElementById("itmDelete")
    let id = Array.from(deleteBtn.getAttribute("item").split("|"))
    let params = "deleteInventoryCart=true&itemName=" + id[0] + "&itemPrice=" + id[1] + "&itemQuantity=" + id[2] + "&Invcategory=" + id[3]

    http.open("get", "../includes/config.php?" + params, true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            alert('Inventory Item Successfully Deleted')
            location.reload()
        }
    };
    http.send();
}
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
                window.location.href = "./purchases.php"
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

    //console.log(span)

    modalName.readonly = false
    modalPrice.readonly = false
    modalName.value = itemName
    modalPrice.value = itemPrice
    modalName.readonly = true
    modalPrice.readonly = true
    //modal.style.display = "block"
}
function addToCart() {
    let http = new XMLHttpRequest()
    let itemName = document.getElementById("itemNameModal").value
    let itemPrice = document.getElementById("itemPriceModal").value
    let itemQuantity = document.getElementById("itemQuantityModal").value
    let user = document.getElementById("user").innerHTML.toLowerCase()
    let params = "addToCart=true&user=" + user + "&itemName=" + itemName + "&itemPrice=" + itemPrice + "&itemQuantity=" + itemQuantity

    if (parseFloat(itemQuantity) < 1) { alert("Please enter avalid quantity and try again.") }
    else {
        http.open("get", "../includes/config.php?" + params, true);
        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                alert('Item added to Card!')
            }
        };
        http.send();
    }
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
                alert('Update Successful')
                location.reload()
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
    //deleteModal.style.display = "block"
}
function deleteCheckoutModal(id) {
    let str = id.split("|")
    let http = new XMLHttpRequest()
    let user = document.getElementById("user").innerHTML.toLowerCase()
    let params = "?deleteCartItem=true&user=" + user + "&itemName=" + str[0] + "&itemPrice=" + str[1] + "&itemQuantity=" + str[2]

    http.open("get", "../includes/config.php" + params, true);
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            alert('Cart item successfully Deleted')
            location.reload()
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
function showInventory(event) {
    const id = event.target.value;
    document.getElementById("dark_chocolate").style.display = "none"
    document.getElementById("milk_chocolate").style.display = "none"
    document.getElementById("white_chocolate").style.display = "none"
    document.getElementById(id).style.display = "flex"
}