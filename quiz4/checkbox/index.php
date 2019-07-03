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
        <!-- 1st row -->
        <div class="container-toggle1">
          <input id="toggle1" value="1" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle1"> 情報セキュリティマネジメント</label>
        </div>
        <div class="container-toggle2">
          <input id="toggle2" value="2" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle2">セキュリティ運用</label>
        </div>
        <div class="container-toggle3">
          <input id="toggle3" value="3" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle3">インフラセキュリティ</label>
        </div>
        <!-- 2nd row -->
        <div class="container-toggle4">
          <input id="toggle4" value="4" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle4"> 不正アクセス</label>
        </div>
        <div class="container-toggle5">
          <input id="toggle5" value="5" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle5"> ファイアウォール </label>
        </div>
        <div class="container-toggle6">
          <input id="toggle6" value="6" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle6">侵入検知</label>
        </div>
        <!-- 3rd row-->
        <div class="container-toggle7">
          <input id="toggle7" value="7" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle7"> アプリケーションセキュリティ</label>
        </div>
        <div class="container-toggle8">
          <input id="toggle8" value="8" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle8"> OSセキュリティ </label>
        </div>
        <div class="container-toggle9">
          <input id="toggle9" value="9" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle9">認証</label>
        </div>
        <!-- 4th row -->
        <div class="container-toggle10">
          <input id="toggle10" value="10" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle10"> プログラミング</label>
        </div>
        <div class="container-toggle11">
          <input id="toggle11" value="11" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle11"> 不正プログラム </label>
        </div>
        <div class="container-toggle12">
          <input id="toggle12" value="12" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle12"> 暗号</label>
        </div>
        <!-- 5th row -->
        <div class="container-toggle13">
          <input id="toggle13" value="13" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle13"> 電子署名</label>
        </div>
        <div class="container-toggle14">
          <input id="toggle14" value="14" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle14"> PKI </label>
        </div>
        <div class="container-toggle15">
          <input id="toggle15" value="15" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle15"> セキュリティプロトコル</label>
        </div>
        <!-- 6th row -->
        <div class="container-toggle16">
          <input id="toggle16" value="16" type="checkbox" name="title[]" onclick="display(this)">
          <label for="toggle16"> 法令・規格 </label>
        </div>
      </div>
      <div class="submit-container">
        <div class="summary-container">
          <span id="summary" class="summary"> Total: 0</span>
        </div>
        <div class="btn-container">
          <button type="submit" class="submit-btn">送信 </button>
        </div>
      </div>
    </form>
    <input type="hidden" name="num" id="num" value="0"/>
  </body>
</html>