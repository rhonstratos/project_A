<?php
class LocalXML
{
    private $xml;
    public function __construct($path)
    {
        $this->xml = new DOMDocument("1.0");
        $this->xml->preserveWhiteSpace = true;
        $this->xml->formatOutput = true;
        $this->xml->load($path, LIBXML_NOBLANKS);
        $this->xml->save($path);
    }
    public function getXML()
    {
        return $this->xml;
    }
    public function saveFormat($path)
    {
        $this->xml->load($path, LIBXML_NOBLANKS);
        $this->xml->save($path);
    }
}
class SearchUser
{
    private $path = "../data/users.xml";
    private $xml, $username, $password;
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->xml = new LocalXML($this->path);
        $this->xml = $this->xml->getXML();
    }
    private function saveXML()
    {
        return $this->xml->save($this->path);
    }
    private function loadXML()
    {
        return $this->xml->load($this->path);
    }
    public function search()
    {
        $this->loadXML();
        foreach ($this->xml->getElementsByTagName('user') as $node) {
            $getUsername = $node->getElementsByTagName('username')[0]->nodeValue;
            $getPassword = $node->getElementsByTagName('password')[0]->nodeValue;
            if ($getUsername == $this->username && $getPassword == $this->password) {
                $getUserType = $node->getElementsByTagName('type')[0]->nodeValue;
                if ($getUserType == 'admin') {
                    return true;
                } else if ($getUserType == 'user') {
                    return false;
                }
                break;
            }
        }
        return null;
    }
    public function register()
    {
        $this->loadXML();
        $save = $this->xml;
        $userTypeNode = $save->createElement('type', 'user');
        $userUsernameNode = $save->createElement('username', strtolower($this->username));
        $userPasswordNode = $save->createElement('password', strtolower($this->password));
        $userNode = $save->createElement("user");

        $userNode->appendChild($userTypeNode);
        $userNode->appendChild($userUsernameNode);
        $userNode->appendChild($userPasswordNode);
        $save->getElementsByTagName('users')[0]->appendChild($userNode);
        $this->saveXML();

        $initCart = new Cart();
        $initTransac = new Transactions();

        $initCart->initCart($this->username);
        $initTransac->initTransac($this->username);
    }
}
class Shop
{
    private $path = "../data/inventory.xml";
    private $xml;
    public function __construct()
    {
        $this->xml = new LocalXML($this->path);
        $this->xml = $this->xml->getXML();
    }
    private function loadXML()
    {
        return $this->xml->load($this->path);
    }
    public function filterByCategory($category)
    {
        $this->loadXML();
        $cat = "";
        switch ($category) {
            case "dark_chocolate":
                $cat = "darkChocolates";
                break;
            case "milk_chocolate":
                $cat = "milkChocolates";
                break;
            case "white_chocolate":
                $cat = "whiteChocolates";
                break;
        }
        $node = $this->xml->getElementsByTagName($cat)[0]->getElementsByTagName("item");
        $arr = array();
        foreach ($node as $targetNode) {
            $itemName = $targetNode->getElementsByTagName("name")[0]->nodeValue;
            $itemDesc = $targetNode->getElementsByTagName("description")[0]->nodeValue;
            $itemPrice = $targetNode->getElementsByTagName("price")[0]->nodeValue;
            $itemPic = $targetNode->getElementsByTagName("picture")[0]->nodeValue;
            array_push($arr, array("name" => $itemName, "description" => $itemDesc, "price" => $itemPrice, "picture" => $itemPic));
        }
        $array = array("items" => $arr);
        return json_encode($array);
    }
    public function search($search)
    {
        return "node";
    }
    public function fillShop($search = NULL, $category = NULL)
    {
        $this->loadXML();
        $node = $this->xml->getElementsByTagName("item");
        foreach ($node as $targetNode) {
            $itemName = $targetNode->getElementsByTagName("name")[0]->nodeValue;
            $itemDesc = $targetNode->getElementsByTagName("description")[0]->nodeValue;
            $itemPrice = $targetNode->getElementsByTagName("price")[0]->nodeValue;
            $itemPic = $targetNode->getElementsByTagName("picture")[0]->nodeValue;
            #if(){}

?>
            <div class="item-list row fit">
                <div class="card" id="<?php echo $itemPic;  ?>" onmouseover="unhide(event);" onmouseout="hide(event);">
                    <div class="body">
                        <img src="../assets/<?php echo $itemPic;  ?>" class="item-img" alt="item" width="100" height="200">
                        <div class="pad-vertical-1">
                            <span style="visibility: hidden;" class="text-center"><?php echo $itemName; ?></span>
                            <span style="visibility: hidden;"><?php echo $itemDesc; ?></span>
                            <span style="visibility: hidden;" class="text-center"><?php echo $itemPrice; ?></span>
                        </div>
                        <button type="button" onclick="setCart('<?php echo $itemPic;  ?>')">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
class User
{
    private $admin;
    private $user;
    public function __construct()
    {
        if (isset($_SESSION["ADMIN"]))
            $this->admin = $_SESSION["ADMIN"];
        if (isset($_SESSION["USER"]))
            $this->user = $_SESSION["USER"];
    }
    public function getUser()
    {
        if (empty($this->admin))
            return $this->user;
        else if (empty($this->user))
            return $this->admin;
    }
}
class Inventory
{
    private $path = "../data/inventory.xml";
    private $xml;
    public function __construct()
    {
        $this->xml = new LocalXML($this->path);
        $this->xml = $this->xml->getXML();
    }
    private function loadXML()
    {
        return $this->xml->load($this->path);
    }
    public function loadInventory($targetInventory)
    {
        $this->loadXML();
        $node = $this->xml->getElementsByTagName($targetInventory)[0]->getElementsByTagName("item");
        foreach ($node as $targetNode) {
            $itemName = $targetNode->getElementsByTagName("name")[0]->nodeValue;
            #$itemDesc = $targetNode->getElementsByTagName("description")[0]->nodeValue;
            #$itemImg = $targetNode->getElementsByTagName("picture")[0]->nodeValue;
            $itemPrice = $targetNode->getElementsByTagName("price")[0]->nodeValue;
            $itemPrice = number_format($itemPrice, 2);
            $itemQuantity = $targetNode->getElementsByTagName("quantity")[0]->nodeValue;
            $id = "$itemName|$itemPrice|$itemQuantity|$targetInventory";
        ?>
            <tr id="<?php echo $id; ?>">
                <td><?php echo $itemName; ?></td>
                <td><?php echo $itemQuantity; ?></td>
                <td><button type="button" onclick="updateInventoryItem('<?php echo $id; ?>')">Update</button></td>
                <td><button type="button" onclick="deleteInventoryItem('<?php echo $id; ?>')">Delete</button></td>
            </tr>
        <?php
        }
    }
    public function updateInventoryItem($itemName, $itemPrice, $itemQuantity,$category)
    {
        $this->loadXML();
        $node = $this->xml->getElementsByTagName($category)[0]->getElementsByTagName("item");
        foreach ($node as $targetNode) {
            $name = $targetNode->getElementsByTagName("name")[0]->nodeValue;
            if ($name == $itemName) {
                $targetNode->getElementsByTagName("name")[0]->nodeValue = $itemName;
                $targetNode->getElementsByTagName("price")[0]->nodeValue = number_format($itemPrice,2);
                $targetNode->getElementsByTagName("quantity")[0]->nodeValue = $itemQuantity;
                $this->xml->save($this->path);
                break;
            }
        }
    }
    public function deleteInventoryItem($itemName, $itemPrice, $itemQuantity,$category){
        $this->loadXML();
        $node = $this->xml->getElementsByTagName($category)[0]->getElementsByTagName("item");
        foreach ($node as $targetNode) {
            $name = $targetNode->getElementsByTagName("name")[0]->nodeValue;
            $price = $targetNode->getElementsByTagName("price")[0]->nodeValue;
            $quantity = $targetNode->getElementsByTagName("quantity")[0]->nodeValue;
            if ($name == $itemName && $price == $itemPrice && $quantity == $itemQuantity) {
                $targetNode->parentNode->removeChild($targetNode);
                $this->xml->save($this->path);
                break;
            }
        }
    }
}
class Cart
{
    private $path = "../data/cart_items.xml";
    private $xml, $total;
    public function __construct()
    {
        $this->xml = new LocalXML($this->path);
        $this->xml = $this->xml->getXML();
    }
    public function initCart($username)
    {
        $this->loadXML();
        $node = $this->xml->getElementsByTagName("carts")[0];
        $cartNode = $this->xml->createElement("cart");
        $ownerNode = $this->xml->createElement("owner", $username);
        $cartNode->appendChild($ownerNode);
        $cartNode->appendChild($this->xml->createElement("items"));
        $node->appendChild($cartNode);
        $this->xml->save($this->path);
    }
    private function saveXML()
    {
        return $this->xml->save($this->path);
    }
    private function loadXML()
    {
        return $this->xml->load($this->path);
    }
    private function findCheckout($user)
    {
        $this->loadXML();
        $node = $this->xml->getElementsByTagName("cart");
        foreach ($node as $targetNode)
            if ($targetNode->getElementsByTagName("owner")[0]->nodeValue == $user) {
                return $targetNode;
                break;
            }
        return NULL;
    }
    public function fillCart($user)
    {
        $this->loadXML();
        $cartNode = $this->findCheckout($user);
        if (!is_null($cartNode))
            foreach ($cartNode->getElementsByTagName("item") as $item) {
                $name = $item->getElementsByTagName("name")[0]->nodeValue;
                $price = $item->getElementsByTagName("price")[0]->nodeValue;
                $quantity = $item->getElementsByTagName("quantity")[0]->nodeValue;
                $subtotal = $item->getElementsByTagName("subtotal")[0]->nodeValue;
                $id = "$name|$price|$quantity";
                $this->total = $this->total + (float)$subtotal;
        ?>
            <tr id="<?php echo $id; ?>">
                <td><?php echo $name; ?></td>
                <td><?php echo number_format($price, 2); ?></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo number_format($subtotal, 2); ?></td>
                <td><input type="button" value="Update" onclick="showCheckoutModal('<?php echo $id; ?>')"></td>
                <td><input type="button" value="Cancel" onclick="showDelete('<?php echo $id; ?>')"></td>
            </tr>
        <?php
            }
        else {
        ?>
            <tr>
                <h2>Your cart is empty!</h2>
            </tr>
        <?php
        }
    }
    public function getTotal()
    {
        return number_format($this->total, 2);
    }
    public function updateCart($user, $itemName, $itemQuantity)
    {
        $this->loadXML();
        $node = $this->findCheckout($user)->getElementsByTagName("item");
        foreach ($node as $targetNode) {
            if ($targetNode->getElementsByTagName("name")[0]->nodeValue == $itemName) {
                #echo $targetNode->getElementsByTagName("name")[0]->nodeValue;
                $price = $targetNode->getElementsByTagName("price")[0]->nodeValue;
                $targetNode->getElementsByTagName("quantity")[0]->nodeValue = $itemQuantity;
                $targetNode->getElementsByTagName("subtotal")[0]->nodeValue = (float)$price * (float)$itemQuantity;
                break;
            }
        }
        $this->saveXML();
    }
    public function deleteCart($user, $itemName, $itemPrice, $itemQuantity)
    {
        $this->loadXML();
        $node = $this->findCheckout($user)->getElementsByTagName("item");
        foreach ($node as $targetNode) {
            #echo $targetNode->getElementsByTagName("name")[0]->nodeValue." | ".$itemName . "<br>";
            #echo $targetNode->getElementsByTagName("price")[0]->nodeValue." | ".$itemPrice . "<br>";
            #echo $targetNode->getElementsByTagName("quantity")[0]->nodeValue." | ".$itemQuantity;
            if (
                $targetNode->getElementsByTagName("name")[0]->nodeValue == $itemName &&
                $targetNode->getElementsByTagName("price")[0]->nodeValue == $itemPrice &&
                $targetNode->getElementsByTagName("quantity")[0]->nodeValue == $itemQuantity
            ) {
                $targetNode->parentNode->removeChild($targetNode);
                $this->saveXML();
                echo "deleted";
                break;
            }
        }
    }
    public function addToCart($user, $itemName, $itemPrice, $itemQuantity)
    {
        $this->loadXML();
        $cartOwner = $this->findCheckout($user);

        $item = $this->xml->createElement('item');
        $name = $this->xml->createElement('name', $itemName);
        $price = $this->xml->createElement('price', (float)$itemPrice);
        $quantity = $this->xml->createElement('quantity', (float)$itemQuantity);
        $subTotal = $this->xml->createElement('subtotal', (float)$itemPrice * (float)$itemQuantity);
        $item->appendChild($name);
        $item->appendChild($price);
        $item->appendChild($quantity);
        $item->appendChild($subTotal);
        $cartOwner->getElementsByTagName('items')[0]->appendChild($item);
        $this->saveXML();
        $this->loadXML();
    }
    public function purchaseCart($user, $total, $payment,)
    {
        $this->loadXML();
        $owner = $this->findCheckout($user);
        $cloneNode = $owner->getElementsByTagName("items")[0]->cloneNode(true);
        $transac = new Transactions();
        $transac->saveRecord($user, $total, $payment, $cloneNode);
        $deleteNode = $owner->getElementsByTagName("items")[0];
        $owner->removeChild($deleteNode);
        $this->saveXML();
        $this->loadXML();
        $owner = $this->findCheckout($user);
        $owner->appendChild(new DOMElement("items"));
        $this->saveXML();
        $this->loadXML();
    }
}
class Transactions
{
    private $xml, $path = "../data/transaction_records.xml";
    public function __construct()
    {
        $this->xml = new LocalXML($this->path);
        $this->xml = $this->xml->getXML();
    }

    private function findOwner($user)
    {
        $node = $this->xml->getElementsByTagName("owner");
        foreach ($node as $targetNode) {
            if ($targetNode->getElementsByTagName("name")[0]->nodeValue == $user) {
                return $targetNode;
                break;
            }
        }
        return NULL;
    }

    public function saveRecord($user, $total, $payment, $itemsNode)
    {
        $node = $this->findOwner($user)->getElementsByTagName("purchases")[0];
        $purchaseNode = $this->xml->createElement("purchase");
        $dateNode = $this->xml->createElement("date", date("Y-m-d", time()));
        $purchaseNode->appendChild($dateNode);
        $purchaseNode->appendChild($this->xml->importNode($itemsNode, true));
        $purchaseNode->appendChild($this->xml->createElement("total", $total));
        $purchaseNode->appendChild($this->xml->createElement("payment", $payment));
        $node->appendChild($purchaseNode);
        $this->xml->save($this->path);
    }
    public function initTransac($username)
    {
        $node = $this->xml->getElementsByTagName("purchaseHistory")[0];
        $transacNode = $this->xml->createElement("owner");
        $ownerNode = $this->xml->createElement("name", $username);
        $transacNode->appendChild($ownerNode);
        $transacNode->appendChild($this->xml->createElement("purchases"));
        $node->appendChild($transacNode);
        $this->xml->save($this->path);
    }
    public function fillPurchases($user)
    {
        $node = $this->findOwner($user)->getElementsByTagName("purchase");
        foreach ($node as $targetNode) {
            $date = $targetNode->getElementsByTagName("date")[0]->nodeValue;
            $total = $targetNode->getElementsByTagName("total")[0]->nodeValue;
            $payment = $targetNode->getElementsByTagName("payment")[0]->nodeValue;
        ?>
            <div class="fit ">
                <h2><?php echo $date; ?></h2>
                <h4 style="margin:0px auto;">Total: PHP <?php echo $total; ?></h4>
                <h4 style="margin-top:10px;">Payment: PHP <?php echo $payment; ?></h4>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($targetNode->getElementsByTagName("item") as $item) {
                            $name = $item->getElementsByTagName("name")[0]->nodeValue;
                            $price = $item->getElementsByTagName("price")[0]->nodeValue;
                            $quantity = $item->getElementsByTagName("quantity")[0]->nodeValue;
                            $subtotal = $item->getElementsByTagName("subtotal")[0]->nodeValue;

                        ?>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $subtotal; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php
        }
    }
}

#AJAX GET REQUEST CATCHERS
if (isset($_GET['category'])) {
    $cat = new Shop();
    echo $cat->filterByCategory($_GET['category']);
}

if (isset($_GET['addToCart'])) {
    $cart = new Cart();
    $cart->addToCart($_GET['user'], $_GET['itemName'], $_GET['itemPrice'], $_GET['itemQuantity']);
}

if (isset($_GET['purchaseCart'])) {
    $purchase = new Cart();
    $purchase->purchaseCart($_GET['user'], $_GET['total'], $_GET['payment']);
}

if (isset($_GET['updateCartItem'])) {
    $cart = new Cart();
    $cart->updateCart($_GET['user'], $_GET['itemName'], $_GET['itemQuantity']);
}

if (isset($_GET['deleteCartItem'])) {
    $cart = new Cart();
    $cart->deleteCart($_GET['user'], $_GET['itemName'], $_GET['itemPrice'], $_GET['itemQuantity']);
}

if (isset($_GET['updateInventoryCart'])) {
    $inventory = new Inventory();
    $inventory->updateInventoryItem($_GET['itemName'], $_GET['itemPrice'], $_GET['itemQuantity'], $_GET['Invcategory']);
}

if (isset($_GET['deleteInventoryCart'])) {
    $inventory = new Inventory();
    $inventory->deleteInventoryItem($_GET['itemName'], $_GET['itemPrice'], $_GET['itemQuantity'], $_GET['Invcategory']);
}
