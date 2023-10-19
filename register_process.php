<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        header("Location: index.html");
        exit();
    } else {
        echo "비밀번호가 일치하지 않습니다.";
    }

    echo $username;
    echo $password;
}
?>