<?php

$conn = mysqli_connect("localhost", "USERNAME", "PASSWORD", "DB_NAME");
mysqli_query($conn, "SET NAMES 'UTF8'");

if (isset($_POST["userinput"])) {
    $user_post = $_POST["userinput"];
}

$query_usercheck = "SELECT count(username) FROM userek where username=?";
if ($stmt = $conn->prepare($query_usercheck)) {
    $stmt->bind_param('s', $user_post);
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->close();

}
if ($result > 0) {
    echo "このユーザー名は使用できません。別のユーザー名を選択してください";
} else {
    echo "ユーザー名が自由です。";
}
?>
