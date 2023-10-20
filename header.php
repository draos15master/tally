<?php
session_start();

// 세션 타임아웃을 다시 설정
if (isset($_SESSION['timeout']) && time() - $_SESSION['timeout'] > 1800) {
    session_unset();
    session_destroy();
    session_start();
}

$_SESSION['timeout'] = time(); // 현재 시간으로 세션 타임아웃 갱신

require_once 'db_config.php'; // 데이터베이스 연결 설정을 가져옵니다
// 세션에 사용자 ID가 있다면 (로그인 상태)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // SQL 쿼리 작성
    $sql = "SELECT nickname, price FROM users WHERE id = :user_id";

    // SQL 쿼리를 실행
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // 사용자 정보를 가져오기
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    // 세션에 사용자 정보 저장
    $_SESSION['nickname'] = $user_info['nickname'];
    $_SESSION['price'] = $user_info['price'];
}

// 만약 세션에 사용자 ID가 없다면 (로그인하지 않은 경우)
if (!isset($_SESSION['user_id'])) {
    // 로그아웃 처리 및 리디렉션
    session_unset();      // 세션 변수 제거
    session_destroy();    // 세션 종료
    header("Location: index.php"); // 로그인 페이지로 리디렉션
    exit;
}

