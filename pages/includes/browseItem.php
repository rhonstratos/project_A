<div class="item-list row fit">
    <div class="card" onmouseover="unhide(event);" onmouseout="setTimeout(()=>{hide(event)},1000);">
        <div class="body">
            <img src="../assets/<?php echo $itemPic;  ?>" class="item-img" alt="item" width="100" height="200">
            <div class="pad-vertical-1">
                <span style="visibility: hidden;" class="text-center"><?php echo $itemName; ?></span>
                <span style="visibility: hidden;"><?php echo $itemDesc; ?></span>
                <span style="visibility: hidden;" class="text-center"><?php echo $itemPrice; ?></span>
            </div>
            <input value="Add to Cart" type="button" onclick="location.href='#'">
        </div>
    </div>
</div>