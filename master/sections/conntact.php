<?php
$hostname = "localhost";
$dbname   = "e_commerce_shop";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:hostname=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
class OopECommercShop
{
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $hiredate;
    public $usertype;

    function __construct($username = "", $password = "", $fullname = "", $email = "", $hiredate = "", $usertype = "")
    {
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->hiredate = $hiredate;
        $this->usertype = $usertype;
    }
    public function insertUser()
    {
        $addUser = $GLOBALS['conn']->prepare("INSERT INTO users(username,password,fullname,email,hiredate,userType) VALUES (?,?,?,?,?,?)");
        $addUser->execute([$this->username, $this->password, $this->fullname, $this->email, $this->hiredate, $this->usertype]);
    }
    public function fetchUser()
    {
        $fetchUser = $GLOBALS['conn']->query("SELECT userid ,username,userType FROM users WHERE username ='$this->username' and password = '$this->password'")->fetchAll(PDO::FETCH_ASSOC);
        return $fetchUser;
    }
}
//You Can Create Function To Fetch User
// function fetchUser($user, $pass)
// {
//     $fetchUser = $GLOBALS['conn']->query("SELECT userid ,username,userType FROM users WHERE username ='$user' and password = '$pass'")->fetchAll(PDO::FETCH_ASSOC);
//     return $fetchUser;
// }
// $abc = fetchUser("Ahmed Elmasry", "12345");
// echo "<pre>";
// print_r($abc);
// echo "</pre>";

/* Insert In Catogery Table */
function addCatogery($catName, $catDescraption, $parentItem, $visibilty, $allComment, $allowAds, $userId)
{
    $stmt = $GLOBALS['conn']->prepare("INSERT INTO category(catName,descraption,parentItem,visibility,allowComment,allowAds,userId) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$catName, $catDescraption, $parentItem, $visibilty, $allComment, $allowAds, $userId]);
}
/* Insert In Catogery Table */
/* Update In Catogery Table */

function updateCatogery($catName, $catDescraption, $parentItem, $visibilty, $allComment, $allowAds, $userId)
{
    $stmt = $GLOBALS['conn']->prepare("UPDATE category SET catName = ? ,descraption=?,parentItem=?,visibility=?,allowComment=?,allowAds=?,userId=? WHERE userId = ? AND cat_active = 1 ");
    $stmt->execute([$catName, $catDescraption, $parentItem, $visibilty, $allComment, $allowAds, $userId, $userId]);
}
/* Update In Catogery Table */
