<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}

include_once("../master/sections/conntact.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userId = $_SESSION['userid'];
    $item_id = filter_var($_POST['itemId'], FILTER_SANITIZE_SPECIAL_CHARS);
    $itemName = filter_var($_POST['itemName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS);
    $country = filter_var($_POST['country'], FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_SPECIAL_CHARS);
    $catParent = filter_var($_POST['parentItems'], FILTER_SANITIZE_SPECIAL_CHARS);
    $stmt = $conn->prepare("UPDATE items SET itemName = ?,itemPrice = ? ,addedDate = ? ,countryMade = ? ,status = ?,catId = ? WHERE itemId = ?");
    $stmt->execute([$itemName, $price, $date, $country, $status, $catParent, $item_id]);
    header("location:items.php");
}
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Items</h1>
    <div class="data-content">
        <?php
        $item_id = $_GET['itemId'];
        $get_item = $conn->query("SELECT itemId,itemName,itemPrice,addedDate,countryMade,status,catName FROM ((
            items INNER JOIN category ON items.catId=category.catId )
                  INNER JOIN users ON items.userId = users.userId)  WHERE item_active = 1 AND itemId = $item_id")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="searchBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <input style="display: none;" type="text" name="itemId" value="<?php echo $get_item[0]['itemId']; ?>">
                <div class="row">
                    <span>Item Name : </span>
                    <input class="itemVal" type="text" name="itemName" value="<?php echo $get_item[0]['itemName']; ?>">
                </div>
                <div class="row">
                    <span>Item Price : </span>
                    <input class="itemVal" type="number" name="price" value="<?php echo $get_item[0]['itemPrice']; ?>">
                </div>
                <div class="row">
                    <span>Item Date : </span>
                    <input class="itemVal" type="date" name="date" value="<?php echo $get_item[0]['addedDate']; ?>">
                </div>
                <div class="row">
                    <span>Country Made : </span>
                    <input class="itemVal" type="text" name="country" value="<?php echo $get_item[0]['countryMade']; ?>">
                </div>
                <div class="row">
                    <span>Status : </span>
                    <select class="itemVal" name="status" id="">
                        <option <?php if ($get_item[0]['status'] == 0) {
                                    echo "selected";
                                } ?> value="0">New</option>
                        <option value="1">Like New</option>
                        <option value="2">Used</option>
                        <option value="3">Very Used</option>
                    </select>
                </div>
                <div class="row">
                    <span>Cotogeries : </span>
                    <select class="itemVal" name="parentItems" id="">
                        <?php
                        $catSelected = $get_item[0]['catName'];
                        $all_cat = $conn->query("SELECT catId,catName from category WHERE cat_active = 1")->fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach ($all_cat as $key => $value) { ?>
                            <option <?php
                                    if ($get_item[0]['catName'] == $value) {
                                        echo "selected";
                                    }
                                    ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <button class="btn-save save"><i class="fa-regular fa-pen-to-square"></i> Update Item</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <?php include_once("../master/sections/end.php");
    ?>