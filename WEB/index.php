<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sol {
            width: 350px;
            pointer-events: none;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative; /* 오류 메시지가 form 안에서 상대적으로 위치하도록 */
            margin-top: 5px;
        }
        .login {
            width: 310px;
            height: 49px;
            color: white;
            background-color: #FF9201;
            /* margin-top: 40px; Fixed margin-top */
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .login:hover {
            background-color: #ffa530; /* Button hover color */
        }
        input[type="text"], input[type="password"] {
            width: 300px; /* 입력 필드의 너비를 늘림 */
            max-width: 100%; /* 화면 크기에 따라 최대 너비를 100%로 설정 */
            border: none;
            border-bottom: 2px solid rgb(154, 154, 154);
            outline: none;
            padding: 5px;
            font-size: 16px;
            margin-bottom: 10px;
        }
        input:focus {
            border-bottom: 2px solid #FF9201; 
        }

        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: grey;
        }
        .message {
            font-size: 16px;
            color: red;
            margin-top: 10px; /* 로그인 버튼과의 간격 */
            position: absolute; /* 버튼 아래에 고정시키기 */
            top: 100%; /* 로그인 버튼 아래에 위치 */
            left: 50%;
            transform: translateX(-50%); /* 중앙 정렬 */
            display: none; /* 기본적으로 숨김 */
        }

        /* 스크롤 방지 */
        body.no-scroll {
            overflow: hidden;
        }

        /* 반응형 디자인을 위한 미디어 쿼리 */
        @media (max-width: 600px) {
            .login {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <img src="img/login_sol_logo.png" class="sol" alt="Logo">

    <?php
    // 오류 메시지 표시 (login.php에서 ?error=1로 리다이렉트된 경우)
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>로그인 실패: 아이디 또는 비밀번호가 올바르지 않습니다.</p>";
    }
    ?>
    </form>
    <form id="loginForm" action="login.php" method="post">
        <input type="text" id="username" name="username" autocomplete="username" placeholder="ID 입력" required aria-label="ID 입력"><br><br> 
        <input type="password" id="password" name="password" autocomplete="current-password" placeholder="PW 입력" required aria-label="PW 입력"><br><br> 
        <button type="submit" class="login" aria-label="로그인">로그인</button>
        <div class="message" id="message" aria-live="polite"></div> <!-- 로그인 버튼 아래로 위치 -->
    </form>
</body>
</html>
 