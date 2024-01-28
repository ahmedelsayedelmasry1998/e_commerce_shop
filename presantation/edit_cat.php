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
    $userId = $_SESSION['userid'];
    $catName = filter_var($_POST['catName'], FILTER_SANITIZE_SPECIAL_CHARS);
    $catDescraption = filter_var($_POST['descraption'], FILTER_SANITIZE_SPECIAL_CHARS);
    $childItems = filter_var($_POST['childItems'], FILTER_SANITIZE_SPECIAL_CHARS);
    $visibility = filter_var($_POST['visibleItem'], FILTER_SANITIZE_SPECIAL_CHARS);
    $allowComment = filter_var($_POST['allowComment'], FILTER_SANITIZE_SPECIAL_CHARS);
    $allowAds = filter_var($_POST['allowAds'], FILTER_SANITIZE_SPECIAL_CHARS);
    updateCatogery($catName, $catDescraption, $childItems, $visibility, $allowComment, $allowAds, $userId);
    header("location:catogeries.php");
}
include_once("../master/sections/start.php");
include_once("../master/sections/links.php");
include_once("../master/sections/mid.php");
?>
<div class="masterContent">
    <h1 class="title-content">Categories</h1>
    <div class="data-content">
        <div class="searchBox">
            <?php
            $cat_id = $_GET['catId'];
            $pat_record = $conn->query("SELECT * FROM category WHERE catId = $cat_id AND cat_active = 1")->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="addInTable">
                <div class="row">
                    <span>Category Name : </span>
                    <input type="text" name="catName" value="<?php echo $pat_record[0]['catName']; ?>">
                </div>
                <div class="row">
                    <span>Category Descraption : </span>
                    <input type="text" name="descraption" value="<?php echo $pat_record[0]['descraption']; ?>">
                </div>
                <div class="row">
                    <span>Child Items : </span>
                    <select name="childItems" id="">
                        <option value="start">Please Selecte Child Item</option>
                        <option <?php if ($pat_record[0]['parentItem'] == 1) {
                                    echo "selected";
                                } ?> value="1">Please Selecte Child Item</option>
                        <option <?php if ($pat_record[0]['parentItem'] == 2) {
                                    echo "selected";
                                } ?> value="2">Please Selecte Child Item</option>
                        <option <?php if ($pat_record[0]['parentItem'] == 3) {
                                    echo "selected";
                                } ?> value="3">Please Selecte Child Item</option>
                        <option <?php if ($pat_record[0]['parentItem'] == 4) {
                                    echo "selected";
                                } ?> value="4">Please Selecte Child Item</option>
                    </select>
                </div>
                <div class="row">
                    <span>Visibility : </span>
                    <div class="radios">
                        <input type="radio" id="vis" <?php if ($pat_record[0]['visibility'] == 1) {
                                                            echo "checked";
                                                        } ?> name="visibleItem" value="1"><label for="vis"> Visibile</label>
                        <input type="radio" id="notVis" <?php if ($pat_record[0]['visibility'] == 0) {
                                                            echo "checked";
                                                        } ?> name="visibleItem" value="0"><label for="notVis"> Not Visibile</label>
                    </div>
                </div>
                <div class="row">
                    <span>Allow Comment : </span>
                    <div class="radios">
                        <input type="radio" id="allow" <?php if ($pat_record[0]['allowComment'] == 1) {
                                                            echo "checked";
                                                        } ?> name="allowComment" value="1"><label for="allow"> Allowed</label>
                        <input type="radio" id="notAllow" <?php if ($pat_record[0]['allowComment'] == 0) {
                                                                echo "checked";
                                                            } ?> name="allowComment" value="0"><label for="notAllow"> Not Allowed</label>
                    </div>
                </div>
                <div class="row">
                    <span>Allow Ads : </span>
                    <div class="radios">
                        <input type="radio" id="ads" <?php if ($pat_record[0]['allowAds'] == 1) {
                                                            echo "checked";
                                                        } ?> name="allowAds" value="1"><label for="ads"> Allowed</label>
                        <input type="radio" id="notAds" <?php if ($pat_record[0]['allowAds'] == 0) {
                                                            echo "checked";
                                                        } ?> name="allowAds" value="0"><label for="notAds"> Not Allowed</label>
                    </div>
                </div>
                <div class="row">
                    <button class="save"><i class="fa-regular fa-pen-to-square"></i> Edit Catogery</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include_once("../master/sections/foot.php");
    include_once("../master/sections/end.php");
    ?>