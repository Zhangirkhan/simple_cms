<!doctype html>
<html lang="en" dir="ltr">
<!-- PORTAL --->
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


        <!-- Title -->
        <title>{SITE_WINDOW_TITLE} :: {WINDOW_PAGE_TITLE}</title>
        
        <link rel="stylesheet" href="../assets/plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css"  />
        <!-- Dashboard Css -->
        <link  href="../assets/css/style.css" rel="stylesheet"  />
        <!-- Font-awesome  Css -->
        <link href="../assets/css/icons.css" rel="stylesheet" />
        <!--Horizontal Menu-->
        <link href="../assets/plugins/horizontal/horizontal-menu/animation/fade-down.css" rel="stylesheet"  />
        <link href="../assets/plugins/horizontal/horizontal-menu/horizontal.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../assets/color-skins/color-skins/color10.css" rel="stylesheet" />
        <link href="../assets/css/custom.css" rel="stylesheet" />
        <style>
.checked {
  color: orange;
  padding-right:2px ;
  
}
.fa-star:not(.checked){
    color:gray;
}
</style>
        
        
        <!--<link href="../assets/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" /> -->
       
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
                                            <a class="social-icon"><i class="fa fa-telegram"></i></a>
                                        </li>
                                        <li>
                                            <a class="social-icon"><i class="fa fa-instagram"></i></a>
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

        {CONTENT}

        <!--Footer Section-->
        <section>
            <footer class="text-white footer-bgc">
                <div class="footer-main border-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-12 ">

                            </div>

                            <div class="col-lg-4 col-md-12 mb-2 ">
                                <h3 class="footer-text-p">{STR_MAKE_YOUR}<br>
                                {STR_LIFE_EASIER}</h3>
                                <p class="leading-none footer-text-p">{STR_SOLVE_YOUR_DOMESTIC}<br>
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
                                    <form action="mail.php" method="POST">
                                <div class="row">
                                    
                                    <div class="form-group col-lg-6 col-md-12">
                                        <input class="form-control" name="email" type="text" id="exampleInputname" placeholder="{STR_EMAIL}">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12">

                                        <input class="form-control" name="city" type="text" id="exampleInputname" placeholder="{STR_CITY_TITLE}">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input class="form-control" name="street" type="text" id="exampleInputname" placeholder="{STR_STREET_TITLE}">
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

        
        <!-- SCRIPTS -->
        <!-- JQuery js-->
        
        <!-- <sc1ript src="../assets/js/vendors/jquery-3.2.1.min.js"></script> -->
        <script  src="../assets/js/default/jquery-3.3.1.js" ></script>

        <script> 
        
        $(document).ready(function() {
           
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/select2/select2.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/scroll-bar/jquery.mCustomScrollbar.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/owl-carousel/owl.carousel.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/datatable/dataTables.bootstrap4.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/datatable/jquery.dataTables.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/css/dataTables.tableTools.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/css/buttons.dataTables.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/fullcalendar/fullcalendar.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/fullcalendar/fullcalendar.print.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/css/fullcalendar.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/wysiwyag/richtext.css' />");
            
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/fileuploads/css/dropify.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/gallery/gallery.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/time-picker/jquery.timepicker.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/plugins/date-picker/spectrum.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/css/jquery-confirm.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/css/flatpickr.min.css' />");
            $("head").append("<link rel='stylesheet' type='text/css' href='../assets/css/custom.css' />");
        
        });
        </script>


    <script async   src="../assets/js/default/jquery-confirm.min.js" ></script>
    <script async  src="../assets/js/default/flatpickr.js" ></script>
    <script async  src="../assets/js/default/flatpickr.min.js" ></script>
    <script async  src="../assets/js/default/ru.js" ></script>

    <!-- <sc1ript src="../assets/js/vendors/jquery-3.2.1.min.js"></script> -->
    <script async  src="../assets/js/default/jquery.form.js" ></script>
    <!-- Bootstrap js 
    <script src="../assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js" ></script>-->
    <script src="../assets/plugins/bootstrap-4.3.1-dist/js/popper.min.js" ></script>
    <script async  src="../assets/plugins/bootstrap-4.3.1-dist/js/bootstrap.min.js" ></script>
    <!--JQuery Sparkline Js-->
    <script async  src="../assets/js/vendors/jquery.sparkline.min.js" ></script>
    <!-- Circle Progress Js-->
    <script async  src="../assets/js/vendors/circle-progress.min.js" ></script>
    <!-- Star Rating Js-->
    <script async  src="../assets/plugins/rating/jquery.rating-stars.js" ></script>
    <!--Owl Carousel js -->
    <script async  src="../assets/plugins/owl-carousel/owl.carousel.js" ></script>
    <!--Horizontal Menu-->
    <script async  src="../assets/plugins/horizontal/horizontal-menu/horizontal.js" ></script>
    <!--JQuery TouchSwipe js-->
    <script async  src="../assets/js/jquery.touchSwipe.min.js" ></script>
    <!--Select2 js -->
    <script async  src="../assets/plugins/select2/select2.full.min.js" ></script>
    <script async  src="../assets/js/select2.js" ></script>
    <!-- Count Down-->
    <script async  src="../assets/plugins/count-down/jquery.lwtCountdown-1.0.js" ></script>
    <!-- Custom scroll bar Js-->
    <script async  src="../assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js" ></script>
    <!-- sticky Js-->
    <script async  src="../assets/js/sticky.js" ></script>
    <!-- Scripts Js-->
    <script async  src="../assets/js/scripts2.js" ></script>

    <!-- Data tables -->
    <script async  src="../assets/plugins/datatable/jquery.dataTables.min.js" ></script>
    <script async  src="../assets/plugins/datatable/dataTables.bootstrap4.min.js" ></script>
    <!-- Datatable-->
    <script async  src="../assets/js/default/dataTables.buttons.min.js" ></script>
    <script async  src="../assets/js/default/jszip.min.js" ></script>
    <!--  <script src="../assets/js/default/pdfmake.min.js" ></script> -->
    <script async  src="../assets/js/default/vfs_fonts.js" ></script>
    <script async  src="../assets/js/default/buttons.html5.min.js" ></script>
    <script async  src="../assets/js/default/buttons.print.min.js" ></script>
    <script async  src="../assets/js/datatable.js" ></script>
    <script async  src='../assets/js/default/coremain.min.js' ></script>
    <script async  src='../assets/js/default/interactionmain.min.js' ></script>
    <script async  src='../assets/js/default/daygridmain.min.js' ></script>
    <script async  src='../assets/js/default/timegridmain.min.js' ></script>

    <script async  src="../assets/js/default/jquery-ui.min.js" ></script>
    <script async  src="../assets/js/default/moment.min.js" ></script>
    <script async  src='../assets/js/default/fullcalendar.min.js' ></script>
    <script async  src='../assets/js/default/locale-all.js' ></script>
    <!-- file uploads js -->
    <!-- WYSIWYG Editor js -->
    <script async  src="../assets/plugins/wysiwyag/jquery.richtext.js" ></script>
    <script async  src="../assets/js/formeditor.js" ></script>

    <script async  src="../assets/js/formelements.js" ></script>
    <script async  src="../assets/plugins/fileuploads/js/dropify.js" ></script>
    <!-- Gallery js -->
    <script async  src="../assets/plugins/gallery/picturefill.js" ></script>
    <script async  src="../assets/plugins/gallery/lightgallery.js" ></script>
    <script async  src="../assets/plugins/gallery/lg-pager.js" ></script>
    <script async  src="../assets/plugins/gallery/lg-autoplay.js" ></script>
    <script async  src="../assets/plugins/gallery/lg-fullscreen.js" ></script>
    <script async  src="../assets/plugins/gallery/lg-zoom.js" ></script>
    <script async  src="../assets/plugins/gallery/lg-hash.js" ></script>
    <script async  src="../assets/plugins/gallery/lg-share.js" ></script>
    <script async  src="../assets/js/gallery.js" ></script>
    <!-- Timepicker js -->
    <script async  src="../assets/plugins/time-picker/jquery.timepicker.js" ></script>
    <script async  src="../assets/plugins/time-picker/toggles.min.js" ></script>
    <!-- Datepicker js -->
    <script async  src="../assets/plugins/date-picker/spectrum.js" ></script>
    <script async   src="../assets/plugins/date-picker/jquery-ui.js" ></script>
    <script async  src="../assets/plugins/input-mask/jquery.maskedinput.js" ></script>

        <!-- Custom Js-->
        <script async  src="../assets/js/custom.js"></script>
        <script async  src="script.js"></script>
        <script async src="../assets/js/loaderInit.js"></script>
    <script async src="../assets/js/dropifyInit.js"></script>
    <script async src="../assets/js/caruselInit.js"></script>
    <script async src="../assets/js/richtextInit.js"></script>
    <script async src="../assets/js/profile.js"></script>
        <script async  src="../assets/js/inputmask.js"></script>
        
        <script async  src="../assets/js/all-functions.js"></script>



    </body>

</html>