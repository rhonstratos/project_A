<div>
    <h1>Browse Items</h1>
    <div class="row text-center">
        <h2>by:</h2>
        <form action=".home" method="get">
            <select name="category" id="category">
                <option value="dark_chocolate">Dark Chocolate</option>
                <option value="milk_chocolate">Milk Chocolate</option>
                <option value="white_chocolate">White Chocolate</option>
            </select>
        </form>
    </div>
    <div class="grid" id="browse">
        <?php
        $shop = new Shop();
        $shop->fillShop();
        ?>
    </div>
</div>