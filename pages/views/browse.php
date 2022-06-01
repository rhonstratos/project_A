<div>
    <h1>Browse Items</h1>
    <div class="row text-center">
        <div class="fit pad-vertical-1">
            <select name="category" id="category">
                <option value="dark_chocolate">Dark Chocolate</option>
                <option value="milk_chocolate">Milk Chocolate</option>
                <option value="white_chocolate">White Chocolate</option>
            </select>
            <input type="button" value="Filter" onclick="fillBrowseByCategory()">
        </div>
    </div>
    <button id="myBtn">Open Modal</button>
    <div class="grid" id="browse">
        <?php
        $shop = new Shop();
        $shop->fillShop();
        ?>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content fit">
            <span class="close" onclick="modal.style.display = 'none';">&times;</span>
            <h2>Add item to cart?</h2>
            <input class="fit" type="text" name="itemNameModal" id="itemNameModal" placeholder="ItemName" readonly="readonly">
            <input class="fit" type="number" name="itemPriceModal" id="itemPriceModal" placeholder="Price" readonly="readonly">
            <input class="fit" type="number" name="itemQuantityModal" id="itemQuantityModal" placeholder="Quantity" >
            <input class="fit" type="button" value="Yes" onclick="addToCart()">
            <button class="fit" type="button" onclick="closeModal()">No</button>
        </div>
    </div>
    <div id="modal2" class="modal">
        <!-- Modal content -->
        <div class="modal-content fit">
            <span class="close" onclick="document.getElementById('modal2').style.display='none';">&times;</span>
            <h2>Item added to cart!</h2>
            <button class="fit" type="button" onclick="document.getElementById('modal2').style.display='none';closeModal()">Confirm</button>
        </div>
    </div>
</div>