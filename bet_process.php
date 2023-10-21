<?php
// 데이터베이스 연결 설정
require_once 'header.php';
require_once 'db_config.php';
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    print_r($_POST);
//}
echo "확인전";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "포스트요청확인";
    if (isset($_POST['data'])) {
        echo "포스트에 데이타확인";
        $data = json_decode($_POST['data']);
        if ($data) {
            echo "데이타 확인";
            $userId = $data->userId;
            $totalOdds = $data->totalOdds;
            $betAmount = $data->betAmount;
            $cartItems = $data->cartItems;

            // 여기에서 데이터베이스 작업 또는 다른 로직을 수행하세요
            // 데이터를 JSON 형식으로 반환
            $response = array(
                'message' => '데이터가 성공적으로 처리되었습니다.',
                'userId' => $userId,
                'totalOdds' => $totalOdds,
                'betAmount' => $betAmount,
                'cartItems' => $cartItems
            );

            // JSON 형식으로 응답
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // 데이터를 읽지 못한 경우
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(array('error' => '데이터를 읽을 수 없습니다.'));
        }
    } else {
        // 'data' 매개변수가 POST로 전송되지 않은 경우
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(array('error' => '데이터를 찾을 수 없습니다.'));
    }
}
?>