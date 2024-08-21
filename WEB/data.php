<?php
header('Content-Type: application/json');
require_once 'config.php';

// 모든 GET 파라미터 받기
$temperature = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$humidity = isset($_GET['humidity']) ? $_GET['humidity'] : null;
$pm10 = isset($_GET['pm10']) ? $_GET['pm10'] : null;
$sunlight = isset($_GET['sunlight']) ? $_GET['sunlight'] : null;
$generation = isset($_GET['generation']) ? $_GET['generation'] : null;

$response = array(
    'status' => 'success',
    'message' => '데이터를 성공적으로 받았습니다.',
    'data' => array(
        'temperature' => $temperature,
        'humidity' => $humidity,
        'pm10' => $pm10,
        'generation' => $generation,
        'sunlight' => $sunlight
    )
);

try {
    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$db_host)(PORT=$db_port))(CONNECT_DATA=(SID=$db_sid)));charset=UTF8";
    $conn = new PDO($dsn, $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $current_time = date('Y-m-d H:i:s', strtotime('+9 hours'));

    // INSERT 쿼리
    if ($temperature !== null || $humidity !== null || $illuminance !== null || $pm10 !== null) {
        $sql_insert = "INSERT INTO TB_ENV (ENV_IDX, PLANT_IDX, TEMPERATURE, HUMIDITY, PM10, CREATED_AT, GENERATION)
                       VALUES (SEQ_ENV_IDX.NEXTVAL, 99, :temperature, :humidity, :pm10, TO_DATE(:created_at, 'YYYY-MM-DD HH24:MI:SS'), :generation)";

        $stmt_insert = $conn->prepare($sql_insert);

        $stmt_insert->bindParam(':temperature', $temperature);
        $stmt_insert->bindParam(':humidity', $humidity);
        $stmt_insert->bindParam(':pm10', $pm10);
        $stmt_insert->bindParam(':created_at', $current_time);
        $stmt_insert->bindParam('generation',$generation);

        if ($stmt_insert->execute()) {
            $response['message'] .= " insert succes";
        } else {
            $response['status'] = 'error';
            $response['message'] = "insert error";
        }
    }

    // UPDATE 쿼리 (sunlight 데이터가 있을 경우)
    if ($sunlight !== null) {
        $sql_update = "UPDATE TB_ENV SET SUNLIGHT = :sunlight 
                       WHERE ENV_IDX = (SELECT MAX(ENV_IDX) FROM TB_ENV WHERE PLANT_IDX = 99)";

        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':sunlight', $sunlight);

        if ($stmt_update->execute()) {
            $response['message'] .= " Sunlight update succes.";
        } else {
            $response['status'] = 'error';
            $response['message'] = "Sunlight update error";
        }
    }

} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = "데이터베이스 오류: " . $e->getMessage();
} finally {
    $conn = null;
}

echo json_encode($response);
?>