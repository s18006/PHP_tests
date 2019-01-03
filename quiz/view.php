<?php
session_start();
header('Content-Type:text/html;charset="utf8"');
require_once 'controller.php';
?>

<!DOCTYPE html>
    <html>
        <head>
            <script src="js/countdown.js"></script>
            <link type="text/css" rel="stylesheet" href="css/view_style.css">
        </head>
    <body>
    <p> Remaining time: <span id="countdown" class="timer" ></span> </p>
    <p> Life: <?php echo $_SESSION['counter']; ?> </p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <h3> <?php echo $question; ?> </h3>
        <?php foreach ($options as $key=>$value) { ?>
           <p>
               <input type="radio" id="<?php echo $key; ?>" name="radio" value="<?php echo $value;?>"  required>
               <label for="<?php echo $key; ?>" > <?php echo $value; ?> </label>
            </p>
       <?php }
?>
        <input type="hidden" name="answer" value="<?php echo $row['answer']; ?>"/>
        <input type="submit" class="answerBtn" value="送信">
    </form>
    </body>
</html>
