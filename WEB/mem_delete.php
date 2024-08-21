<?php
require_once 'config.php'; // 데이터베이스 연결 정보 포함

// ID 값이 URL 파라미터로 전달되었는지 확인
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = $_GET['id'];

  // SQL 인젝션 방지를 위한 ID 값 처리
  $id = trim($id);

  echo "$id";

  try {
    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$db_host)(PORT=$db_port))(CONNECT_DATA=(SID=$db_sid)));charset=UTF8";
    $conn = new PDO($dsn, $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 삭제 쿼리 준비
    $sql = 'DELETE FROM TB_MEMBER WHERE MEM_ID = :id';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR); // 문자열로 바인딩
    $stmt->execute();

    $conn->commit();

    echo "삭제가 완료되었습니다.";
    // 삭제 완료 후 사용자 목록 페이지로 리디렉션
    header('Location: user_list.php');
    exit();
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
} else {
  echo '잘못된 요청입니다.';
}
?>
