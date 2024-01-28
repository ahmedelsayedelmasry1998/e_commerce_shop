<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
include_once("../master/sections/start.php");
include_once("../master/sections/linksUsers.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Dashboard</h1>
    <div class="data-content">
        <div class="chart">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div id="w1" class="h-s"><?php
                                    $count_cat = $conn->query("SELECT COUNT(catId) FROM category")->fetchAll(PDO::FETCH_COLUMN);
                                    echo $count_cat[0];
                                    ?></div>
        <div id="w2" class="h-s"><?php
                                    $count_items = $conn->query("SELECT COUNT(itemId) FROM items")->fetchAll(PDO::FETCH_COLUMN);
                                    echo $count_items[0];
                                    ?></div>
        <div id="w3" class="h-s"><?php
                                    $total_members = $conn->query("SELECT COUNT(userId) FROM users WHERE user_active = 1")->fetchAll(PDO::FETCH_COLUMN);
                                    echo $total_members[0];
                                    ?></div>
        <div id="w4" class="h-s"><?php
                                    $total_admins = $conn->query("SELECT COUNT(userId) FROM users WHERE user_active = 1 AND userType = 1")->fetchAll(PDO::FETCH_COLUMN);
                                    echo $total_admins[0];
                                    ?></div>
        <div id="w5" class="h-s"><?php
                                    $total_users = $conn->query("SELECT COUNT(userId) FROM users WHERE user_active = 1 AND userType = 0")->fetchAll(PDO::FETCH_COLUMN);
                                    echo $total_users[0];
                                    ?></div>
        <div id="w6" class="h-s"><?php
                                    $total_comments = $conn->query("SELECT COUNT(commentId) FROM comments WHERE comment_active = 1")->fetchAll(PDO::FETCH_COLUMN);
                                    echo $total_comments[0];
                                    ?></div>
    </div>
    <?php
    include_once("../master/sections/footUser.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'doughnut', //doughnut,pie
            data: {
                labels: ['Total Catogers', 'Total Items', 'Total Members', 'Total Admins', 'Total Users', 'Total Comments'],
                datasets: [{
                    label: 'E Commerce Shop',
                    data: [document.getElementById("w1").innerHTML, document.getElementById("w2").innerHTML, document.getElementById("w3").innerHTML, document.getElementById("w4").innerHTML, document.getElementById("w5").innerHTML, document.getElementById("w6").innerHTML],
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
    <?php include_once("../master/sections/end.php");
    ?>