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
    <h1 class="title-content">Categories</h1>
    <div class="data-content">
        <div class="searchBox">
            <div class="search">
                <input type="text" placeholder="Search..." name="" id="search">
            </div>
            <div class="add">
                <a href="add_cat.php">Add Catogery</a>
            </div>
        </div>
        <div id="containerDiv" class="allData">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Descraption</th>
                    <th>Child Item</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $userId = $_SESSION['userid'];
                $all_cat = $conn->query("SELECT * FROM category WHERE userid = '$userId' AND cat_active = 1");
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
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/catogires_search.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>