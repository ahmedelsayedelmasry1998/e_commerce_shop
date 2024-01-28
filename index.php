<?php
session_start();
include_once("./master/sections/conntact.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="descraption" content="This Site To E Commerce Shop" />
    <meta name="author" content="Ahmed Elmasry" />
    <meta name="keywords" content="Ahmed Elmasry,ahmed elmasry,e commerce shop,E Commerce Shop" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E Commerce Shop</title>
    <link rel="stylesheet" href="./master/css/all.css" />
    <link rel="stylesheet" href="./master/css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="./master/css/main.css" /> -->
    <link rel="stylesheet" href="./master/css/logAndRigaster.css" />
</head>

<body>
    <div class="logContainer">
        <header>
            Ahmed Shop
        </header>
        <div class="content">
            <h2><span id="log" class="act">Login</span> | <span id="reg">Registar</span></h2>
            <div class="login">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="login" style="display: none;">
                    <input type="text" name="username" placeholder="Please Enter Username...">
                    <input type="password" name="password" placeholder="Please Enter Password...">
                    <input type="submit" value="Send">
                </form>
            </div>
            <div class="registar">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="registarForm">
                    <input type="text" name="registar" style="display: none;">
                    <input type="text" name="username" placeholder="Please Enter Username...">
                    <input type="password" name="password" placeholder="Please Enter Password...">
                    <input type="text" name="fullname" placeholder="Please Enter Fullname...">
                    <input type="email" name="email" placeholder="Please Enter Email...">
                    <input type="date" name="hiredate" placeholder="Please Enter Hiredate...">
                    <select name="userType" id="">
                        <option value=""> --- Please Choose Usertype --- </option>
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                    </select>
                    <input type="submit" value="Registar">
                </form>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (isset($_POST['login'])) {
                    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
                    if (empty($username) || empty($password)) {
                        echo "<div class='error'>Please Enter All Data</div>";
                    } else {
                        $oopUserTable = new OopECommercShop($username, $password);
                        if (count($oopUserTable->fetchUser()) > 0) {
                            if ($oopUserTable->fetchUser()[0]['userType'] == 1) {
                                $_SESSION['username'] = $oopUserTable->fetchUser()[0]['username'];
                                $_SESSION['userid'] = $oopUserTable->fetchUser()[0]['userid'];
                                $_SESSION['usertype'] = "admin";
                                header("location:./presantation/admin.php");
                            } else {
                                $_SESSION['username'] = $oopUserTable->fetchUser()[0]['username'];
                                $_SESSION['userid'] = $oopUserTable->fetchUser()[0]['userid'];
                                $_SESSION['usertype'] = "user";
                                header("location:./presantation/user.php");
                            }
                        } else {
                            echo "<div class='error'>Please Enter A Valid Username Or Passwrd</div>";
                        }
                    }
                } else {
                    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $hiredate = filter_var($_POST['hiredate'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $userType = $_POST['userType'];
                    if (empty($username) || empty($password) || empty($fullname) || empty($email) || empty($hiredate)) {
                        echo "<div class='error'>Please Enter All Data</div>";
                    } else {
                        $oopUserTable = new OopECommercShop($username, $password, $fullname, $email, $hiredate, $userType);
                        $oopUserTable->insertUser();
                        $oopUserTable = new OopECommercShop($username, $password);
                        if (count($oopUserTable->fetchUser()) > 0) {
                            if ($oopUserTable->fetchUser()[0]['userType'] == 1) {
                                $_SESSION['username'] = $oopUserTable->fetchUser()[0]['username'];
                                $_SESSION['userid'] = $oopUserTable->fetchUser()[0]['userid'];
                                $_SESSION['usertype'] = "admin";
                                header("location:./presantation/admin.php");
                            } else {
                                $_SESSION['username'] = $oopUserTable->fetchUser()[0]['username'];
                                $_SESSION['userid'] = $oopUserTable->fetchUser()[0]['userid'];
                                $_SESSION['usertype'] = "user";
                                header("location:./presantation/user.php");
                            }
                        } else {
                            echo "<div class='error'>Please Enter A Valid Username Or Passwrd</div>";
                        }
                    }
                }
            }
            ?>
        </div>
        <footer>
            Created With Ahmed Elmasry
        </footer>
    </div>
    <script src="./master/js/jquery-3.7.0.js"></script>
    <script src="./master/js/bootstrap.js"></script>
    <script src="./master/js/main.js"></script>
    <script src="./master/js/logAndRigaster.js"></script>
</body>

</html>