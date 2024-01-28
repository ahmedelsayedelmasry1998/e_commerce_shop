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
    $itemName = filter_var($_POST['itemName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_SPECIAL_CHARS);
    $country = filter_var($_POST['country'], FILTER_SANITIZE_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_SPECIAL_CHARS);
    $catParent = filter_var($_POST['parentItems'], FILTER_SANITIZE_SPECIAL_CHARS);
    $photo = $_FILES['upload_file'];
    $dis = dirname(__FILE__, 2) . "/uploads_files/" . $photo['name'];
    $imgPath = "../uploads_files/" . $photo['name'];
    move_uploaded_file($photo['tmp_name'], $dis);
    $stmt = $conn->prepare("INSERT INTO items (itemName,itemPrice,addedDate,countryMade,status,userId,catId,itemPhoto) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->execute([$itemName, $price, $date, $country, $status, $userId, $catParent, $imgPath]);
    header("location:items.php");
}
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Items</h1>
    <div class="data-content">
        <div class="searchBox">
            <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <div class="row">
                    <span>Item Name : </span>
                    <input class="itemVal" type="text" name="itemName" placeholder="Please Enter Item Name...">
                    <div class="resEmpty h-s">Please Enter Item Name</div>
                    <div class="resChar h-s">Please Item Name Must Be Less Than 4 Charcture And More Than 20 Characture</div>
                </div>
                <div class="row">
                    <span>Item Price : </span>
                    <input class="itemVal" type="number" name="price" placeholder="Please Enter Item Price...">
                    <div class="resEmpty h-s">Please Enter Item Price</div>
                    <div class="resChar h-s"></div>
                </div>
                <div class="row">
                    <span>Item Date : </span>
                    <input class="itemVal" type="date" name="date" placeholder="Please Enter Date Added...">
                    <div class="resEmpty h-s">Please Enter Item Date</div>
                    <div class="resChar h-s"></div>
                </div>
                <div class="row">
                    <span>Country Made : </span>
                    <input class="itemVal" type="text" name="country" placeholder="Please Enter Item Country Made...">
                    <div class="resEmpty h-s">Please Enter Item Country</div>
                    <div class="resChar h-s">Please Item Name Must Be Less Than 4 Charcture And More Than 20 Characture</div>
                </div>
                <div class="row">
                    <span>Status : </span>
                    <select class="itemVal" name="status" id="">
                        <option value="start">Please Your Status</option>
                        <option value="0">New</option>
                        <option value="1">Like New</option>
                        <option value="2">Used</option>
                        <option value="3">Very Used</option>
                    </select>
                    <div class="resEmpty h-s">Please Chooss Auther Item</div>
                    <div class="resChar h-s"></div>
                </div>
                <div class="row">
                    <span>Cotogeries : </span>
                    <select class="itemVal" name="parentItems" id="">
                        <?php
                        $all_cat = $conn->query("SELECT catId,catName from category WHERE cat_active = 1")->fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach ($all_cat as $key => $value) {
                            echo "<option value='$key'>" . $value . " </option>";
                        }
                        ?>
                    </select>
                    <div class="resEmpty h-s">Please Chooss Auther Item</div>
                    <div class="resChar h-s"></div>
                </div>
                <div class="row">
                    <span>Item Photo : </span>
                    <input type="file" name="upload_file" class="itemVal" />
                    <div class="resEmpty h-s">Please Enter Item Photo</div>
                    <div class="h-s" id="resImage">This File Isn,t Image</div>
                    <div class="resChar h-s"></div>
                </div>
                <div class="row">
                    <button class="btn-save save"><i class="fa-solid fa-plus"></i> Save Item</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/validate.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>