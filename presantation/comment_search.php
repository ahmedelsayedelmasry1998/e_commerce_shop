<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
$comment = $_GET['q'];
?>
<table>
    <tr>
        <th>Comments</th>
        <th>Comment Date</th>
        <th>Item Name</th>
        <th>User Name</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    $userId = $_SESSION['userid'];
    $all_comments = $conn->query("SELECT commentId,comment,commentDate,itemName,username FROM ((
                    comments INNER JOIN items USING(itemId))
                      INNER JOIN users ON comments.userId = users.userId)  WHERE comment_active = 1 AND comment LIKE('%$comment%')");
    while ($row = $all_comments->fetch()) :
    ?>
        <tr>
            <td><?php echo $row['comment'] ?></td>
            <td><?php echo $row['commentDate'] ?></td>
            <td><?php echo $row['itemName'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td>
                <form action="edit_comment.php" method="GET">
                    <input type="hidden" name="commentId" value="<?php echo $row['commentId']; ?>">
                    <button class="btn-edit"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                </form>
            </td>
            <td>
                <form action="del_comment.php" method="GET">
                    <input type="hidden" name="commentId" value="<?php echo $row['commentId']; ?>">
                    <button class="btn-delete"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>