<?php
require_once 'config.php';
session_start(); 

try {
    // 데이터베이스 연결
    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$db_host)(PORT=$db_port))(CONNECT_DATA=(SID=$db_sid)));charset=UTF8";
    $conn = new PDO($dsn, $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 폼 데이터 가져오기
    $postTitle = $_POST['postTitleInput'];
    $postContent = $_POST['postEditor'];
    $userId = $_SESSION['user_id'];
    echo "아니 너 왜 안나와 $userId";
    // SQL 쿼리 준비 TO_DATE(SYSDATE, 'YYYY-MM-DD HH24:MI:SS')
    $sql = "INSERT INTO TB_BOARD VALUES ((select max(B_IDX)+1 from TB_BOARD),:title,'-' ,TO_DATE(SYSDATE, 'YYYY-MM-DD HH24:MI:SS'),0,0,:userId,:content)";

    // SQL 쿼리 실행
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $postTitle);
    $stmt->bindParam(':content', $postContent);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    echo "게시글이 성공적으로 추가되었습니다.";
    header("Location: board.php");
    exit();

} catch (PDOException $e) {
    echo "데이터베이스 오류: " . $e->getMessage();
}
?>