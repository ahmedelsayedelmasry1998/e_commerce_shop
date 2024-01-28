<div class="links">
    <div class="titleLinks">Ahmed Shop</div>
    <a class="act" href="<?php
                            if ($_SESSION['usertype'] == "admin") {
                                echo "./admin.php";
                            } else {
                                echo "./user.php";
                            }
                            ?>">Dashboard</a>
    <a href="./catogeries.php">Categories</a>
    <a href="./items.php">Items</a>
    <a href="./members.php">Members</a>
    <a href="comments.php">Comments</a>
</div>