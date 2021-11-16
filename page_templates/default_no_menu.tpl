<!doctype html>
<html lang="en" dir="ltr">

    <head>
        <base href="https://e-home.kz/">
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">




        <meta content="{META_TAGS}" name="keywords">




        <meta content="{META_DESCRIPTION}" name="description">
        <meta content="Страница с подменю вложенных разделов 1|Page with sub pages menu 1|Страница с подменю вложенных разделов 1" name="template">
        <meta name="Robots" content="INDEX, FOLLOW">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <!-- Title -->
        <title>{SITE_WINDOW_TITLE} :: {WINDOW_PAGE_TITLE}</title>

        <!-- Bootstrap Css -->
        <link href="../assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" />


        <!-- Dashboard Css -->
        <link href="../assets/css/style.css" rel="stylesheet" />

        <!-- Font-awesome  Css -->
        <link href="../assets/css/icons.css" rel="stylesheet" />

        <!--Horizontal Menu-->
        <link href="../assets/plugins/horizontal/horizontal-menu/animation/fade-down.css" rel="stylesheet" />
        <link href="../assets/plugins/horizontal/horizontal-menu/horizontal.css" rel="stylesheet" />

        <!--Select2 Plugin -->
        <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet" />

        <!-- Cookie css -->
        <link href="../assets/plugins/cookie/cookie.css" rel="stylesheet">

        <!-- Custom scroll bar css-->
        <link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

        <!-- owl-carousel-->
        <link href="../assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />


        <link href="../assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
        <link href="../assets/plugins/datatable/jquery.dataTables.min.css" rel="stylesheet" />


        <!-- Data table css -->
        <link rel="stylesheet" href="https://cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">


        <!--fulcalendar -->
        <link href='../assets/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
        <link href='../assets/plugins/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

        <!-- WYSIWYG Editor css -->
        <link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />

        <!-- COLOR-SKINS -->
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/color-skins/color-skins/color10.css" />

        <!-- file Uploads -->
        <link href="../assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />

        <!-- Gallery -->
        <link href="../assets/plugins/gallery/gallery.css" rel="stylesheet">

        <!-- CONFIRM -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

        <!-- Custom CSS -->
        <link href="../assets/css/custom.css" rel="stylesheet" />

    </head>

    <body>

        <!--Loader-->
        <div id="global-loader">
            <img src="../assets/images/loader.svg" class="loader-img" alt="">
        </div>

        <!--Header Main-->
        <div class="header-main">
            <!--Top Bar-->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-2 col-6">
                            <div class="top-bar-left d-flex">
                                <div class="clearfix">
                                    <ul class="socials">
                                        <li>
                                            <a class="social-icon" href="https://www.facebook.com/freelancekazakhstan/"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon" href="#"><i class="fa fa-telegram"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon" href="#"><i class="fa fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="item1-links  mb-0" style="display: none;">
                            {MENU_TOP}
                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-10 col-6">
                            <div class="top-bar-right">
                                <ul class="custom">
                                    <li class="dropdown">
                                        <a href="/ru/auth" class="" data-toggle="{DROPDOWN}"><i class="fa fa-user mr-1"></i><span>{LOGIN}{TPL_NAME_VALUE}</span></a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            {MENU_EX}
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/ru/partners/" class=""><i class="fa fa-black-tie mr-1"></i> <span>{STR_FOR_PARTNERS}</span></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Top Bar-->

            <!-- Mobile Header -->
            <div class="horizontal-header clearfix ">
                <div class="container">
                    <a id="horizontal-navtoggle" class="animated-arrow"><span></span></a>
                    <span class="smllogo"><img src="../assets/images/brand/logo.png" width="120" alt="" /></span>
                    <a href="#" class="callusbtn bg-light"><i class="fa fa-bell text-body" aria-hidden="true"></i></a>
                </div>
            </div>
            <!-- /Mobile Header -->


            <!--Horizontal-main-->
            <div class="horizontal-main clearfix">
                <div class="horizontal-mainwrapper container clearfix">
                    <div class="desktoplogo">
                        <a href="{LANG_INDEX}/home"><img src="../assets/images/brand/logo.png" alt=""></a>
                    </div>
                    <div class="desktoplogo-1">
                        <a href="{LANG_INDEX}/home"><img src="../assets/images/brand/logo.png" alt=""></a>
                    </div>
                    <!--Nav-->
                    <nav class="horizontalMenu clearfix d-md-flex">
                        <ul class="horizontalMenu-list">
                            {MENU_TOP2}

                        </ul>

                    </nav>
                    <!--/Nav-->
                </div>
            </div>
            <!--/Horizontal-main-->


        </div>
        <!--/Header Main-->

        <!--Breadcrumb-->
        <section>
            <div class="bannerimg cover-image bg-background3" data-image-src="../assets/images/banners/banner2.jpg">
                <div class="header-text mb-0">
                    <div class="container">
                        <div class="text-center text-white">
                            <h1 class="">{PAGE_TITLE}</h1>
                            <ol class="breadcrumb text-center">
                                <li class="breadcrumb-item"><a href="#">Главная</a></li>
                                <li class="breadcrumb-item active text-white" aria-current="page">{PAGE_TITLE}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Breadcrumb-->

        <!--User Dashboard sptb-->
        <section class="sptb content-body-section">
            <div class="container">
                <div class="row">
                    {CONTENT}
                </div>
            </div>
        </section>
        <!--/User Dashboard-->

        <!-- Onlinesletter-->
        <section class="sptb bg-white border-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-xl-6 col-md-12">
                        <div class="sub-newsletter">
                            <h3 class="mb-2"><i class="fa fa-paper-plane-o mr-2"></i> Cлужба поддержки</h3>
                            <p class="mb-0">Если возникли вопросы просим вас аисать
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-6 col-md-12">
                        <div class="input-group sub-input mt-1">
                            <input type="text" class="form-control input-lg " placeholder="Напишите нам">
                            <div class="input-group-append ">
                                <button type="button" class="btn btn-primary btn-lg br-tr-3  br-br-3">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/Onlinesletter-->

        <!--Footer Section-->
        <section>
            <footer class="bg-dark text-white cover-image" data-image-src="../assets/images/banners/banner3.jpg">

                <div class="text-white-50 border-top p-0">
                    <div class="container">
                        <div class="row d-flex">
                            <div class="col-lg-8 col-sm-12  mt-2 mb-2 text-left ">
                                Сертефикат © 2019 <a href="index.html" class="fs-14 text-white">E-home</a>. Разаработано <a href="spruko.com" class="fs-14 text-white">Алиш и компания</a>
                            </div>
                            <div class="col-lg-4 col-sm-12 ml-auto mb-2 mt-2 d-none d-lg-block">
                                <ul class="social mb-0">
                                    <li>
                                        <a class="social-icon" href=""><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" href=""><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" href=""><i class="fa fa-telegram"></i></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-white p-0 border-top">
                    <div class="container">
                        <div class="p-2 text-center footer-links">
                            <a href="#" class="btn btn-link">Главная</a>
                            <a href="#" class="btn btn-link">Рейтинг Оси</a>
                            <a href="#" class="btn btn-link">Рейтинг УК</a>
                            <a href="#" class="btn btn-link">База знаний</a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
        <!--Footer Section-->



        <!-- Back to top -->
        <a href="#top" id="back-to-top"><i class="fa fa-arrow-up"></i></a>

        <!-- JQuery js-->
        <!-- <script src="../assets/js/vendors/jquery-3.2.1.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

        <!-- Bootstrap js -->
        <script src="../assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js"></script>
        <script src="../assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>

        <!--JQuery Sparkline Js-->
        <script src="../assets/js/vendors/jquery.sparkline.min.js"></script>

        <!-- Circle Progress Js-->
        <script src="../assets/js/vendors/circle-progress.min.js"></script>

        <!-- Star Rating Js-->
        <script src="../assets/plugins/rating/jquery.rating-stars.js"></script>

        <!--Owl Carousel js -->
        <script src="../assets/plugins/owl-carousel/owl.carousel.js"></script>

        <!--Horizontal Menu-->
        <script src="../assets/plugins/horizontal/horizontal-menu/horizontal.js"></script>

        <!--JQuery TouchSwipe js-->
        <script src="../assets/js/jquery.touchSwipe.min.js"></script>

        <!--Select2 js -->
        <script src="../assets/plugins/select2/select2.full.min.js"></script>
        <script src="../assets/js/select2.js"></script>

        <!-- Count Down-->
        <script src="../assets/plugins/count-down/jquery.lwtCountdown-1.0.js"></script>

        <!-- Custom scroll bar Js-->
        <script src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- sticky Js-->
        <script src="../assets/js/sticky.js"></script>

        <!-- Scripts Js-->
        <script src="../assets/js/scripts2.js"></script>

        <!-- Custom Js-->
        <script src="../assets/js/custom.js"></script>
        <script src="script.js"></script>

        <!-- Data tables -->
        <script src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

        <!-- Datatable-->
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
        <script src="../assets/js/datatable.js"></script>

        <script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>
        <script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.min.js'></script>
        <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>
        <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src='https://unpkg.com/fullcalendar@3.10.2/dist/fullcalendar.min.js'></script>

        <script src='https://unpkg.com/fullcalendar@3.10.2/dist/locale-all.js'></script>

        <!-- file uploads js -->
        <script src="../assets/plugins/fileuploads/js/dropify.js"></script>

        <!-- Gallery js -->
        <script src="../assets/plugins/gallery/picturefill.js"></script>
        <script src="../assets/plugins/gallery/lightgallery.js"></script>
        <script src="../assets/plugins/gallery/lg-pager.js"></script>
        <script src="../assets/plugins/gallery/lg-autoplay.js"></script>
        <script src="../assets/plugins/gallery/lg-fullscreen.js"></script>
        <script src="../assets/plugins/gallery/lg-zoom.js"></script>
        <script src="../assets/plugins/gallery/lg-hash.js"></script>
        <script src="../assets/plugins/gallery/lg-share.js"></script>
        <script src="../assets/js/gallery.js"></script>

        <!-- confirm -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

        <script>
            //var editor = new FroalaEditor('#editor');

            $(document).on("click", "#OSIpushToUCButton", function() {
                var id = $(this).data('id');
                $(".modal-body #id").val(id);

            });

            $(document).on("click", "#UCpushRequestOSIButton", function() {
                var id = $(this).data('id');
                $(".modal-body #id").val(id);

            });

            $(document).on("click", ".OSIpushToUCWithoutAccept", function() {
                var executor = $(this).data('id');
                $(".modal-body #executor").val(executor);

            });
            $(document).on("click", ".OSIpushToUCNotAccept", function() {
                var executor = $(this).data('id');
                $(".modal-body #executor").val(executor);

            });
            $(document).on("click", ".OSIpushToUCWithoutAccept", function() {
                var executor = $(this).data('id');
                $(".modal-body #executor").val(executor);

            });

            $(document).on("click", "#AddReviewButton", function() {
                var id = $(this).data('id');
                var wroter_type = $(this).data('stuff');
                var wroter = $(this).data('author');

                $(".modal-body #id").val(id);
                $(".modal-body #wroter_type").val(wroter_type);
                $(".modal-body #wroter").val(wroter);


            });

            $(document).on("click", "#NotFinishedRequestButton", function() {
                var id = $(this).data('id');
                var wroter_type = $(this).data('stuff');
                var wroter = $(this).data('author');

                $(".modal-body #id").val(id);
                $(".modal-body #wroter_type").val(wroter_type);
                $(".modal-body #wroter").val(wroter);


            });

            $(document).on("click", "#notAcceptRequest", function() {
                var id = $(this).data('id');
                var wroter_type = $(this).data('stuff');
                var wroter = $(this).data('author');

                $(".modal-body #id").val(id);
                $(".modal-body #wroter_type").val(wroter_type);
                $(".modal-body #wroter").val(wroter);


            });

            $(document).on("click", "#CancelRequestButton", function() {
                var id = $(this).data('id');
                var executor_type = $(this).data('stuff');
                $(".modal-body #id").val(id);
                $(".modal-body #executor_type").val(executor_type);

            });

            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        </script>

    </body>

</html>