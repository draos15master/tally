<?php
session_start();

// 세션 타임아웃을 다시 설정
if (isset($_SESSION['timeout']) && time() - $_SESSION['timeout'] > 20) {
    session_unset();
    session_destroy();
    session_start();
}

$_SESSION['timeout'] = time(); // 현재 시간으로 세션 타임아웃 갱신

// 만약 세션에 사용자 ID가 없다면 (로그인하지 않은 경우)
if (!isset($_SESSION['user_id'])) {
    // 로그아웃 처리 및 리디렉션
    session_unset();      // 세션 변수 제거
    session_destroy();    // 세션 종료
    header("Location: index.php"); // 로그인 페이지로 리디렉션
    exit;
}
