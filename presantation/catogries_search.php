<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
$catogries_data = $_GET['q'];
?>
<table>
    <tr>
        <th>Name</th>
        <th>Descraption</th>
        <th>Parent</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    $userId = $_SESSION['userid'];
    $all_cat = $conn->query("SELECT * FROM category WHERE userid = '$userId' AND cat_active = 1 AND catName LIKE('%$catogries_data%')");
    while ($row = $all_cat->fetch()) :
    ?>
        <tr>
            <td><?php echo $row['catName'] ?></td>
            <td><?php echo $row['descraption'] ?></td>
            <td><?php echo $row['parentItem'] ?></td>
            <td>
                <form action="edit_cat.php" method="GET">
                    <input type="hidden" name="catId" value="<?php echo $row['catId'] ?>">
                    <button class="btn-edit"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                </form>
            </td>
            <td>
                <form action="del_cat.php" method="GET">
                    <input type="hidden" name="catId" value="<?php echo $row['catId'] ?>">
                    <button class="btn-delete"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>