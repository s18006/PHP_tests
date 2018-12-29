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

    include_once('quizClass.php');
    $test = new quizClass();

    if (isset($_POST['answer']) && $test->answerCheck($_POST['answer'], $_POST['radio']) == false) {
        $_SESSION['counter']--;
        if ($_SESSION['counter'] == 0) {
            echo "<script> window.location.href='result.php'; </script>";
        }
    }
    $test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
    $test -> connection();
    $test -> setLengthOfQuiz(3);
    $row = $test -> generateQuiz();
    $question = $row['question'];
    $options = array(1=>$row['option1'], 2=>$row['option2'], 3=>$row['option3'], 4=>$row['option4']);
?>
    <p> Remaining time: <span id="countdown" class="timer" ></span> </p>
    <p> Life: <?php echo $_SESSION['counter']; ?> </p>

    <form action="index.php" method="POST">

        <h3> <?php echo $question; ?> </h3>
        <?php
        foreach ($options as $key=>$value) { ?>
           <p>
               <input type="radio" id="<?php echo $key; ?>" name="radio" value="<?php echo $value;?>"  required>
               <label for="<?php echo $key; ?>" > <?php echo $value; ?> </label>
            </p>
       <?php }
?>
        <input type="hidden" name="answer" value="<?php echo $row['answer']; ?>"/>

        <input type="submit" value="送信">

    </form>

    </body>

</html>
