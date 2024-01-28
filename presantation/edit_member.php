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
    $userId = filter_var($_POST['userId'], FILTER_SANITIZE_SPECIAL_CHARS);;
    $userName = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $fullName = filter_var($_POST['fullname'], FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
    $hireDate = filter_var($_POST['hiredate'], FILTER_SANITIZE_SPECIAL_CHARS);
    $userType = filter_var($_POST['usertype'], FILTER_SANITIZE_SPECIAL_CHARS);
    $stmt = $conn->prepare("UPDATE users SET username = ? ,password = ? ,fullname = ?,email = ? ,hireDate = ? ,userType = ? WHERE userId = ? ");
    $stmt->execute([$userName, $password, $fullName, $email, $hireDate, $userType, $userId]);
    header("location:members.php");
}
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Members</h1>
    <?php
    $member_id = $_GET['memberId'];
    $mamber_info = $conn->query("SELECT * FROM users WHERE userid = $member_id")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="data-content">
        <div class="searchBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <div class="row">
                    <span>User Name : </span>
                    <input class="itemVal" style="display: none;" type="text" name="userId" value="<?php echo $mamber_info[0]['userId'];  ?>">
                    <input class="itemVal" type="text" name="username" value="<?php echo $mamber_info[0]['username'];  ?>">
                </div>
                <div class="row">
                    <span>Password : </span>
                    <input class="itemVal" type="password" name="password" value="<?php echo $mamber_info[0]['password'];  ?>">
                </div>
                <div class="row">
                    <span>Full Name : </span>
                    <input class="itemVal" type="text" name="fullname" value="<?php echo $mamber_info[0]['fullname'];  ?>">
                </div>
                <div class="row">
                    <span>Email : </span>
                    <input class="itemVal" type="email" name="email" value="<?php echo $mamber_info[0]['email'];  ?>">
                </div>
                <div class="row">
                    <span>Hire Date : </span>
                    <input class="itemVal" type="date" name="hiredate" value="<?php echo $mamber_info[0]['hireDate'];  ?>">
                </div>
                <div class="row">
                    <span>User Type : </span>
                    <select class="itemVal" name="usertype" id="">
                        <option value="1" <?php if ($mamber_info[0]['userType'] == 1) {
                                                echo "selected";
                                            } ?>>Admin</option>
                        <option value="0" <?php if ($mamber_info[0]['userType'] == 0) {
                                                echo "selected";
                                            } ?>>User</option>
                    </select>
                </div>
                <div class="row">
                    <button class="btn-save save"><i class="fa-regular fa-pen-to-square"></i> Update User</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/validate.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>