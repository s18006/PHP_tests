<?php
require_once 'classes/startContent.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="js/index.js"></script>
  </head>
  <body onload="clearcheckBox()">
    <div class="header">
      <h1> SEA-J QUIZ </h1>
    </div>
    <form action="game.php" method="POST" onsubmit="return validation()">
      <div class="container">
        <?php echo $checkboxElem; ?>
      </div>
      <div class="submit-container">
        <div class="logout-container">
         <button type="button" class="logout-btn" onclick="logout()"> <img src="images/logout.png"/></button>
        </div>
        <div class="summary-container">
          <span id="summary" class="summary"> 選択した章: 0 問題の数: 0</span>
        </div>
        <div class="btn-container">
          <button type="submit" class="submit-btn">送信 </button>
        </div>
      </div>
    </form>
    <input type="hidden" name="num" id="num" value="0"/>
    <input type="hidden" name="gamelennum" id="gamelen" value="0"/>
  </body>
</html>
