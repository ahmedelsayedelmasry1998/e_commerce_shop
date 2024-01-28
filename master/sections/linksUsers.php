<div class="links">
    <div class="titleLinks">Ahmed Shop</div>
    <a class="act" href="<?php
                            if ($_SESSION['usertype'] == "admin") {
                                echo "./admin.php";
                            } else {
                                echo "./user.php";
                            }
                            ?>">Dashboard</a>
    <?php
    $all_cat = $conn->query("SELECT catId,catName FROM category WHERE cat_active = 1");
    while ($row = $all_cat->fetch()) :
    ?>
        <a href="./itemsUser.php?catId=<?php echo $row['catId']; ?>"><?php echo $row['catName']; ?></a>
    <?php endwhile; ?>
</div>