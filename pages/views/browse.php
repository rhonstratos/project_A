<div class="text-center">
    <img class="w-100 rounded-3 mb-5" style="height: 500px !important;" src="https://cdn.discordapp.com/attachments/798061933567017002/984769957982269470/Welcome_to.png" alt="...">
    <h1 class="text-white">Browse Items</h1>
    <div class="d-flex text-center justify-content-center align-items-center">
        <select onchange="fillBrowseByCategory()" name="category" id="category" class="form-control w-25 me-3 text-center">
            <option value="" selected disabled>Filter By</option>
            <option value="dark_chocolate">Dark Chocolate</option>
            <option value="milk_chocolate">Milk Chocolate</option>
            <option value="white_chocolate">White Chocolate</option>
        </select>
        <button type="button" class="btn btn-primary" onclick="location.href='./home.php'">Reset Filter</button>
    </div>
    <div class="d-flex flex-row flex-wrap justify-content-evenly gap-5 my-5" id="browse">
        <?php
        $shop = new Shop();
        $shop->fillShop();
        ?>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content fit">
            <span class="close" onclick="closeAllModal();">&times;</span>
            <h2>Add item to cart?</h2>
            <input class="fit" type="text" name="itemNameModal" id="itemNameModal" placeholder="ItemName" readonly="readonly">
            <input class="fit" type="number" name="itemPriceModal" id="itemPriceModal" placeholder="Price" readonly="readonly">
            <input class="fit" type="number" name="itemQuantityModal" id="itemQuantityModal" placeholder="Quantity">
            <input class="fit" type="button" value="Yes" onclick="addToCart()">
            <button class="fit" type="button" onclick="closeAllModal();">No</button>
        </div>
    </div>
    <div id="modal2" class="modal">
        <!-- Modal content -->
        <div class="modal-content fit">
            <span class="close" onclick="closeAllModal();">&times;</span>
            <h2>Item added to cart!</h2>
            <button class="fit" type="button" onclick="closeAllModal();">Confirm</button>
        </div>
    </div>
</div>