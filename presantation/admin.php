<?php
session_start();
include_once("../master/sections/conntact.php");
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Dashboard</h1>
    <div class="data-content">
        <div class="widgets">
            <div class="wid widget1">
                <div class="title">Total Catogers</div>
                <div class="body">
                    <div><i class="fa fa-list-alt" aria-hidden="true"></i></div>
                    <div><a href="./catogeries.php"><?php
                                                    $count_cat = $conn->query("SELECT COUNT(catId) FROM category")->fetchAll(PDO::FETCH_COLUMN);
                                                    echo $count_cat[0];
                                                    ?></a></div>
                </div>
            </div>
            <div class="wid widget2">
                <div class="title">Total Items</div>
                <div class="body">
                    <div><i class="fa-solid fa-square-nfi"></i></div>
                    <div><a href="./items.php"><?php
                                                $count_items = $conn->query("SELECT COUNT(itemId) FROM items")->fetchAll(PDO::FETCH_COLUMN);
                                                echo $count_items[0];
                                                ?></a></div>
                </div>
            </div>
            <div class="wid widget3">
                <div class="title">Total Members</div>
                <div class="body">
                    <div><i class="fa-regular fa-address-card"></i></div>
                    <div><a href="./members.php"><?php
                                                    $total_members = $conn->query("SELECT COUNT(userId) FROM users WHERE user_active = 1")->fetchAll(PDO::FETCH_COLUMN);
                                                    echo $total_members[0];
                                                    ?></a></div>
                </div>
            </div>
            <div class="wid widget4">
                <div class="title">Total Admins</div>
                <div class="body">
                    <div><i class="fa-solid fa-lock"></i></div>
                    <div><a href="./members.php"><?php
                                                    $total_admins = $conn->query("SELECT COUNT(userId) FROM users WHERE user_active = 1 AND userType = 1")->fetchAll(PDO::FETCH_COLUMN);
                                                    echo $total_admins[0];
                                                    ?></a></div>
                </div>
            </div>
            <div class="wid widget5">
                <div class="title">Total Users</div>
                <div class="body">
                    <div><i class="fa-solid fa-user-tie"></i></div>
                    <div><a href="./members.php"><?php
                                                    $total_users = $conn->query("SELECT COUNT(userId) FROM users WHERE user_active = 1 AND userType = 0")->fetchAll(PDO::FETCH_COLUMN);
                                                    echo $total_users[0];
                                                    ?></a></div>
                </div>
            </div>
            <div class="wid widget6">
                <div class="title">Total Comments</div>
                <div class="body">
                    <div><i class="fa-solid fa-comment"></i></div>
                    <div><a href="./comments.php"><?php
                                                    $total_comments = $conn->query("SELECT COUNT(commentId) FROM comments WHERE comment_active = 1")->fetchAll(PDO::FETCH_COLUMN);
                                                    echo $total_comments[0];
                                                    ?></a></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>