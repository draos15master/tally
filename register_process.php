<?php
require_once 'db_config.php'; // 데이터베이스 연결 설정을 가져옵니다

try {
    // POST 요청에서 사용자 정보 가져오기
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // 비밀번호 암호화 (선택 사항)
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // SQL 쿼리 작성 및 실행
    $sql = "INSERT INTO users (userid, password) VALUES (:userid, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':password', $hashedPassword); // 비밀번호 암호화를 사용할 경우
    $stmt->execute();
    header("Location: index.php");
    exit; // 리디렉션 후 스크립트를 중단
} catch(PDOException $e) {
    echo "오류: " . $e->getMessage();
}

// 데이터베이스 연결 닫기
$conn = null;
?>
