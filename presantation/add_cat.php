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
    <h1 class="title-content">Categories</h1>
    <div class="data-content">
        <div class="searchBox">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <div class="row">
                    <span>Category Name : </span>
                    <input type="text" name="catName" placeholder="Please Enter Category Name...">
                </div>
                <div class="row">
                    <span>Category Descraption : </span>
                    <input type="text" name="descraption" placeholder="Please Enter Category Descraption...">
                </div>
                <div class="row">
                    <span>Child Items : </span>
                    <select name="childItems" id="">
                        <option value="start">Please Selecte Child Item</option>
                        <?php
                        $all_cat = $conn->query("SELECT itemId,itemName FROM items WHERE item_active = 1 ")->fetchAll(PDO::FETCH_KEY_PAIR);
                        foreach ($all_cat as $key => $value) {
                            echo "<option value='$value'>" . $value . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <span>Visibility : </span>
                    <div class="radios">
                        <input type="radio" id="vis" checked name="visibleItem" value="1"><label for="vis"> Visibile</label>
                        <input type="radio" id="notVis" name="visibleItem" value="0"><label for="notVis"> Not Visibile</label>
                    </div>
                </div>
                <div class="row">
                    <span>Allow Comment : </span>
                    <div class="radios">
                        <input type="radio" id="allow" checked name="allowComment" value="1"><label for="allow"> Allowed</label>
                        <input type="radio" id="notAllow" name="allowComment" value="0"><label for="notAllow"> Not Allowed</label>
                    </div>
                </div>
                <div class="row">
                    <span>Allow Ads : </span>
                    <div class="radios">
                        <input type="radio" id="ads" checked name="allowAds" value="1"><label for="ads"> Allowed</label>
                        <input type="radio" id="notAds" name="allowAds" value="0"><label for="notAds"> Not Allowed</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn-save save"><i class="fa-solid fa-plus"></i> Save Catogery</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_SESSION['userid'];
        $catName = filter_var($_POST['catName'], FILTER_SANITIZE_SPECIAL_CHARS);
        $catDescraption = filter_var($_POST['descraption'], FILTER_SANITIZE_SPECIAL_CHARS);
        $childItems = filter_var($_POST['childItems'], FILTER_SANITIZE_SPECIAL_CHARS);
        $visibility = filter_var($_POST['visibleItem'], FILTER_SANITIZE_SPECIAL_CHARS);
        $allowComment = filter_var($_POST['allowComment'], FILTER_SANITIZE_SPECIAL_CHARS);
        $allowAds = filter_var($_POST['allowAds'], FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($catName) || empty($catDescraption) || empty($childItems)) {
            echo "<div class='error'>Please Added All Data</div>";
        } else {
            addCatogery($catName, $catDescraption, $childItems, $visibility, $allowComment, $allowAds, $userId);
        }
    }
    ?>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>