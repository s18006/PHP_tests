<?php
    require_once 'classes/gameResultClass.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/result.css">
    <script src="js/result.js"></script>
  </head>
  <body>
    <div class="title-container">
      <h1> QUIZの結果 </h1>
    </div>
    <div class="main-container">
        <div class="table1-container">
            <table class="table1">
                <tr> <th colspan="2"> ゲーム結果　</th> </tr>
                <?php echo $tbody1; ?>
            </table>
        </div>
        <div class="table2-container">
            <table class="table2">
                <tr>
                    <th class="id-col"> 問題のID </th>
                    <th class="question-col"> 問題 </th>
                    <th class="answer-col"> ユーザーの答え </th>
                    <th class="result-col"> 正解 / 不正解 </th>
                </tr>
                <?php echo $tbody2; ?>
            </table>
        </div>
    </div>
    <div class="submit-container">
        <div class="logout-container">
         <button type="button" class="logout-btn" onclick="logout()"> <img src="images/logout.png"/></button>
        </div>
        <div class="summary-container">
          <span id="summary" class="summary"> ログアウト又はメインページに戻るためにボタンにクリックして下さい</span>
        </div>
        <div class="btn-container">
          <button type="button" onclick="window.location.href='index.php'">メインページに戻る </button>
        </div>
    </div>
  </body>
</html>
