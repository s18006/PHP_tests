<?php
  require_once 'quizManager.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/game.css">
    <script src="js/manager.js"></script>
  </head>
  <body onload="loadQuestion('withoutAnswer')">
    <div class="title-container">
      <h1> SEA-J QUIZ </h1>
    </div>
    <div class="header-container">
      <div class="timer-container">
        <span id="countdown" class="timer"></span>
      </div>
      <div class="statistic-container">
        <span id="statistics"> 正解: -, 合計: - </span>
      </div>
      <div class="life-container">
        <span id="life" class="life"></span>
      </div>
    </div>
    <div class="main-container">
        <div id="question-container" class="question-container"></div>
        <div class="submit-btn-container">
          <button type="button" class="answerBtn" id="answerBtn" onclick="validation()"> 送信 </button>
        </div>
    </div>
    <input type="hidden" name="countdownValue" id="countdownValue" value="<?php echo $time; ?>"/>
    <input type="hidden" name="totalTime" id="totalTime" value="<?php echo $time; ?>"/>
    <input type="hidden" name="rightAnswer" id="rightAnswer" value="0"/>
  </body>
</html>
