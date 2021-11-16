<!--Sliders Section-->
<section>
    <div class="banner-1 cover-image sptb-3 pb-10 sptb-tab " data-image-src="../assets/images/homepage/almaty.jpg">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white mb-7">
                    <h1 class="mb-1">{STR_E_HOME_WELCOME}</h1>
                    <p>{STR_E_HOME_WELCOME_SUBTITLE}</p>
                </div>
                <div class="row">
                    <div class="col-xl-10 col-lg-12 col-md-12 d-block mx-auto">
                        <div class="search-background bg-transparent">
                            <div class="form row no-gutters">
                                <div class="form-group col-xl-3 col-lg-3 col-md-12 select2-lg  mb-0 bg-white">
                                    <select class="form-control select2-show-search border-bottom-0 select2-universal" id="all-cities" onclick="getStreets()" data-placeholder="{STR_SELECT_CITY_TITLE}" required>

                                        {STREETS}
                                    </select>
                                </div>
                                <div class="form-group col-xl-3 col-lg-3 col-md-12 select2-lg  mb-0 bg-white">
                                    <select class="form-control select2-show-search  border-bottom-0 select2-universal" id="all-street-in-cities" onchange="getHouses()" data-placeholder="{STR_ENTER_STREET_TITLE}" required>

                                    </select>
                                </div>
                                <div class="form-group col-xl-3 col-lg-3 col-md-12 select2-lg  mb-0 bg-white">
                                    <select class="form-control select2-show-search  border-bottom-0 select2-universal" id="all-house-in-streets" data-placeholder="STR_SELECT_HOUSE_TITLE" required>

                                    </select>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-md-12 mb-0">
                                    <button type="submit" class="btn btn-lg btn-block btn-secondary br-tl-md-0 br-bl-md-0" onclick="goOsi('{LANG_INDEX}')"><i class="fa fa-search mr-1"></i>{STR_SEARCH}</button>
                                </div>
                                <div class="mt-2">

                                    <a href="#" data-toggle="modal" data-target="#home-send-application">

                                        <p class="text-white">{STR_NOT_FIND_APARTMENT}</p>

                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /header-text -->
        <div class="header-slider-img">
            <div class="container">
                <div id="small-categories" class="owl-carousel owl-carousel-icons7">
                    <div class="item">
                        <div class="card mb-0">
                            <div class="card-body p-3">
                                <div class="cat-item d-flex">
                                    <!-- stas delete links -->
                                    <div class="cat-img mr-4 bg-primary-transparent p-3 brround">
                                        <img src="../assets/images/homepage/icons/citizen.png" alt="img">
                                    </div>
                                    <div class="cat-desc text-left">
                                        <h5 class="mb-3 mt-0">{STR_RESIDENTS}</h5>
                                        <small class="badge badge-pill badge-primary mr-2">25</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card mb-0">
                            <div class="card-body p-3">
                                <div class="cat-item d-flex">
                                    <!-- stas delete links -->
                                    <div class="cat-img mr-4 bg-secondary-transparent p-3 brround">
                                        <img src="../assets/images/homepage/icons/osi.png" alt="img">
                                    </div>
                                    <div class="cat-desc text-left">
                                        <h5 class="mb-3">{STR_TPL_AUTHOR_STATUS_3_TITLE}</h5>
                                        <small class="badge badge-pill badge-secondary mr-2">{OSI_COUNT}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card mb-0">
                            <div class="card-body p-3">
                                <div class="cat-item d-flex">
                                    <!-- stas delete links -->
                                    <div class="cat-img mr-4 bg-success-transparent p-3 brround">
                                        <img src="../assets/images/homepage/icons/uc.png" alt="img">
                                    </div>
                                    <div class="cat-desc text-left">
                                        <h5 class="mb-3">{STR_SUPPLIERS_RP}</h5>
                                        <small class="badge badge-pill badge-success mr-2">{UCS_COUNT}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="card mb-0">
                            <div class="card-body p-3">
                                <div class="cat-item d-flex">
                                    <!-- stas delete links -->
                                    <div class="cat-img mr-4 bg-danger-transparent p-3 brround">
                                        <img src="../assets/images/homepage/icons/home.png" alt="img">
                                    </div>
                                    <div class="cat-desc text-left">
                                        <h5 class="mb-3">{STR_HOUSES}</h5>
                                        <small class="badge badge-pill badge-danger mr-2">{HOUSES_COUNT}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Sliders Section-->



<!-- Categories-->
<section class="sptb pt-5">
    <div class="container">
        <div class="section-title center-block text-center">
            <h2>{STR_ABOUT_PORTAL}</h2>
            <p style="font-style: normal;">{STR_PORTAL_SHORT_DESCRIPTION}</p>
        </div>
        <div class="item-all-cat center-block text-center education-categories">
            <div class="row">
                <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6">
                    <div class="item-all-card text-dark text-center">
                        <a href="/ru/about_requests"></a>
                        <div class="iteam-all-icon">
                            <img src="../assets/images/icons/playlist.png" alt="Cashier">
                        </div>
                        <div class="item-all-text mt-3">
                            <h5 class="mb-0 text-body">{STR_REQUEST_TITLE}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6">
                    <div class="item-all-card text-dark text-center">
                        <a href="/ru/about_pool"></a>
                        <div class="iteam-all-icon">
                            <img src="../assets/images/icons/vote.png" class="imag-service" alt="beautician">
                        </div>
                        <div class="item-all-text mt-3">
                            <h5 class="mb-0 text-body">{STR_POLL_TITLE}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6">
                    <div class="item-all-card text-dark text-center">
                        <a href="/ru/about_notice"></a>
                        <div class="iteam-all-icon">
                            <img src="../assets/images/icons/bell.png" class="imag-service" alt="Driver">
                        </div>
                        <div class="item-all-text mt-3">
                            <h5 class="mb-0 text-body">{STR_NOTIFICATION}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6">
                    <div class="item-all-card text-dark text-center">
                        <a href="/ru/about_smeta"></a>
                        <div class="iteam-all-icon">
                            <img src="../assets/images/icons/house.png" class="imag-service" alt="Hardware">
                        </div>
                        <div class="item-all-text mt-3">
                            <h5 class="mb-0 text-body">{STR_SMETA_TITLE}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6">
                    <div class="item-all-card text-dark text-center">
                        <a href="/ru/portal_suppliers/"></a>
                        <div class="iteam-all-icon">
                            <img src="../assets/images/icons/people.png" class="imag-service" alt="operator">
                        </div>
                        <div class="item-all-text mt-3">
                            <h5 class="mb-0 text-body">{STR_SUPPLIERS}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-2 col-md-4 col-sm-6">
                    <div class="item-all-card text-dark text-center">
                        <a href="/ru/portal_osi/"></a>
                        <div class="iteam-all-icon">
                            <img src="../assets/images/icons/home.png" class="imag-service" alt="nurse">
                        </div>
                        <div class="item-all-text mt-3">
                            <h5 class="mb-0 text-body">{STR_USER_TYPE_2_TITLE}</h5>
                        </div>
                    </div>
                </div>

            </div>
            <!-- stas change data-target="#add-request" to data-target="#add-citizen" -->
            <a class="btn btn-primary text-white" data-toggle="modal" data-target="#home-send-application">{STR_SUBMIT_YOUR_APPLICATION}</a>

        </div>
    </div>
</section>
<!--Categories-->


<!--Как это работает-->
<section class="sptb bg-white pt-5">
    <div class="container">
        <div class="section-title center-block text-center">
            <h2>{STR_HOW_IT_WORKS}</h2>

        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <div class="service-card text-center">
                            <div class="bg-white icon-bg  icon-service text-purple">
                                <img src="../assets/images/svgs/jobs/find.svg" alt="img">
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">{STR_REGISTER}</h4>
                                <p class="text-muted mb-0">{STR_REGISTER_AS_RESIDENT}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <div class="service-card text-center">
                            <div class="bg-white icon-bg icon-service text-purple">
                                <img src="../assets/images/svgs/jobs/pay.svg" alt="img">
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">{STR_ENTER_YOUR_ADDRESS_AND_HOUSE}</h4>
                                <p class="text-muted mb-0">{STR_ADD_YOUR_APPARTMENT}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="mb-lg-0 mb-4">
                        <div class="service-card text-center">
                            <div class="bg-white icon-bg  icon-service text-purple">
                                <img src="../assets/images/svgs/jobs/hire.svg" alt="img">
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">{STR_WAIT_OSI}</h4>
                                <p class="text-muted mb-0">{STR_AFTER_OSI_CONFIRMATION}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="">
                    <div class="">
                        <div class="service-card text-center">
                            <div class="bg-white icon-bg  icon-service text-purple">
                                <img src="../assets/images/svgs/jobs/work.svg" alt="img">
                            </div>
                            <div class="servic-data mt-3">
                                <h4 class="font-weight-semibold mb-2">{STR_USE_ALL_SERVICES}</h4>
                                <p class="text-muted mb-0">{STR_GET_NOTIFICATION}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Как это работает-->

<!--База знаний-->
<section class="sptb pt-5">
    <div class="container">
        <div class="col-md-12">
            <h3 class="widget-title fs-16 mt-6">{STR_KNOWLEDGE_BASE_NAME_TITLE}</h3>
            <hr class="widget-hr">
        </div>
        <div class="card">
            <div class=" card-body items-gallery">
                <div class="items-blog-tab text-center">
                    <div class="row">
                        {KNOWLEDGE}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--База знаний-->
<!--section-->
<section class="sptb pt-5">
    <div class="container">
        <div class="section-title center-block text-center">
            <h2>{STR_OSI_RAITING}</h2>
            <p>{STR_OSI_LIST}</p>
        </div>
        <div id="feature-carousel" class="owl-carousel owl-carousel-icons">
            {OSI_LIST}
        </div>
    </div>
</section>
<!--/section-->

<!--Партнеры-->
<section class="sptb pt-5">
    <div class="container">
        <div class="section-title center-block text-center">
            <h1>{STR_OUR_PARTNERS}</h1>
        </div>
        <div id="company-carousel" class="owl-carousel owl-carousel-icons4 owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(-1401px, 0px, 0px); transition: all 0.25s ease 0s; width: 4004px;">
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/3.png" alt="company3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/4.png" alt="company4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/5.png" alt="company5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/6.png" alt="company6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/7.png" alt="company7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/8.png" alt="company8">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/1.png" alt="company1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/2.png" alt="company2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/3.png" alt="company3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/4.png" alt="company4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/5.png" alt="company5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/6.png" alt="company6">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/7.png" alt="company7">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/8.png" alt="company8">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/1.png" alt="company1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/2.png" alt="company2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/3.png" alt="company3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/4.png" alt="company4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/5.png" alt="company5">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="owl-item cloned" style="width: 175.167px; margin-right: 25px;">
                        <div class="item">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <img src="../assets/images/clients/6.png" alt="company6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
            <div class="owl-dots disabled"></div>
        </div>
    </div>
</section>
<!--Партнеры-->

<!-- stas add modal -->

<!-- Оставить заявку Modal -->
<div class="modal fade" id="home-send-application" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">{STR_SEND_APPLICATION}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vscroll" style="max-height:700px">
                <form method="post" action="?">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_EMAIL}:</label>
                        <input class="form-control fc-datepicker" id="homepageModalEmail" required placeholder="{STR_ENTER_MAIL}" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_PHONE_PLACEHOLDER_TITLE}:</label>
                        <input class="form-control fc-datepicker" id="homepageModalName" required placeholder="{STR_ENTER_PHONE_NUMBER}" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_ADDRESS_PLACEHOLDER_TITLE}:</label>
                        <input class="form-control fc-datepicker" id="homepageModalAdress" required placeholder="{STR_ENTER_ADRESS_U}" type="text" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                <button type="submit" class="btn btn-primary" onclick="homepageRequestForm()">{STR_SEND_TITLE}</button>
            </div>
        </div>
    </div>
</div>