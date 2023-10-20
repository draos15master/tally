<?php
// 세션
require_once 'header.php';
// 데이터베이스 연결 설정을 가져옵니다
require_once 'db_config.php';

// 세션 변수에서 유저 정보 가져오기
$user_id = $_SESSION['user_id'];

// 폼 제출 후 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password'])) {
    // 비밀번호 업데이트 로직
    $new_password = $_POST['new_password'];

    // 새 비밀번호를 해싱
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    try {
        // 데이터베이스에 새로운 비밀번호 업데이트
        $sql = "UPDATE users SET password = :hashed_password WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':hashed_password', $hashed_password);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // 업데이트 완료 후 프로필 페이지로 리디렉션
        header("Location: profile.php");
        exit;
    } catch (PDOException $e) {
        echo "오류: " . $e->getMessage();
    }
}

// 데이터베이스 연결 닫기
$conn = null;
?>
