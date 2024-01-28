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
$cat_id = $_GET['catId'];
$del_cat = $conn->prepare("UPDATE category SET cat_active = 0 WHERE catid = $cat_id");
$del_cat->execute();
header("location:catogeries.php");
?>
<div class="masterContent">
    <h1 class="title-content">Categories</h1>
    <div class="data-content">

    </div>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>