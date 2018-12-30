<?php
session_start();
header('Content-Type:text/html;charset="utf8"');
include_once('quizClass.php');
include_once('modell.php');
?>

<!DOCTYPE html>
    <html>
        <head>
            <script src="js/countdown.js"></script>
            <link type="text/css" rel="stylesheet" href="css/viewstyle.css">
        </head>
    <body>
    <p> Remaining time: <span id="countdown" class="timer" ></span> </p>
    <p> Life: <?php echo $_SESSION['counter']; ?> </p>

    <form action="view.php" method="POST">

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
