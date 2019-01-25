<?php
header('Content-Type: text/html; charset=utf-8');
echo '<p> <b> Kérem válassza ki az eljárást!</b> </p>';
require_once 'downloadClass.php';

$letolt = new downloadClass();

echo '<h2> Oldal kiválasztása';
$query_maxid = "SELECT COUNT(*) FROM newkozbesz";
$maxid = $letolt -> downloadParams($query_maxid, 1)[0][0]; //a [0][0] a tobbdimenzios array elso eleme

$page_num = ceil($maxid / 10);
/*
$page_split = explode('/', htmlspecialchars($_SERVER['REQUEST_URI']));
$action = end($page_split);
 */
for ($k = $page_num; $k >= 1; $k--) {
    echo ' <a href="idcheck.php?page='.$k.'" style="text-decoration:none">'.$k.'</a> ';
}
echo '</h2>';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = "";
}
if ($page == "" || $page == "1") {
    $limit_min = 0;
} else {
    $limit_min = $page * 10 - 10;
}

$query_result = "SELECT id, ajanlatkero_neve, kozbeszerzes_targya FROM newkozbesz order by id desc limit $limit_min,10";
$rowResult = $letolt -> downloadParams($query_result, 3);
for ($i = 0; $i < count($rowResult); $i++) { ?>
            <div>
            <input type="radio" name="idnum" value="<?php echo $rowResult[$i][0]; ?>" id="radio1<?php echo $rowResult[$i][0]; ?>" required/> <label for="radio1<?php echo $rowResult[$i][0]; ?>"><span class="text"> <?php echo $rowResult[$i][1].' által kiírandó '. $rowResult[$i][2].' tárgyú eljárás (eljárás azonosító: '.$rowResult[$i][0]. ')'; ?></span> </label>
            </div>
<?php } ?>

