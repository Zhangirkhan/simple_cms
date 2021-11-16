    <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12">
        <div class="card user-content-right" id="requests">
            <div class="card-header">
                <h3 class="card-title">{PAGE_TITLE}</h3>
                <div class="card-options">
                    {BUTTON_ADD}
                </div>
            </div>


            <div class="card-body" id="card-body">
                <div class="ads-tabs">
                    <div class="tabs-menus">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs" style="line-height: 50px;">
                            <li><a href="#tab1" data-toggle="tab" class="active">{STR_NEW_REQUEST} <b style="color:red;">({NEW_REQUESTS_COUNT})</b></a></li>
                            <li><a href="#tab2" data-toggle="tab">{STR_REQUEST_STATUS_2_TITLE} <b style="color:red;">({ACCEPT_REQUESTS_COUNT})</b></a></li>
                            <li><a href="#tab3" data-toggle="tab">{STR_REQUEST_STATUS_1_TITLE} <b style="color:red;">({IN_WORK_REQUESTS_COUNT})</b></a></li>
                            <li><a href="#tab4" data-toggle="tab">{STR_REQUEST_STATUS_3_TITLE} <b style="color:red;">({REVIEW_REQUESTS_COUNT})</b></a></li>
                            <li><a href="#tab5" data-toggle="tab">{STR_COMPLETED} <b style="color:red;">({ACCEPTED_REQUESTS_COUNT})</b></a></li>
                            <li><a href="#tab6" data-toggle="tab">{STR_NOT_DONE} <b style="color:red;">({NOT_ACCEPTED_REQUESTS_COUNT})</b></a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active table-responsive border-top userprof-tab" id="tab1">
                            <table class="table table-bordered table-hover mb-0 text-nowrap " id="datatable-request">
                                <thead>
                                    <tr>
                                        <th>{STR_NUMBER}</th>
                                        <th class="w-30">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                                        <th>{STR_STATUS_TITLE}</th>
                                        <th>{STR_SMETA_DATE_TITLE}</th>
                                        <th>{STR_AUTHOR}</th>
                                        <th>{STR_REQUEST_WORKER_TITLE}</th>

                                        <th>{STR_ACTIONS}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {TAB1_ROWS}
                                </tbody>

                            </table>
                        </div>
                        <div class="tab-pane table-responsive border-top userprof-tab" id="tab2">
                            <table class="table table-bordered table-hover mb-0 text-nowrap" id="datatable-request-2">
                                <thead>
                                    <tr>
                                        <th>{STR_NUMBER}</th>
                                        <th class="w-30">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                                        <th>{STR_STATUS_TITLE}</th>
                                        <th>{STR_SMETA_DATE_TITLE}</th>
                                        <th>{STR_REQUEST_AUTHOR_TITLE}</th>
                                        <th>{STR_REQUEST_WORKER_TITLE}</th>
                                        <th>{STR_PRICHINA_TITLE}</th>
                                        <th>{STR_ACTIONS}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {TAB2_ROWS}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane table-responsive border-top userprof-tab" id="tab3">
                            <table class="table table-bordered table-hover mb-0 text-nowrap" id="datatable-request-3">
                                <thead>
                                    <tr>
                                        <th>{STR_NUMBER}</th>
                                        <th class="w-30">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                                        <th>{STR_STATUS_TITLE}</th>
                                        <th>{STR_SMETA_DATE_TITLE}</th>
                                        <th>{STR_REQUEST_AUTHOR_TITLE}</th>
                                        <th>{STR_REQUEST_WORKER_TITLE}</th>
                                        <th>{STR_ACTIONS}</th>
                                    </tr>
                                </thead>
                                <tbody id="collapse">
                                    {TAB3_ROWS}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane table-responsive border-top userprof-tab" id="tab4">
                            <table class="table table-bordered table-hover mb-0 text-nowrap" id="datatable-request-4">
                                <thead>
                                    <tr>
                                        <th class="w-5">{STR_NUMBER}</th>
                                        <th class=" w-15">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                                        <th>{STR_STATUS_TITLE}</th>
                                        <th>{STR_SMETA_DATE_TITLE}</th>
                                        <th>{STR_REQUEST_AUTHOR_TITLE}</th>
                                        <th>{STR_REQUEST_WORKER_TITLE}</th>
                                        <th>{STR_ACTIONS}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {TAB4_ROWS}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane table-responsive border-top userprof-tab" id="tab5">
                            <table class="table table-bordered table-hover mb-0 text-nowrap" id="datatable-request-5">
                                <thead>
                                    <tr>
                                        <th class="w-5">Номер</th>
                                        <th class="w-15">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                                        <th>{STR_STATUS_TITLE}</th>
                                        <th>{STR_SMETA_DATE_TITLE}</th>
                                        <th>{STR_REQUEST_AUTHOR_TITLE}</th>
                                        <th>{STR_REQUEST_WORKER_TITLE}</th>
                                        <th>{STR_RATING_TITLE}</th>
                                        <th>{STR_REVIEW_TITLE}</th>
                                        <th>{STR_ACTIONS}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {TAB5_ROWS}
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane table-responsive border-top userprof-tab" id="tab6">
                            <table class="table table-bordered table-hover mb-0 text-nowrap" id="datatable-request-6">
                                <thead>
                                    <tr>
                                        <th class="w-5">Номер</th>
                                        <th class="w-15">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                                        <th>{STR_STATUS_TITLE}</th>
                                        <th>{STR_SMETA_DATE_TITLE}</th>
                                        <th>{STR_REQUEST_AUTHOR_TITLE}</th>
                                        <th>{STR_REQUEST_WORKER_TITLE}</th>
                                        <th>{STR_REVIEW_TITLE}</th>
                                        <th>{STR_ACTIONS}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {TAB6_ROWS}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add request citizen -->
            <div class="modal fade" id="add-request-citizen" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_REQUEST_ADD_TITLE}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body vscroll" style="max-height:400px">
                            <form action="" method="post" name="frmAddRequest" enctype="multipart/form-data">
                                <input type="hidden" value="1" name="send">
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_TPL_FLAT_TITLE}:</label>
                                    <select class="form-control select2-universal" name="flat_id" required>
                                        <option value="0" selected="">{STR_REQUEST_SELECT_FLAT_TITLE}</option>
                                        {CITY_LIST}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_REQUEST_JOB_TITLE}:</label>
                                    <select class="form-control select2-universal" name="type_id" required>
                                        <option selected="0">{STR_REQUEST_SELECT_JOB_TITLE}</option>
                                        {TYPE_LIST}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</label>
                                    <textarea rows="3" class="form-control" name="description" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" required></textarea>
                                </div>

                                <div class="form-group mb-0">

                                    <label class="form-control-label">{STR_KN_ADD_PHOTO_TITLE}</label>
                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo1" data-height="180" />
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo2" data-height="180" />
                                        </div>

                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo3" data-height="180" />
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo4" data-height="180" />
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                            <button type="submit" class="btn btn-primary">{STR_ADD_TITLE}</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- add request osi -->
            <div class="modal fade" id="add-request-osi" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog modal-lg " role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_REQUEST_ADD_TITLE}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="frmAddRequest2" enctype="multipart/form-data">
                                <input type="hidden" value="1" name="send">
                        <div class="modal-body vscroll modal-height">
                            
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_TPL_HOUSE_TITLE}:</label>
                                    <select class="form-control select2-universal" name="house_id" required>
                                        <option>{STR_SELECT_HOUSE_TITLE}</option>
                                        {HOUSE_LIST}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_REQUEST_JOB_TITLE}:</label>
                                    <select class="form-control select2-universal" name="type_id" required>
                                        <option>{STR_REQUEST_SELECT_JOB_TITLE}</option>
                                        {TYPE_LIST}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_USER_TYPE_1_TITLE}:</label>
                                    <select class="form-control select2-universal" name="uc_id" required>
                                        <option>{STR_CHOOSE_MANAGING_COMPANY}</option>
                                        {UC_LIST}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_DESCRIPTION_TITLE}</label>
                                    <textarea rows="3" class="form-control" name="description" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" required></textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <label class="form-control-label">{STR_KN_ADD_PHOTO_TITLE}</label>
                                    <div class="row">

                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo1" data-height="180" />
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo2" data-height="180" />
                                        </div>

                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo3" data-height="180" />
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo4" data-height="180" />
                                        </div>
                                    </div>
                                </div>

                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                            <button type="submit" class="btn btn-primary">{STR_ADD_TITLE}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Not accepted request osi -->
            <div class="modal fade" id="not-accept-request-osi" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_REASON_OF_CANCELING}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="notAcceptRequest" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="notAcceptRequestSend">
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label">{STR_PRICHINA_TITLE}</label>
                                        <textarea rows="3" class="form-control" name="cancel" placeholder="{STR_ENTER_REASON}" required></textarea>
                                        <input type="hidden" name="id" id="id" value="" />
                                        <input type="hidden" name="executor_type" id="executor_type" value="" />
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                                <button type="submit" class="btn btn-primary">{STR_LEAVE_REVIEW}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Not accepted -->
            <div class="modal fade" id="OSI-push-To-UC-not-accepted" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_REASON_OF_CANCELING}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="OSIpushToUCNotAccepted" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="OSIpushToUCNotAcceptedSend">
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="form-control-label">{STR_PRICHINA_TITLE}</label>
                                        <textarea rows="3" class="form-control" name="reason" placeholder="{STR_ENTER_REASON}" required></textarea>
                                        <input type="hidden" name="executor" id="executor" value="" />
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                                <button type="submit" class="btn btn-primary">{STR_LEAVE_REVIEW}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- OSI PUSH REQUEST UC-->
            <div class="modal fade" id="osi-push-request-uc" tabindex="-1" role="dialog" aria-hidden="true" style=" ">
                <div class="modal-dialog" role="document">
                    <div class="modal-content " style="-webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
                -moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
                box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_TO_REDIRECT}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="OSIpushToUC" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="OSIpushToUCSend">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_USER_TYPE_1_TITLE}</label>
                                    <select name="uc" class="form-control select2-universal" required>
                                        <option>{STR_CHOOSE_MANAGING_COMPANY}</option>
                                        {UC_LIST}
                                    </select>

                                    <input type="hidden" name="id" id="id" value="" />
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                                <button type="submit" class="btn btn-primary">{STR_TO_REDIRECT}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <!-- UC PUSH REQUEST WORKER -->
            <div class="modal fade" id="uc-push-request-worker" tabindex="-1" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content " style="-webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
                -moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
                box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_TO_REDIRECT}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="UCpushtoWorker" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="UCpushtoWorkerSend">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_EMPOLOYEE}</label>
                                    <select name="worker" class="form-control select2-universal" required>
                                        <option>{STR_CHOOSE_EMPLOYEE}</option>
                                        {WORKER_LIST}
                                    </select>

                                    <input type="hidden" name="id" id="id" value="" />
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                                <button type="submit" class="btn btn-primary">{STR_TO_REDIRECT}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <!-- OSI PUSH FROM UC WITHOUT ACCEPTED -->
            <div class="modal fade" id="OSI-push-To-UC-WITHOUT-ACCEPT" tabindex="-1" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_TO_REDIRECT}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="OSIpushToUCWithoutAccept" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="OSIpushToUCWithoutAcceptSend">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_USER_TYPE_1_TITLE}</label>
                                    <select name="uc" class="form-control select2-universal" required>
                                        <option selected="">{STR_CHOOSE_MANAGING_COMPANY}</option>
                                        {UC_LIST}
                                    </select>

                                    <input type="hidden" name="executor" id="executor" value="" />
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                                <button type="submit" class="btn btn-primary">{STR_TO_REDIRECT}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- review request citizen -->
            <div class="modal fade" id="AddReview" role="dialog" tabindex="-1" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_REQUEST_CITIZEN_REVIEW}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="" method="post" name="AddReviewForm" enctype="multipart/form-data">
                        <input type="hidden" value="1" name="AddReviewFormSend">
                        <div class="modal-body">
                            
                                <div class="rating-stars block" id="rating">
                                    <label for="recipient-name" class="form-control-label">{STR_RATING_TITLE}:</label>
                                    <input type="number" readonly="readonly" class="rating-value" name="rating-stars-value" id="rating-stars-value" value="3" required />
                                    <div class="rating-stars-container">
                                        <div class="rating-star">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="rating-star">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="rating-star">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="rating-star">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="rating-star">
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="wroter" id="wroter" value="" />
                                <input type="hidden" name="wroter_type" id="wroter_type" value="" />
                                <input type="hidden" name="id" id="id" value="" />
                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">{STR_REVIEW_TITLE}</label>
                                    <textarea rows="3" class="form-control" name="review" value="" placeholder="{STR_WRITE_REVIEW}" required></textarea>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                            <button type="submit" class="btn btn-primary">{STR_SEND_TITLE}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- not finished request citizen -->
            <div class="modal fade" id="NotFinishedRequest" tabindex="-1" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
                <div class="modal-dialog" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="example-Modal3">{STR_REASON_OF_NOT_COMPLETING}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" name="NotFinishedRequestForm" enctype="multipart/form-data">
                            <input type="hidden" value="1" name="NotFinishedRequestFormSend">
                            <div class="modal-body">

                                <input type="hidden" readonly="readonly" class="rating-value" name="rating-stars-value" id="rating-stars-value" value="0">
                                <input type="hidden" name="wroter" id="wroter" value="" />
                                <input type="hidden" name="wroter_type" id="wroter_type" value="" />
                                <input type="hidden" name="id" id="id" value="" />
                                <label for="recipient-name" class="form-control-label">{STR_PRICHINA_TITLE}</label>
                                <textarea rows="3" class="form-control" name="review" placeholder="Укажите причину" required>{STR_REASON_TEXT}</textarea>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                                <button type="submit" class="btn btn-primary">{STR_LEAVE_REVIEW}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>