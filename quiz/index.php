<?php
session_start();
header('Content-Type:text/html;charset="utf8"');
?>
<!DOCTYPE html>
    <html>
        <head>
            <script src="js/countdown.js"></script>
            <link type="text/css" rel="stylesheet" href="css/style.css">
        </head>
    <body>
    <?php

include('quizClass.php');


if (isset($_POST['answer'])) {
    $selected_option = hash('sha256', json_encode($_POST['radio']));
    if ($_POST['answer'] != $selected_option) {
        $_SESSION['counter'] -= 1;
    }
}

$test = new quizClass();
$test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$test -> connection();
$row = $test -> generateQuiz();
$question = $row['question'];
$options = array(1=>$row['option1'], 2=>$row['option2'], 3=>$row['option3'], 4=>$row['option4']);
?>
<span id="countdown" class="timer"></span>
<p> Life: <?php echo $_SESSION['counter']; ?> </p>

<form action="index.php" method="POST">
<!-- első belépést sessionnal szabályozni, a még nem mutatott kérdésekből listát készíteni, és a megjelenő kérdések számát (id-t) törölni a listából -->
    <h3> <?php echo $question; ?> </h3>
    <?php
        foreach ($options as $key=>$value) { ?>
           <p> <input type="radio" id="<?php echo $key; ?>" name="radio" value="<?php echo $value;?>" > <label for="<?php echo $key; ?>" > <?php echo $value; ?> </label> </p>
            <?php }
?>
<input type="hidden" name="answer" value="<?php echo $row['answer']; ?>"/>

<input type="submit" value="送信">
</form>
    </body>
</html>
