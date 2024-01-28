<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Comments</h1>
    <div class="data-content">
        <div class="searchBox">
            <div class="search">
                <input type="text" placeholder="Search..." name="" id="search">
            </div>
        </div>
        <div id="containerDiv" class="allData">
            <table>
                <tr>
                    <th>Comments</th>
                    <th>Comment Date</th>
                    <th>Item Name</th>
                    <th>User Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Approvment</th>
                </tr>
                <?php
                $userId = $_SESSION['userid'];
                $all_comments = $conn->query("SELECT commentId,comment,commentDate,comments.status,itemName,username FROM ((
                    comments INNER JOIN items USING(itemId))
                      INNER JOIN users ON comments.userId = users.userId)  WHERE comment_active = 1");
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
                        <?php if ($row['status'] == 0) : ?>
                            <td>
                                <form action="updateStatus.php" method="GET">
                                    <input type="hidden" name="status" value="<?php echo $row['status']; ?>">
                                    <input type="hidden" name="commentId" value="<?php echo $row['commentId']; ?>">
                                    <button class="btn-approve"><i class="fa-solid fa-check"></i> Approve</button>
                                </form>
                            </td>
                        <?php else : ?>
                            <td>
                                <form action="updateStatus.php" method="GET">
                                    <input type="hidden" name="status" value="<?php echo $row['status']; ?>">
                                    <input type="hidden" name="commentId" value="<?php echo $row['commentId']; ?>">
                                    <button class="btn-approve"><i class="fa-solid fa-x"></i> Not Approve</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/comment_search.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>