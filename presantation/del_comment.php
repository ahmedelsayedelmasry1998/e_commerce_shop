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
$comment_id = $_GET['commentId'];
$del_comment = $conn->prepare("UPDATE comments SET comment_active = 0 WHERE commentId = $comment_id");
$del_comment->execute();
header("location:comments.php");
?>
<div class="masterContent">
    <h1 class="title-content">Categories</h1>
    <div class="data-content">

    </div>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>