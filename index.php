<!DOCTYPE html>
<?php
session_start();

// 로그인 폼이 제출되었을 때
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 데이터베이스 연결 설정을 가져옵니다
    require_once 'db_config.php';

    try {
        // POST 요청에서 사용자 정보 가져오기
        $userid = $_POST['userid'];
        $password = $_POST['password'];

        // 사용자 정보를 데이터베이스에서 검증
        $sql = "SELECT * FROM users WHERE userid = :userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // 로그인 성공
            $_SESSION['user_id'] = $user['id']; // 세션에 사용자 ID 저장
            header("Location: main.php"); // 로그인 성공 시 대시보드 페이지로 리디렉션
            exit;
        } else {
            $error_message = "로그인 실패. 사용자 아이디 또는 비밀번호가 올바르지 않습니다.";
        }
    } catch (PDOException $e) {
        $error_message = "오류: " . $e->getMessage();
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
<div id="logo">
    <div class="logo_img">
        <img src="https://shop-phinf.pstatic.net/20230329_245/1680077568628LMcpa_PNG/%C0%D5%C3%F7%C5%C5%B8%AE_%B7%CE%B0%ED_%C4%B5%B9%F6%BD%BA_%C5%A9%B1%E23.png?type=w640" alt="">
    </div>
</div>
<div id="body">
    <div class="form">
        <form method="POST" action="index.php" class="form_section">
            <div class="form_top">
                <label for="userid" class="label">userid</label>
                <input type="text" id="userid" name="userid" required>

                <label for="password" class="label">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form_bottom">
                <input type="submit" value="로그인" class="submit">
            </div>
            <a href="register.php" class="join_btn">회원가입</a>
        </form>
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
