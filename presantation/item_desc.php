<?php
session_start();
include_once("../master/sections/conntact.php");
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userId = $_SESSION['userid'];
    $commentDate = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO comments(comment,commentDate,userId,itemId)VALUES(?,?,?,?)");
    $stmt->execute([$comment, $commentDate, $userId, $itemId]);
    header("location:./user.php");
}
$catId = $_GET['catId'];
$stmt = $conn->query("SELECT catName FROM category WHERE catId = $catId")->fetchAll(PDO::FETCH_COLUMN);

$itemId = $_GET['item_id'];
$all_items = $conn->query("SELECT itemId,itemName,itemPrice,addedDate,countryMade,itemPhoto,catName,userName FROM ((
    items INNER JOIN category ON items.catId=category.catId )
          INNER JOIN users ON items.userId = users.userId)  WHERE item_active = 1 AND itemId = $itemId");
include_once("../master/sections/start.php");
include_once("../master/sections/linksUsers.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content"><?php echo $stmt[0]; ?></h1>
    <div class="data-content">
        <?php
        while ($row = $all_items->fetch()) :
        ?>
            <div class="itemDesc">
                <div class="imgDesc">
                    <img src="<?php echo $row['itemPhoto']; ?>" alt="">
                </div>
                <div class="bodyDesc">
                    <table>
                        <tr>
                            <td class="left">Item Name : </td>
                            <td class="right"><?php echo $row['itemName']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Item Price : </td>
                            <td class="right"><?php echo "$" . $row['itemPrice']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Added Data : </td>
                            <td class="right"><?php echo $row['addedDate']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Country Made : </td>
                            <td class="right"><?php echo $row['countryMade']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Catogery Name : </td>
                            <td class="right"><?php echo $row['catName']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">User Name : </td>
                            <td class="right"><?php echo $row['userName']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="addComment">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" style="display:none;" name="itemId" value="<?php echo $itemId; ?>">
                <textarea placeholder="Please Enter Your Comment..." name="comment" id="" cols="30" rows="5"></textarea>
                <input type="submit" value="Add Comment" />
            </form>
        </div>
        <?php
        $userId = $_SESSION['userid'];
        $all_comment = $conn->query("SELECT comment,commentDate,username,hireDate,itemName,itemPrice,addedDate FROM ((
                comments INNER JOIN users USING(userId))
                INNER JOIN items USING(itemId))
                WHERE comment_active = 1 AND comments.status = 1 AND comments.itemId=$itemId");
        while ($row = $all_comment->fetch()) :
        ?>
            <div class="comments">
                <div class="commentsDivision">
                    <table>
                        <tr>
                            <td class="left">Comment : </td>
                            <td class="right"><?php echo $row['comment']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Comment Date: </td>
                            <td class="right"><?php echo $row['commentDate']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="userDivision">
                    <table>
                        <tr>
                            <td class="left">Username : </td>
                            <td class="right"><?php echo $row['username']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Hire Date: </td>
                            <td class="right"><?php echo $row['hireDate']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="userDivision">
                    <table>
                        <tr>
                            <td class="left">Item Name : </td>
                            <td class="right"><?php echo $row['itemName']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Item Price: </td>
                            <td class="right"><?php echo "$" . $row['itemPrice']; ?></td>
                        </tr>
                        <tr>
                            <td class="left">Added Date: </td>
                            <td class="right"><?php echo $row['addedDate']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
    include_once("../master/sections/footUser.php"); ?>
    <?php include_once("../master/sections/end.php");
    ?>