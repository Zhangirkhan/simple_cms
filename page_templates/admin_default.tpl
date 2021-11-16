<!doctype html>
<html lang="ru" dir="ltr">

<head>
    <base href="https://kaznpu2.test/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="{META_TAGS}" name="keywords">
    <meta content="{META_DESCRIPTION}" name="description">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <!-- Title -->
    <title>{SITE_WINDOW_TITLE} :: {WINDOW_PAGE_TITLE}</title>
    <link rel="stylesheet" href="../assets/fonts/fonts/font-awesome.min.css">

    <!-- Sidemenu Css -->
    <link href="../assets/plugins/toggle-sidebar/sidemenu.css" rel="stylesheet" />


    <!-- Bootstrap Css -->
    <link href="../assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Dashboard Css -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/admin-custom.css" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

    <!---Font icons-->
    <link href="../assets/css/icons.css" rel="stylesheet" />

    <!-- Data table css -->
    <link href="../assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatable/jquery.dataTables.min.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../assets2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets2/css/tether.min.css" />
    <link rel="stylesheet" href="../assets2/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets2/css/form_builder.css" />

    <!-- Select 2 -->
    <link rel='stylesheet' type='text/css' href='../assets/plugins/select2/select2.min.css' />

    <!-- Color-Skins -->
    <link id="theme" rel="stylesheet" type="text/css" media="all"
        href="../assets/color-skins/color-skins/color10.css" />
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="custom.css" />


    <!-- Notifications  Css -->
    <link href="../assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />

    <!-- Dashboard Core -->
    <script src="../assets/js/vendors/jquery-3.2.1.min.js"></script>
    <!--  <script src="../assets/js/vendors/jquery-3.2.1.min.js"></script> -->


</head>

<body class="app sidebar-mini">

    <!--Loader-->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="">
    </div>
    <div class="page">
        <div class="page-main h-100">
            <div class="app-header1 header py-1 d-flex">
                <div class="container-fluid">
                    <div class="d-flex">
                        <a class="header-brand text-white" href="#">
                            <img src="../assets/images/brand/logo_kaznpu.png" style="height: 50px;"
                                class="header-brand-img" alt="MOK logo">

                        </a>
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
                        <!--<div class="header-navicon">
                            <a href="#" data-toggle="search" class="nav-link d-lg-none navsearch-icon">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                        <div class="header-navsearch">
                            <a href="#" class=" "></a>
                            <form class="form-inline mr-auto">
                                <div class="nav-search">
                                    <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>-->
                        <div class="d-flex order-lg-2 ml-auto">

						<!--<div class="dropdown d-none d-md-flex mr-2" style="align-items: center">
							      <a class="btn btn-danger" style="height: 40px;" target="_blank" href="https://youtu.be/vCaln7tlhXs" >Видео инструкция для Преподавателей</a>
							</div>

                            <div class="dropdown d-none d-md-flex mr-2" style="align-items: center">
							      <a class="btn btn-danger" style="height: 40px;" href="/instruction/instruction.doc" >Инстукция по заполнению</a>
							</div>
							<div class="dropdown d-none d-md-flex" style="align-items: center">
							      <a class="btn btn-success" style="height: 40px;" href="/instruction/presentation.ppt" >Презентация проекта</a>
							</div>
							<div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon full-screen-link">
                                    <i class="fe fe-maximize-2" id="fullscreen-button"></i>
                                </a>
                            </div>

                            <div class="dropdown d-none d-md-flex country-selector">
                                <a href="#" class="d-flex nav-link leading-none" data-toggle="dropdown">
                                    <img src="../assets/images/us_flag.jpg" alt="img" class="avatar avatar-xs mr-1 align-self-center">
                                    <div>
                                        <strong class="text-dark">English</strong>
                                    </div>
                                </a>
                                <div class="language-width dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/french_flag.jpg" alt="flag-img" class="avatar  mr-3 align-self-center">
                                        <div>
                                            <strong>French</strong>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/germany_flag.jpg" alt="flag-img" class="avatar  mr-3 align-self-center">
                                        <div>
                                            <strong>Germany</strong>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/italy_flag.jpg" alt="flag-img" class="avatar  mr-3 align-self-center">
                                        <div>
                                            <strong>Italy</strong>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/russia_flag.jpg" alt="flag-img" class="avatar  mr-3 align-self-center">
                                        <div>
                                            <strong>Russia</strong>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/spain_flag.jpg" alt="flag-img" class="avatar  mr-3 align-self-center">
                                        <div>
                                            <strong>Spain</strong>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class=" nav-unread badge badge-danger  badge-pill">4</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a href="#" class="dropdown-item text-center">У вас 4 уведомлений</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <div class="notifyimg">
                                            <i class="fa fa-envelope-o"></i>
                                        </div>
                                        <div>
                                            <strong>2 формы на заполнение</strong>
                                            <div class="small text-muted">17:50</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <div class="notifyimg">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div>
                                            <strong> 1 событие</strong>
                                            <div class="small text-muted">19-10-2019</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <div class="notifyimg">
                                            <i class="fa fa-comment-o"></i>
                                        </div>
                                        <div>
                                            <strong> 3 новых задач</strong>
                                            <div class="small text-muted">05:34 </div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <div class="notifyimg">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </div>
                                        <div>
                                            <strong> Собрание в 15:30</strong>
                                            <div class="small text-muted">13:45</div>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-center">Посмотреть все уведомления (в разработке)</a>
                                </div>
                            </div>
                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class=" nav-unread badge badge-warning  badge-pill">3</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/users/male/41.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                        <div>
                                            <strong>Blake</strong> I've finished it! See you so.......
                                            <div class="small text-muted">30 mins ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/users/female/1.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                        <div>
                                            <strong>Caroline</strong> Just see the my Admin....
                                            <div class="small text-muted">12 mins ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/users/male/18.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                        <div>
                                            <strong>Jonathan</strong> Hi! I'am singer......
                                            <div class="small text-muted">1 hour ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex pb-3">
                                        <img src="../assets/images/users/female/18.jpg" alt="avatar-img" class="avatar brround mr-3 align-self-center">
                                        <div>
                                            <strong>Emily</strong> Just a reminder that you have.....
                                            <div class="small text-muted">45 mins ago</div>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-center">Посмотреть все документы на подпись (В разработке)</a>
                                </div>
                            </div>
                            <div class="dropdown d-none d-md-flex">
                                <a class="nav-link icon" data-toggle="dropdown">
                                    <i class="fe fe-grid"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  app-selector">
                                    <ul class="drop-icon-wrap">
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-speech text-dark"></i>
                                                <span class="block"> Электронный документооборот</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-map text-dark"></i>
                                                <span class="block">Дашборды</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-bubbles text-dark"></i>
                                                <span class="block">Обмен</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-user-follow text-dark"></i>
                                                <span class="block">Сотрудники</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-picture text-dark"></i>
                                                <span class="block">Фотографии</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="drop-icon-item">
                                                <i class="icon icon-settings text-dark"></i>
                                                <span class="block">Настройки</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item text-center">Посмотреть все (разделы в разработке)</a>
                                </div>
                            </div>-->
                            <div class="dropdown ">
                                <a href="#" class="nav-link pr-0 leading-none user-img" data-toggle="dropdown">
                                    <img src="{TPL_IMAGE_VALUE}" alt="profile-img" class="avatar avatar-md brround">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                                    {MENU_EX}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar menu-->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar doc-sidebar">
                <div class="app-sidebar__user clearfix">
                    <div class="dropdown user-pro-body">
                        <div>
                            <img src="{TPL_IMAGE_VALUE}" alt="user-img" class="avatar avatar-lg brround">

                        </div>
                        <div class="user-info">
                            <h2>ФИО: {TPL_NAME_VALUE} </h2>
                            <h2 class="m-1">Логин: {TPL_USER_NAME_VALUE}</h2>
                            <h2 class="m-1">Тип аккаунта: {TPL_TYPE_VALUE}</h2>
                            <h2 class="m-1">{TPL_DEPARTAMENT_VALUE}</h2>
                        </div>
                    </div>
                </div>
                <ul class="side-menu">
                    {MENU_TOP}

                </ul>

            </aside>

            <div class="app-content">
                <div class="side-app">
                    <div class="page-header">
                        <script>
                            function goBack() {
                                window.history.back();
                            }
                        </script>
                        <button onclick="goBack()" class="btn btn-danger white-text">&laquo; Вернуться назад</button>
                        <h4 class="page-title">{PAGE_TITLE}</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{PAGE_TITLE}</li>
                        </ol>
                    </div>


                    {CONTENT}

                </div>
            </div>
        </div>

        <!--footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © 2020 Разработал Нургалиев Жангирхан.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
    </div>
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-rocket"></i></a>

    <!-- datatimepicker -->
    <link rel="stylesheet" href="../assets/flatpickr/flatpickr.min.css">
    <script src="../assets/flatpickr/flatpickr.js"></script>
    <script src="../assets/flatpickr/flatpickr.min.js"></script>
    <script src="../assets/flatpickr/ru.js"></script>

    <!-- bootstrap -->
    <script src="../assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/vendors/jquery.sparkline.min.js"></script>
    <script src="../assets/js/vendors/selectize.min.js"></script>
    <script src="../assets/js/vendors/jquery.tablesorter.min.js"></script>
    <script src="../assets/js/vendors/circle-progress.min.js"></script>
    <script src="../assets/plugins/rating/jquery.rating-stars.js"></script>

    <!-- Fullside-menu Js-->
    <script src="../assets/plugins/toggle-sidebar/sidemenu.js"></script>

    <!-- ECharts Plugin
    <script src="../assets/plugins/echarts/echarts.js"></script>-->

    <!-- Input Mask Plugin -->
    <script src="../assets/plugins/input-mask/jquery.mask.min.js"></script>

    <!--Counters -->
    <script src="../assets/plugins/counters/counterup.min.js"></script>
    <script src="../assets/plugins/counters/waypoints.min.js"></script>
    <script src="../assets/plugins/counters/numeric-counter.js"></script>


    <!-- Custom scroll bar Js-->
    <script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Data tables -->
    <script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="../assets/flatpickr/dataTables.responsive.min.js"></script>
    <script src="../assets/js/datatable.js"></script>

    <script src="../assets2/js/jquery-ui.min.js"></script>
    <script src="../assets2/js/tether.min.js"></script>
    <script src="../assets2/js/bootstrap.min.js"></script>
    <script src="../assets2/js/form_builder.js"></script>

    <!--Select2 js -->
    <script async src="../assets/plugins/select2/select2.full.min.js"></script>
    <script async src="../assets/js/select2.js"></script>


    <!-- Notifications js -->
    <script src="../assets/plugins/notify/js/rainbow.js"></script>
    <script src="../assets/plugins/notify/js/jquery.growl.js"></script>

    <!-- Index Scripts
    <script src="../assets/js/index4.js"></script>-->


    <!-- Custom Js -->
    <script async src="script.js"></script>


    <!-- Custom Js-->
    <script src="../assets/js/admin-custom.js"></script>


</body>

</html>
