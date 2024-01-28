<?php
session_start();
include_once("../master/sections/conntact.php");
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
include_once("../master/sections/start.php");
include_once("../master/sections/linksUsers.php");
include_once("../master/sections/mid.php");
$userId = $_SESSION['userid'];
$catId = $_GET['catId'];
$stmt = $conn->query("SELECT catName FROM category WHERE catId = $catId")->fetchAll(PDO::FETCH_COLUMN);
?>
<div class="masterContent">
    <h1 class="title-content"><?php echo $stmt[0]; ?></h1>
    <div class="data-content">
        <div class="itemsUser">
            <?php
            $all_items = $conn->query("SELECT itemId,itemName,itemPrice,addedDate,countryMade,itemPhoto,catName,userName FROM ((
                items INNER JOIN category ON items.catId=category.catId )
                      INNER JOIN users ON items.userId = users.userId)  WHERE item_active = 1 AND items.catId ='$catId' AND users.userId = '$userId' ");
            while ($row = $all_items->fetch()) :
            ?>
                <div class="contItem">
                    <div class="imgContent">
                        <img width="200" src="<?php echo $row['itemPhoto']; ?>" alt="">
                    </div>
                    <div class="bodyContent">
                        <h2><a href="item_desc.php?item_id=<?php echo $row['itemId']; ?>&catId=<?php echo $catId; ?>"><?php echo $row['itemName']; ?></a></h2>
                        <h2 class="price">$<?php echo $row['itemPrice']; ?></h2>
                        <h3>Country Made : <?php echo $row['countryMade']; ?></h3>
                        <h3>Username : <?php echo $row['userName']; ?></h3>
                        <h4>Added Date : <?php echo $row['addedDate']; ?></h4>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    include_once("../master/sections/footUser.php"); ?>
    <?php include_once("../master/sections/end.php");
    ?>