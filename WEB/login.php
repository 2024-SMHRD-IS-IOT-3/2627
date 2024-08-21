<?php
require_once 'config.php'; // config.php 파일 불러오기 (DB 연결 정보)
session_start(); // 세션 시작

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$db_host)(PORT=$db_port))(CONNECT_DATA=(SID=$db_sid)));charset=UTF8";
        $conn = new PDO($dsn, $db_user, $db_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $sql = "SELECT * FROM TB_MEMBER WHERE MEM_ID = :username AND MEM_PW = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<p>로그인 성공!</p>";
            echo "<p>아이디: " . $row['MEM_ID'] . "</p>";
            echo "<p>이름: " . $row['MEM_NAME'] . "</p>";

            session_start();
            $_SESSION['user_id'] = $row['MEM_ID'];

            header("Location: user_list.php");
            exit();
        } else {
            header("Location: index.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
