<?php
class SearchUser
{
    private $path = "../data/users.xml";
    private $xml,$username,$password;
    public function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->xml = new DOMDocument("1.0");
        $this->xml->preserveWhiteSpace = true;
        $this->xml->formatOutput = true;
        $this->xml->load($this->path, LIBXML_NOBLANKS);
        $this->saveXML();
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
        $userUsernameNode = $save->createElement('username', $this->username);
        $userPasswordNode = $save->createElement('password', $this->password);
        $userNode = $save->createElement("user");

        $userNode->appendChild($userTypeNode);
        $userNode->appendChild($userUsernameNode);
        $userNode->appendChild($userPasswordNode);
        $save->getElementsByTagName('users')[0]->appendChild($userNode);
        $this->saveXML();
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
        $this->xml = new DOMDocument("1.0");
        $this->xml->preserveWhiteSpace = true;
        $this->xml->formatOutput = true;
        $this->xml->load($this->path, LIBXML_NOBLANKS);
        $this->saveXML();
    }
    private function saveXML()
    {
        return $this->xml->save($this->path);
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
            $itemQuantity = $targetNode->getElementsByTagName("quantity")[0]->nodeValue;
    ?>
                <tr>
                    <td><?php echo $itemName; ?></td>
                    <td><?php echo $itemPrice; ?></td>
                    <td><?php echo $itemQuantity; ?></td>
                    <td><input type="button" value="View" onclick="location.href='#'"></td>
                </tr>
    <?php
            }
        }
}
class Cart
{
    private $path = "../data/cart_items.xml";
    private $xml,$total;
    public function __construct()
    {
        $this->total = (float) "0";
        $this->xml = new DOMDocument("1.0");
        $this->xml->preserveWhiteSpace = true;
        $this->xml->formatOutput = true;
        $this->xml->load($this->path, LIBXML_NOBLANKS);
        $this->saveXML();
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
            if($targetNode->getElementsByTagName("owner")[0]->nodeValue == $user)
            {
                return $targetNode;
                break;
            }
        return NULL;
    }
    public function fillCart($user){
        $this->loadXML();
        $cartNode = $this->findCheckout($user);
        if(!is_null($cartNode))
        foreach($cartNode->getElementsByTagName("item") as $item){
            $name = $item->getElementsByTagName("name")[0]->nodeValue;
            $price = $item->getElementsByTagName("price")[0]->nodeValue;
            $quantity = $item->getElementsByTagName("quantity")[0]->nodeValue;
            $subtotal = $item->getElementsByTagName("subtotal")[0]->nodeValue;
            $this->total = $this->total + (float)$subtotal;
            ?>
            <tr>
                <td><?php echo $name; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $quantity; ?></td>
                <td><?php echo $subtotal; ?></td>
                <td><input type="button" value="Update" onclick="location.href='#'"></td>
                <td><input type="button" value="Cancel" onclick="location.href='#'"></td>
            </tr>
            <?php
        }
        else{
            ?>
            <tr><h2>Your cart is empty!</h2></tr>
            <?php
        }
    }
    public function getTotal(){
        return number_format($this->total,2);
    }
}
class Purchases
{
}
?>