<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Create Post - SB Admin Pro</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://unpkg.com/easymde/dist/easymde.min.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>
        <style>
            .filebox .upload-name {
                display: inline-block;
                height: 40px;
                padding: 0 10px;
                vertical-align: middle;
                border: 1px solid #dddddd;
                width: 78%;
                color: #999999;
            }

            .filebox label {
                display: inline-block;
                padding: 10px 20px;
                color: #fff;
                vertical-align: middle;
                background-color: #999999;
                cursor: pointer;
                height: 40px;
                margin-left: 10px;
            }


            .filebox input[type="file"] {
                position: absolute;
                width: 0;
                height: 0;
                padding: 0;
                overflow: hidden;
                border: 0;
            }

            .mmar {
                padding: 20px;
            }
        </style>
    </head>
    <body class="nav-fixed">
        <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.php">SOLQUIZ</a>
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
        <!-- ----------------------------------------------------------------------- -->
        
            <div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-fluid px-4">
                            <div class="page-header-content">
                                <!-- <div class="row align-items-center justify-content-between pt-3">
                                    
                                </div> -->
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-fluid px-4">
                        <form action="insert_board.php" method="post">
                            <div class="row gx-4">
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-header">글 제목</div>
                                        <div class="card-body"><input class="form-control" id="postTitleInput" name="postTitleInput" type="text" placeholder="Enter your post title..." /></div>
                                    </div>

                                    
                                    
                                    <div class="card card-header-actions mb-4 mb-lg-0">
                                        <div class="card-header">
                                            글 내용
                                            <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left" title="Markdown is supported within the post content editor."></i>
                                        </div>
                                        <div class="card-body">
                                            <textarea id="postEditor" name="postEditor"> ## Post Subheading This is the content for your post. </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card card-header-actions">
                                        <div class="card-body">
                                            <div class="d-grid"><button class="fw-500 btn btn-primary" type="submit">작성완료</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
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
        <script src="https://unpkg.com/easymde/dist/easymde.min.js" crossorigin="anonymous"></script>
        <script src="js/markdown.js"></script>
    </body>
</html>
