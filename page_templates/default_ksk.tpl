<!DOCTYPE html>
<html lang="ru">

    <head>
        <base href="https://e-home.kz/">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>{SITE_WINDOW_TITLE} :: {WINDOW_PAGE_TITLE}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <meta content="{META_TAGS}" name="keywords">
        <meta content="{META_DESCRIPTION}" name="description">
        <meta content="Страница с подменю вложенных разделов 1|Page with sub pages menu 1|Страница с подменю вложенных разделов 1" name="template">

        <meta name="Robots" content="INDEX, FOLLOW">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/style.default.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="css/select2.css" rel="stylesheet" />
        <link href="css/prettyPhoto.css" rel="stylesheet">
        <link href="css/dropzone.css" rel="stylesheet" />
        <script language="javascript" type="text/javascript" src="script.js"></script>

        <link href="css/style.datatables.css" rel="stylesheet">
        <link href="//cdn.datatables.net/responsive/1.0.1/css/dataTables.responsive.css" rel="stylesheet">

        <link href='js/packages/core/main.css' rel='stylesheet' />
        <link href='js/packages/daygrid/main.css' rel='stylesheet' />
        <link href='js/packages/timegrid/main.css' rel='stylesheet' />
        <script src='js/packages/core/main.js'></script>
        <script src='js/packages/interaction/main.js'></script>
        <script src='js/packages/daygrid/main.js'></script>
        <script src='js/packages/timegrid/main.js'></script>
        <script src='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js'></script>

        <script src='https://unpkg.com/@fullcalendar/core@4.3.1/locales-all.js'></script>

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            a:focus {
                background-color: darkgray;
            }

            a h2 {
                color: #6c757d !important;
            }

            .search-sec {
                padding: 2rem;
            }

            .search-slt {
                display: block;
                width: 100%;
                font-size: 0.875rem;
                line-height: 1.5;
                color: #55595c;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                height: calc(3rem + 2px) !important;
                border-radius: 0;
            }

            .wrn-btn {
                width: 100%;
                font-size: 16px;
                font-weight: 400;
                text-transform: capitalize;
                height: calc(3rem + 2px) !important;
                border-radius: 0;
            }

            @media (min-width: 992px) {
                .search-sec {
                    position: relative;
                    top: -114px;
                    background: rgba(26, 70, 104, 0.51);
                }
            }

            @media (max-width: 992px) {
                .search-sec {
                    background: #1A4668;
                }
            }

            .thumbnail {
                border-radius: 3px;
                padding: 5px;
                margin-bottom: 20px;
                line-height: 1.42857143;
                background-color: #fff;
                border: 1px solid #ddd;
                display: block;
                transition: all 0.2s ease-in-out;
            }

            .card-body {
                flex: 1 1 auto;
                margin: 0;
                padding: 1.5rem;
                position: relative;
            }

            .card {
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                border-radius: 3px;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid #eaeef9;
                box-shadow: 0 0 40px 0 rgba(234, 238, 249, .5);
            }

            .sptb {
                padding-top: 0;
                padding-bottom: 3rem;
            }

            .cat-item .cat-desc {
                margin-top: 15px;
                color: #212529;
            }

            .center-block {
                margin-left: auto;
                margin-right: auto;
                float: inherit !important;
            }

            .section-title {
                padding-bottom: 2rem;
                position: relative;
            }

            .item-all-cat .row .item-all-card {
                background: #fff;
            }

            .item-all-cat .item-all-card {
                position: relative;
                padding: 1.5rem;
                border-radius: 3px;
                border: 1px solid #e8ebf3;
            }

            .item-all-cat .category-type .item-all-card img {
                width: 7rem;
                height: 7rem;
                border-radius: 50%;
                padding: 2.3rem 0;
            }

            .item-all-cat .category-type .item-all-card img {
                background: linear-gradient(to right, rgba(22, 80, 226, 0.95) 0%, rgba(126, 81, 236, 0.95) 100%);
            }

            .caption {
                flex: 1 1 auto;
                margin: 0;
                padding: 1.5rem;
                position: relative;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries
        -->
        <!--[if lt IE 9]> <script src="js/html5shiv.js"></script> <script
        src="js/respond.min.js"></script> <![endif]-->
    </head>

    <body>

        <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="index.html" class="logo">
                        <img src="images/logo.png" alt="" />
                    </a>
                    <!--<div class="pull-right">
                        <a href="" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>-->
                </div>
                <!-- header-left -->

                <div class="header-right">

                    <div class="pull-right">

                        <!--<form class="form form-search" action="search-results.html">
                            <input type="search" class="form-control" placeholder="Поиск"/>
                        </form>-->

                        <div class="btn-group btn-group-list btn-group-notification">
                            <!--<button
                                type="button"
                                class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="badge">5</span>
                            </button>
                            <div class="dropdown-menu pull-right">
                                <a href="" class="link-right">
                                    <i class="fa fa-search"></i>
                                </a>
                                <h5>Уведомления</h5>
                                <ul class="media-list dropdown-list">
                                    <li class="media">
                                        <img
                                            class="img-circle pull-left noti-thumb"
                                            src="images/photos/user1.png"
                                            alt="">
                                        <div class="media-body">
                                            <strong>Nusja Nawancali</strong>
                                            likes a photo of you
                                            <small class="date">
                                                <i class="fa fa-thumbs-up"></i>
                                                15 minutes ago</small>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img
                                            class="img-circle pull-left noti-thumb"
                                            src="images/photos/user2.png"
                                            alt="">
                                        <div class="media-body">
                                            <strong>Weno Carasbong</strong>
                                            shared a photo of you in your
                                            <strong>Mobile Uploads</strong>
                                            album.
                                            <small class="date">
                                                <i class="fa fa-calendar"></i>
                                                July 04, 2014</small>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img
                                            class="img-circle pull-left noti-thumb"
                                            src="images/photos/user3.png"
                                            alt="">
                                        <div class="media-body">
                                            <strong>Venro Leonga</strong>
                                            likes a photo of you
                                            <small class="date">
                                                <i class="fa fa-thumbs-up"></i>
                                                July 03, 2014</small>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img
                                            class="img-circle pull-left noti-thumb"
                                            src="images/photos/user4.png"
                                            alt="">
                                        <div class="media-body">
                                            <strong>Nanterey Reslaba</strong>
                                            shared a photo of you in your
                                            <strong>Mobile Uploads</strong>
                                            album.
                                            <small class="date">
                                                <i class="fa fa-calendar"></i>
                                                July 03, 2014</small>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img
                                            class="img-circle pull-left noti-thumb"
                                            src="images/photos/user1.png"
                                            alt="">
                                        <div class="media-body">
                                            <strong>Nusja Nawancali</strong>
                                            shared a photo of you in your
                                            <strong>Mobile Uploads</strong>
                                            album.
                                            <small class="date">
                                                <i class="fa fa-calendar"></i>
                                                July 02, 2014</small>
                                        </div>
                                    </li>
                                </ul>
                                <div class="dropdown-footer text-center">
                                    <a href="" class="link">Посмотреть все уведомления</a>
                                </div>
                            </div>-->
                            <!-- dropdown-menu -->
                        </div>
                        <!-- btn-group -->

                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="glyphicon glyphicon-user"></i>
                                        Профиль</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="glyphicon glyphicon-question-sign"></i>
                                        База знаний</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        <i class="glyphicon glyphicon-log-out"></i>Выход</a>
                                </li>
                            </ul>
                        </div>
                        <!-- btn-group -->

                    </div>
                    <!-- pull-right -->

                </div>
                <!-- header-right -->

            </div>
            <!-- headerwrapper -->
        </header>

        <section>
            <div class="mainwrapper">
                <div class="leftpanel">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="">
                            <img class="img-circle" src="https://i.pinimg.com/736x/ed/f8/d4/edf8d4e13af6485e64fc0e39495b2363.jpg" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Нуржан Жаркенович
                            </h4>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                    <!-- media -->

                    {MENU_TOP_KSK}
                </div>
                <!-- leftpanel -->

                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="pull-left media ">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li>
                                        <a href="{LANG_INDEX}/home">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </a>
                                    </li>
                                    <li>
                                        {PAGE_TITLE}</li>
                                </ul>
                                <h4>{PAGE_TITLE}</h4>

                            </div>

                        </div>

                        <!-- media -->

                    </div>

                    <!-- pageheader -->

                    <div class="contentpanel">

                        {CONTENT}

                    </div>
                    <!-- contentpanel -->

                </div>
                <!-- mainpanel -->
            </div>
            <!-- mainwrapper -->
        </section>

        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>

        <script src="js/jquery.sparkline.min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/raphael-2.1.0.min.js"></script>
        <script src="js/bootstrap-wizard.min.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/dropzone.min.js"></script>

        <script src="js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="//cdn.datatables.net/responsive/1.0.1/js/dataTables.responsive.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        <script src="js/custom.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [
                        'interaction', 'dayGrid', 'timeGrid'
                    ],
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    defaultDate: '2020-02-01',
                    locale: "ru",
                    navLinks: true, // can click day/week names to navigate views
                    selectable: true,
                    selectMirror: true,
                    select: function(arg) {
                        var title = prompt('Event Title:');
                        if (title) {
                            calendar.addEvent(
                                {title: title, start: arg.start, end: arg.end, allDay: arg.allDay}
                            )
                        }
                        calendar.unselect()
                    },
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: []
                });

                calendar.render();
            });

            jQuery(document).ready(function() {
                // Select2
                jQuery("#select-basic, #select-multi").select2();
                jQuery('#select-search-hide').select2({minimumResultsForSearch: -1});
            });
            $(document).ready(function() {
                $('#myTable').DataTable({

                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
                    }
                });
            });

            $(document).ready(function() {
                $('#changeWorkerInRequest').DataTable({

                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Russian.json"
                    }
                });
            });

            function addquestion() {
                const div = document.createElement('div');

                div.className = 'row';

                var value = parseInt(document.getElementById('number').value, 10);
                value = isNaN(value) ?
                    0 :
                    value;
                value++;

                document
                    .getElementById('number')
                    .value = value;

                div.innerHTML = `
        <div class="panel panel-default">
            <div class="panel-heading">
                    <div class="panel-btns" style="display: none;">

                        <a href="" class="panel-close tooltips" data-toggle="tooltip" title=""
                            data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                    </div><!-- panel-btns -->

                </div>
                <div class="panel-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="question_` +
                    value +
                    `" placeholder="Заголовок" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="desc_question_` +
                    value +
                    `" rows="9" placeholder="Описание"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="rdio rdio-default">
                                    <input type="radio" value="1" name="question_type_` +
                    value +
                    `" id="standartAnswers" checked="checked">
                                    <label for="standartAnswers">Стандартные ответы</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="rdio rdio-default">
                                    <input type="radio" value="1" name="question_type_` +
                    value +
                    `" id="NotstandartAnswers">
                                    <label for="NotstandartAnswers">Не стандартные ответы</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="question_` +
                    value +
                    `_answer_1" placeholder="Ответ 1" class="form-control"><br>
                                <input type="text" name="question_` +
                    value +
                    `_answer_2" placeholder="Ответ 2" class="form-control"><br>
                                <input type="text" name="question_` +
                    value +
                    `_answer_3" placeholder="Ответ 3" class="form-control"><br>
                                <input type="text" name="question_` +
                    value +
                    `_answer_4" placeholder="Ответ 3" class="form-control"><br>
                                <input type="text" name="question_` +
                    value +
                    `_answer_5" placeholder="Ответ 3" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Фотографии</label>

                                <input type="file" name="photo_1_question_` +
                    value +
                    `"><br/>
                                <input type="file" name="photo_2_question_` +
                    value +
                    `"><br/>
                                <input type="file" name="photo_3_question_` +
                    value +
                    `"><br/>
                                <input type="file" name="photo_4_question_` +
                    value +
                    `">

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Документы</label>

                                <input type="file" name="doc1_question_` +
                    value +
                    `"> <br/>
                                <input type="file" name="doc2_question_` +
                    value +
                    `"><br/>
                                <input type="file" name="doc3_question_` +
                    value +
                    `"><br/>
                                <input type="file" name="doc4_question_` +
                    value +
                    `">


                            </div>
                        </div>

                    </div>
                </div>
            </div>
    `;

                document
                    .getElementById('question')
                    .append(div);
            }
        </script>


        <script type="text/javascript">
            $(document).ready(function() {
                // var x = document.getElementsByClassName("menu");   console.log(x[0].id);
                // for(int =i ; i<x.length; i++){        if(x[i].id == document.location.href){
                // }           } f(x[0].id==window.location;) Bar chart
                new Chart(document.getElementById("bar-chart"), {
                    type: 'bar',
                    data: {
                        labels: [
                            "1 неделя", "2 неделя", "3 неделя", "4 неделя"
                        ],
                        datasets: [{
                            label: "Количество жителей",
                            backgroundColor: [
                                "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"
                            ],
                            data: [2, 5, 7, 1]
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Количество жителей'
                        }
                    }
                });
                //PIE CHART
                new Chart(document.getElementById("pie-chart"), {
                    type: 'pie',
                    data: {
                        labels: [
                            "Выполнено", "В ожидании", "Отклонено", "Принято"
                        ],
                        datasets: [{
                            label: "Статусы: ",
                            backgroundColor: [
                                "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"
                            ],
                            data: [2478, 5267, 734, 784]
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Заявки'
                        }
                    }
                });

                // Bar chart2
                new Chart(document.getElementById("bar-chart2"), {
                    type: 'bar',
                    data: {
                        labels: [
                            "1 неделя", "2 неделя", "3 неделя", "4 неделя"
                        ],
                        datasets: [{
                            label: "Количество голосований",
                            backgroundColor: [
                                "#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"
                            ],
                            data: [15, 12, 7, 41]
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Количество голосований'
                        }
                    }
                });
            });
        </script>
    </body>

</html>