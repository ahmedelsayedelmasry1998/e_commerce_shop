<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}
if ($_SESSION['usertype'] != "admin") {
    header("location:logout.php");
}

include_once("../master/sections/conntact.php");
$userId = $_SESSION['userid'];
$getUserPass = $conn->query("SELECT password FROM users WHERE userId = $userId")->fetchAll(PDO::FETCH_COLUMN);
$json_data = json_encode($getUserPass);
file_put_contents("user_pass.json", $json_data);
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Dashboard</h1>
    <div class="data-content">
        <div class="searchBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <div class="row">
                    <span>Current Pssword : </span>
                    <input id="old-pass" type="password" placeholder="Please Enter Current Password...">
                </div>
                <div class="row h-s a">
                    <span>New Password : </span>
                    <input id="inp-pass1" type="password" name="pass" placeholder="Please Enter New Password...">
                </div>
                <div class="row h-s a">
                    <span>Retype Password : </span>
                    <input id="inp-pass2" type="password" placeholder="Please Enter Retype Password...">
                </div>
                <div class="row">
                    <div id="resault"></div>
                </div>
                <div id="btn-run" class="row h-s">
                    <button class="btn-save save"><i class="fa-solid fa-lock"></i> Change Password</button>
                </div>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $pass = $_POST['pass'];
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE userId = $userId");
                $stmt->execute([$pass]);
                header("location:logout.php");
            }
            ?>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php"); ?>
    <script src="../master/js/change_pass.js"></script>
    <?php include_once("../master/sections/end.php");
    ?>