<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}
include_once("../master/sections/conntact.php");
$member_data = $_GET['q'];
?>
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
    $all_users = $conn->query("SELECT * FROM users WHERE user_active = 1 AND username LIKE('%$member_data%')");
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