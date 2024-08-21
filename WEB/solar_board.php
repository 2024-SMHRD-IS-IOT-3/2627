<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>모집 게시판 관리</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <!-- Sidenav Toggle Button-->
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">SOLQUIZ</a>
            <!-- Navbar Search Input-->
            <!-- * * Note: * * Visible only on and above the lg breakpoint-->

            <!-- Navbar Items-->
            <ul class="navbar-nav align-items-center ms-auto">
                <!-- Documentation Dropdown-->
                <li class="nav-item dropdown no-caret d-none d-md-block me-3">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="fw-500">관리자님</div>
                        <!-- <i class="fas fa-chevron-right dropdown-arrow"></i> -->
                    </a>
                </li>
                <!-- User Dropdown-->
                <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- 관리자 이미지 -->
                        <img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <a class="dropdown-item" href="index.php">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>


        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                    <div class="sidenav-menu">
                        <div class="nav accordion" id="accordionSidenav">
                            <!-- 메뉴바 부분입니다~~~~~ -->
                            <div class="sidenav-menu-heading">기능</div>
                            <!-- Sidenav Accordion (Dashboard)-->
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                    회원 기능
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                        <a class="nav-link" href="user_list.php">회원 관리</a>
                                    </nav>
                                </div>
                                
                                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                    게시판 기능
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                        <a class="nav-link" href="solar_board.php">모집게시판 관리</a>
                                        <a class="nav-link" href="board.php">공지사항 게시판 관리</a>
                                        <a class="nav-link" href="create_board.php">공지사항 작성</a>
                                    </nav>
                                </div>
                </nav>
            </div>


            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <div class="card">
                            <div class="card-body">
                                <table id="datatablesSimple">

                                    <!-- 테이블 위에 컬럼 보여주는 곳 -->
                                    <thead>
                                        <tr>
                                            <th>게시판 번호</th>
                                            <th>선호타입</th>
                                            <th>게시글 작성자</th>
                                            <th>게시일자</th>
                                            <th>참여멤버</th>
                                            <th>게시글 삭제</th>
                                        </tr>
                                    </thead>

                                

                                    <!-- 테이블 안 데이터가 있는 곳  -->
                                    <tbody>
                                    <?php
                                    require_once 'config.php';

                                    try {
                                        $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$db_host)(PORT=$db_port))(CONNECT_DATA=(SID=$db_sid)));charset=UTF8";
                                        $conn = new PDO($dsn, $db_user, $db_pass);
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        // 게시글 목록 조회
                                        $sql = "SELECT SB_IDX, SB_TYPE, MEM_ID, PLACE, B_STATE FROM TB_SOLAR_BOARD";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();

                                        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                                            $SB_IDX = htmlspecialchars($row['SB_IDX']);  // ID 값을 안전하게 처리
                                            echo '<tr>';
                                            echo '<td><div class="d-flex align-items-center"><div class="avatar me-2"><img class="avatar-img img-fluid" src="assets/img/illustrations/profiles/profile-1.png" /></div>'.htmlspecialchars($row['SB_IDX']).'</td>';
                                            echo '<td>'.htmlspecialchars($row['SB_TYPE']).'</td>';
                                            echo '<td>' . htmlspecialchars($row['PLACE']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['MEM_ID']) . '</td>';
                                            
                                            // 댓글 멤버 조회
                                            $sql2 = "SELECT MEM_ID FROM TB_SOLAR_COMMENT WHERE SB_IDX = :SB_IDX";
                                            $stmt2 = $conn->prepare($sql2);
                                            $stmt2->bindParam(':SB_IDX', $SB_IDX);
                                            $stmt2->execute();
                                            
                                            echo '<td>';
                                            while (($commentRow = $stmt2->fetch(PDO::FETCH_ASSOC)) !== false) {
                                                echo '<span class="badge bg-green-soft text-green">'.htmlspecialchars($commentRow['MEM_ID']).'</span> ';
                                            }
                                            echo '</td>';
                                            
                                            echo '<td style="text-align: center;">
                                                    삭제 &nbsp; 
                                                    <a class="btn btn-datatable btn-icon btn-transparent-dark delete-btn" href="mem_delete.php?id='.urlencode($SB_IDX).'">
                                                        <i data-feather="trash-2"></i>
                                                    </a> 
                                                  </td>';                                            
                                            echo '</tr>';
                                        }

                                        echo '</table>';
                                    } catch (PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                    }
                                ?>
                                        <!-- 테이블 데이터 양식이라고 보면 될듯 ? -->
                                        <tr>
                                            <td style="text-align: center;">1</td>
                                            <td>전남 / 해안</td>
                                            <td style="text-align: center;">김희원</td>
                                            <td>2024-08-09</td>
                                            <td>
                                                <span class="badge bg-green-soft text-green">홍지연</span>
                                                <span class="badge bg-blue-soft text-blue">김준</span>
                                                <span class="badge bg-red-soft text-red">최수빈</span>
                                                <span class="badge bg-purple-soft text-purple">박태하</span>
                                            </td>
                                            <!-- 회원 삭제 sql 코드가 만들어진 php 파일 연동 이때 정보는 회원 아이디를 가져가야할거 같은데? -->
                                            <!-- <td><a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i data-feather="trash-2"></i></a></td> -->
                                            <td style="text-align: center;">삭제 &nbsp; <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i data-feather="trash-2"></i></a></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">스마트인재개발원 실전프로젝트</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">team : 2627</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables/datatables-simple-demo.js"></script>
    </body>
</html>
