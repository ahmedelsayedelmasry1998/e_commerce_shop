<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}

include_once("../master/sections/conntact.php");
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
$item_id = $_GET['itemId'];
$del_item = $conn->prepare("UPDATE items SET item_active = 0 WHERE itemid = $item_id");
$del_item->execute();
header("location:items.php");
?>
<div class="masterContent">
    <h1 class="title-content">Categories</h1>
    <div class="data-content">

    </div>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>