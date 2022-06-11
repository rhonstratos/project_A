<div class="text-center">
    <img class="w-100 mb-5" style="height: 500px !important;" src="https://cdn.discordapp.com/attachments/798061933567017002/984769957982269470/Welcome_to.png" alt="...">
    <h1 class="text-white">Browse Items</h1>
    <div class="d-flex text-center justify-content-center align-items-center">
        <select onchange="fillBrowseByCategory()" name="category" id="category" class="form-control w-25 me-3 text-center">
            <option value="" selected disabled>Filter By</option>
            <option value="dark_chocolate">Dark Chocolate</option>
            <option value="milk_chocolate">Milk Chocolate</option>
            <option value="white_chocolate">White Chocolate</option>
        </select>
    </div>
    <div class="d-flex flex-row flex-wrap justify-content-evenly gap-5 my-5" id="browse">
        <?php
        $shop = new Shop();
        $shop->fillShop();
        ?>
    </div>
    <div class="modal fade" id="Add2Cart" tabindex="-1" aria-labelledby="Add2CartLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Add2CartLabel">Add Item to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Item Name</span>
                        <input class="form-control text-center" type="text" name="itemNameModal" id="itemNameModal" placeholder="ItemName" readonly="readonly">
                    </div>
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Price</span>
                        <input class="form-control text-center" type="number" name="itemPriceModal" id="itemPriceModal" placeholder="Price" readonly="readonly">
                    </div>
                    <div class="input-group my-3">
                        <span class="input-group-text" id="basic-addon1">Quantity</span>
                        <input class="form-control text-center" type="number" name="itemQuantityModal" id="itemQuantityModal" placeholder="Quantity">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="addToCart()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>