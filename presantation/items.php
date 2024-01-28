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
?>
<div class="masterContent">
    <h1 class="title-content">Items</h1>
    <div class="data-content">
        <div class="searchBox">
            <div class="search">
                <input type="text" placeholder="Search..." name="" id="search">
            </div>
            <div class="add">
                <a href="add_item.php">Add Items</a>
            </div>
        </div>
        <div id="containerDiv" class="allData">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Added Date</th>
                    <th>Country Made</th>
                    <th>Catogery</th>
                    <th>Item Photo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $userId = $_SESSION['userid'];
                $all_items = $conn->query("SELECT itemId,itemName,itemPrice,addedDate,countryMade,catName,itemPhoto FROM ((
                    items INNER JOIN category ON items.catId=category.catId )
                          INNER JOIN users ON items.userId = users.userId)  WHERE item_active = 1");
                while ($row = $all_items->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $row['itemName'] ?></td>
                        <td><?php echo $row['itemPrice'] . " L.E" ?></td>
                        <td><?php echo $row['addedDate'] ?></td>
                        <td><?php echo $row['countryMade'] ?></td>
                        <td><?php echo $row['catName'] ?></td>
                        <td><img src="<?php echo $row['itemPhoto'] ?>" class="img-thumbnail" /></td>
                        <td>
                            <form action="edit_item.php" method="GET">
                                <input type="hidden" name="itemId" value="<?php echo $row['itemId'] ?>">
                                <button class="btn-edit"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="del_item.php" method="GET">
                                <input type="hidden" name="itemId" value="<?php echo $row['itemId'] ?>">
                                <button class="btn-delete"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/item_search.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>