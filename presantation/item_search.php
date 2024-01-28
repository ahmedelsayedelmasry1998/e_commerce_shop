<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
$item_val = $_GET['q'];
?>
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
                          INNER JOIN users ON items.userId = users.userId)  WHERE item_active = 1 AND itemName LIKE('%$item_val%')");
    while ($row = $all_items->fetch()) :
    ?>
        <tr>
            <td><?php echo $row['itemName'] ?></td>
            <td><?php echo $row['itemPrice'] . " LE" ?></td>
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