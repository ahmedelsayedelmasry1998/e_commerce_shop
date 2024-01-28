<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}

include_once("../master/sections/conntact.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $comment_id = filter_var($_POST['commentId'], FILTER_SANITIZE_SPECIAL_CHARS);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS);
    $stmt = $conn->prepare("UPDATE comments SET comment = ? WHERE commentId = ?");
    $stmt->execute([$comment, $comment_id]);
    header("location:comments.php");
}
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Comments</h1>
    <div class="data-content">
        <?php
        $comment_id = $_GET['commentId'];
        $get_comment = $conn->query("SELECT commentId,comment FROM ((
            comments INNER JOIN items USING(itemId))
              INNER JOIN users ON comments.userId = users.userId)  WHERE comment_active = 1 AND commentId = $comment_id")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="searchBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <input style="display: none;" type="text" name="commentId" value="<?php echo $get_comment[0]['commentId']; ?>">
                <div class="row">
                    <span>Comment : </span>
                    <input class="itemVal" type="text" name="comment" value="<?php echo $get_comment[0]['comment']; ?>">
                </div>
                <div class="row">
                    <button class="btn-save save"><i class="fa-regular fa-pen-to-square"></i> Update Comment</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <?php include_once("../master/sections/end.php");
    ?>