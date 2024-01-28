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
?>
<div class="masterContent">
    <h1 class="title-content">Members</h1>
    <div class="data-content">
        <div class="searchBox">
            <div class="search">
                <input type="text" placeholder="Search..." name="" id="search">
            </div>
        </div>
        <div id="containerDiv" class="allData">
            <table class="customTable" style="font-size: 13px;">
                <tr>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Hire Date</th>
                    <th>User Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $all_users = $conn->query("SELECT * FROM users WHERE user_active = 1");
                while ($row = $all_users->fetch()) :
                ?>
                    <tr>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['password'] ?></td>
                        <td><?php echo $row['fullname'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['hireDate'] ?></td>
                        <td><?php
                            if ($row['userType'] == 1) {
                                echo "Admin";
                            } else {
                                echo "User";
                            }
                            ?></td>
                        <td>
                            <form action="edit_member.php" method="GET">
                                <input type="hidden" name="memberId" value="<?php echo $row['userId'] ?>">
                                <button class="customSizeFont btn-edit"><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                            </form>
                        </td>
                        <td>
                            <form action="del_member.php" method="GET">
                                <input type="hidden" name="memberId" value="<?php echo $row['userId'] ?>">
                                <button class="customSizeFont btn-delete"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/member_search.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>