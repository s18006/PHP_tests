<?php header ('charset=utf8mb4;'); ?>

<!DOCTYPE html>
<html>
  <head>
    <title> ユーザー名の確認 </title>
   <meta charset="UTF-8"/>
   <link rel="stylesheet" type="text/css" href="css/usercheck.css"/>
  </head>

  <body>
    <h1> ユーザー名の確認 </h1>
    <br>
    <p id="input"> </p>
    <p> ユーサー名<input type="text" name="user_nev" onInput="kuld()" id="user_nev" required/></p>
    <p id="text"></p>
 <script>
   function kuld() {
     var xhttp = new XMLHttpRequest();
     var name = document.getElementById("user_nev").value;
     var userinput = "userinput="+name;

     xhttp.onreadystatechange= function() {
         console.log(xhttp);
         if (this.readyState == 4 && this.status == 200) {
             document.getElementById("text").innerHTML = xhttp.responseText;
            if (xhttp.responseText == "このユーザー名は使用できません。別のユーザー名を選択してください") {
                document.getElementById("text").className = "used";
                alert("別のユーザー名を選択してください");
        } else {
                document.getElementById("text").className = "free";
        }
     }
   };
     xhttp.open("POST", "http://localhost/else/blog2/user_check/download.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send(userinput);
     }


      </script>

  </body>
  </html>
