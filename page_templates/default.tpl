<!doctype html>
<html lang="en" dir="ltr">
<!-- DEFAULT -->

<head>
    <base href="http://kaznpu2.test/">
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="{META_TAGS}" name="keywords">
    <meta content="{META_DESCRIPTION}" name="description">
    <meta content="E-home.kz | Онлайн КСК" name="template">
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
    <!-- STYLES START-->
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
    <!-- Custom scroll bar css-->
    <link href="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />
    <!-- owl-carousel-->
    <link href="../assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" />
    <!-- Data table css -->
    <link href="../assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="../assets/plugins/datatable/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <!--fulcalendar -->
    <link href='../assets/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
    <link href='../assets/plugins/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" rel="stylesheet" />
    <!-- WYSIWYG Editor css -->
    <link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <!-- COLOR-SKINS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/color-skins/color-skins/color10.css" />
    <!-- file Uploads -->
    <link href="../assets/plugins/fileuploads/css/dropify.css" rel="stylesheet" type="text/css" />
    <!-- Gallery -->
    <link href="../assets/plugins/gallery/gallery.css" rel="stylesheet">
    <!-- Time picker Plugin -->
    <link href="../assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />
    <!-- Date Picker Plugin -->
    <link href="../assets/plugins/date-picker/spectrum.css" rel="stylesheet" />
    <!-- CONFIRM -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- Загружаем в начале так как проверяем заполнения данных на сайте -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- confirm -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>

    <script src="../assets/plugins/morris/raphael-min.js"></script>
    <script src="../assets/plugins/morris/morris.js"></script>

    <link href="../assets/css/custom.css" rel="stylesheet">

    <!-- Notifications  Css -->
    <link href="../assets/plugins/notify/css/jquery.growl.css" rel="stylesheet" />

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
                                        <a class="social-icon" ><i class="fa fa-telegram"></i></a>
                                    </li>
                                    <li>
                                        <a class="social-icon" ><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-10 col-6">
                        <div class="top-bar-right">
                            <ul class="custom">
                                <li class="dropdown">
                                    <a href="/ru/auth" class="" data-toggle="dropdown"><i class="fa fa-user mr-1"></i>
                                        <span>{TPL_NAME_VALUE}</span></a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        {MENU_EX}
                                    </div>
                                </li>
                                <li>
                                    <a class=""><i class="fa fa-black-tie mr-1"></i> <span>{STR_FOR_PARTNERS}</span></a>
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
    <section class="sptb user-dashboard-section">
        <div class="">
            <div class="row">
                <div class="col-xl-2 col-lg-12 col-md-12 user-left-column">

                    <div class="card">
                        <div class="card-body text-center item-user border-bottom">
                            <div class="profile-pic">
                                <div class="profile-pic">
                                    <span class="avatar cover-image avatar-xxl bradius" data-image-src="{TPL_IMAGE_VALUE}" style=""></span> <!-- data-image-src="../assets/images/users/empty_logo.png" стандартное фото у кого нет  -->
                                </div>

                                <p class="mt-3 mb-0 font-weight-semibold">{TPL_NAME_VALUE}</p>

                                <p class="text-muted mb-1"><span class="text-dark"></span> {TPL_PHONE_VALUE}</p>
                                <p class="text-muted mb-1"><span class="text-dark"></span> {TPL_TYPE_VALUE}</p>

                            </div>
                        </div>
                    </div>
                    <div class="card user-menu" style="background-color: #F0F3FA;">
                        <div class="item1-links  mb-0">
                            {MENU_TOP}
                        </div>
                    </div>
                </div>
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
                        <h3 class="mb-2"><i class="fa fa-paper-plane-o mr-2"></i>{STR_SUPPORT}</h3>
                        <p class="mb-0">{STR_IF_YOU_HAVE_QUESIONS}
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 col-xl-6 col-md-12">
                    <div class="input-group sub-input mt-1">
                        <input type="text" class="form-control input-lg " placeholder="{STR_CONTACT_US}">
                        <div class="input-group-append ">
                            <button type="button" class="btn btn-primary btn-lg br-tr-3  br-br-3">
                                {STR_SEND_TITLE}
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
        <footer class="text-white footer-bgc">
            <div class="footer-main border-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 ">
                        </div>
                        <div class="col-lg-4 col-md-12 mb-2 ">
                            <h3 class="col-lg-12 col-md-5 col-sm-7 footer-text-p">{STR_MAKE_YOUR}<br>
                                {STR_LIFE_EASIER}</h3>
                            <p class="leading-none col-lg-12 col-md-7 col-sm-7 footer-text-p">{STR_SOLVE_YOUR_DOMESTIC}<br>
                                {STR_PROBLEMS_WITH_E_HOME}
                            </p>
                            <p>{STR_DOWNLOAD_APP_FREE}</p>
                            <div class="btn-list">
                                <button type="button" class="btn btn-white"><i class="fa fa-apple fa-1x mr-2"></i>App
                                    Store</button>
                                <button type="button" class="btn btn-white"><i class="fa fa-android fa-1x mr-2"></i>Google Play</button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 text-left">
                            <h4 class="footer-text-p">{STR_CONTACT_US_IF_YOUR}<br>
                                {STR_OSI_NOT_IN_DATABASE}</h4>
                                <form method="post" action="mail.php">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-12">
                                        <input class="form-control " type="text" id="exampleInputname" name="email" placeholder="{STR_EMAIL}">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12">

                                        <input class="form-control " type="text" id="exampleInputname" name="city" placeholder="{STR_CITY_TITLE}">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input class="form-control " type="text" id="exampleInputname" name="street" placeholder="{STR_STREET_TITLE}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-white br-tr-3  br-br-3">
                                    {STR_CREATE_ORDER_TITLE}
                                </button>
                                </form>
                        </div>
                        <div class="col-lg-2 col-md-12 text-left">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-white-50 p-0">
                <div class="container">
                    <div class="row d-flex">
                        <div class="col-lg-2 col-md-12 text-left">
                        </div>
                        <div class="col-lg-4 col-sm-12  mt-2 mb-2 text-left ">
                            {STR_ELECTRONIC_GOVERMENT_KSK}
                        </div>
                        <div class="col-lg-4 col-sm-12 ml-auto mb-2 mt-1 d-none d-lg-block">
                            <ul class="social mb-0">
                                <li>
                                    <a href="/ru/contacts/" class="btn btn-link ">{STR_CONTACTS}</a>
                                </li>
                                <li>
                                    <a href="/ru/faq/" class="btn btn-link">FAQ</a>
                                </li>
                                <li>
                                    <a href="/ru/about_application/" class="btn btn-link">{STR_ABOUT_APPLICATION}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-12 text-left">
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!--Footer Section-->
    <!-- Back to top -->
    <a href="#top" id="back-to-top"><i class="fa fa-arrow-up"></i></a>
    <!-- Notification -->
    {TPL_USER_NOTICE_FLOAT_BUTTON}
    <!-- Notification -->
    <a href="#" data-toggle="modal" data-target="#information" id="notification"><span class="notification-text info">{STR_INFORMATION}</span><i class="fa fa-info"></i></a>

    <!-- SCRIPTS -->
    <!-- JQuery js-->
    <script src="https://malsup.github.io/jquery.form.js"></script>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src='https://unpkg.com/fullcalendar@3.10.2/dist/fullcalendar.min.js'></script>
    <script src='https://unpkg.com/fullcalendar@3.10.2/dist/locale-all.js'></script>
    <!-- file uploads js -->
    <script src="../assets/js/formelements.js"></script>
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
    <!-- Timepicker js -->
    <script src="../assets/plugins/time-picker/jquery.timepicker.js"></script>
    <script src="../assets/plugins/time-picker/toggles.min.js"></script>
    <!-- Datepicker js -->
    <script src="../assets/plugins/date-picker/spectrum.js"></script>
    <script src="../assets/plugins/date-picker/jquery-ui.js"></script>
    <script src="../assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- Notifications js -->
    <script src="../assets/plugins/notify/js/rainbow.js"></script>
    <script src="../assets/plugins/notify/js/jquery.growl.js"></script>


    <!-- Custom Js-->
    <script src="../assets/js/custom.js"></script>
    <script src="script.js"></script>
    <script src="../assets/js/inputmask.js"></script>
    <script src="../assets/js/all-functions.js"></script>
    <script src="../assets/js/scripts.js"></script>

    <!-- Input mask initialization Js-->
    <script src="../assets/plugins/input-mask/jquery.maskedinput.js"></script>
    <script src="../assets/js/inputmask.js"></script>
    <script src="../assets/js/mask.js"></script>

    <script>

    $(function() {


        var hash = window.location.hash;

        hash ?  $("a[href='"+hash+"']").click()  : $('.tabs li:first').click()

    });


    $(document).ready(function () {
    $('body,html').animate({scrollTop: 0}, 0);
    });
      </script>

</body>

</html>
