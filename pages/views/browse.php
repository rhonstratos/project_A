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
        <div class="modal-content">
            <span class="close" onclick="modal.style.display = 'none';">&times;</span>
            <p>Add item to cart?</p>
            <input class="fit" type="button" value="Yes">
            <button class="fit" type="button" onclick="modal.style.display = 'none';">No</button>
        </div>
    </div>
</div>