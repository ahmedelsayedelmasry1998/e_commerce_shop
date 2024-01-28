<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
$comment_id = $_GET['commentId'];
$status     = $_GET['status'];
if ($status == 0) {
    $stmt = $conn->prepare("UPDATE comments SET status = 1 WHERE commentId = $comment_id");
    $stmt->execute();
    header("location:comments.php");
} else if ($status == 1) {
    $stmt = $conn->prepare("UPDATE comments SET status = 0 WHERE commentId = $comment_id");
    $stmt->execute();
    header("location:comments.php");
} else {
    header("location:comments.php");
}
?>
<div class="masterContent">
    <h1 class="title-content">Comments</h1>
    <div class="data-content">

    </div>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>