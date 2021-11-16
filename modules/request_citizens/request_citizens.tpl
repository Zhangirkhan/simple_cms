<div class="col-xl-10 col-lg-12 col-md-12">
    <div class="card user-content-right">
        <div class="card-header">
            <h3 class="card-title">{PAGE_TITLE}</h3>

            <div class="card-options">
                <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#request_citizens-add-request-citizen" href="#"><i class="fa fa-plus"></i> {STR_CREATE_REQUEST}</a>
            </div>

        </div>


        <div class="card-body user-right-top-filter">
            <!--Фильтр и Поиск-->
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <form action="" method="post" name="frmFilter1">
                                <input type="hidden" name="ex" value="0">
                                <div class="input-group">
                                    <select name="statusFilter" class="form-control" onchange="frmFilter1.submit();">
                                        <optgroup label="Статусы">
                                            <option value="0" {STATUS0}>{STR_TPL_SORT_STATUS_2_TITLE}</option>
                                            <option value="11" {STATUS11}>{STR_NEW}</option>
                                            <option value="1" {STATUS1}>{STR_PENDING}</option>
                                            <option value="2" {STATUS2}>{STR_REQUEST_STATUS_1_TITLE}</option>
                                            <option value="3" {STATUS3}>{STR_PENDING_EVALUATION}</option>
                                            <option value="6" {STATUS6}>{STR_REJECTED}</option>
                                            <option value="4" {STATUS4}>{STR_COMPLETED}</option>
                                            <option value="5" {STATUS5}>{STR_NOT_COMPLETED}</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <form action="" method="post" name="frmFilter2">
                                <input type="hidden" name="ex" value="0">
                                <div class="input-group">
                                    <select name="typeFilter" class="form-control" onchange="frmFilter2.submit();">
                                        <optgroup label="Тип">
                                            <option value="0">{STR_EVERY_TYPE}</option>
                                            {TYPE_LIST}
                                        </optgroup>
                                    </select>
                                </div>
                            </form>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-4">
                            <form action="" method="post" name="frmFilter3">
                                <input type="hidden" name="ex" value="0">
                                <div class="input-group">
                                    <select name="dataFilter" class="form-control" onchange="frmFilter3.submit();">
                                        <optgroup label="По дате">
                                            <option value="0" {DATEFILTER0}>{STR_ALL_PERIOD}</option>
                                            <option value="1" {DATEFILTER1}>{STR_TODAY}</option>
                                            <option value="2" {DATEFILTER2}>{STR_PER_WEEK}</option>
                                            <option value="3" {DATEFILTER3}>{STR_PER_MONTH}</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xl-4 col-lg-12 col-md-4">
                    <form action="" method="post" name="frmSearch">
                        <input type="hidden" name="ex" value="0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="keyword" placeholder="{STR_SEARCH_TITLE}">
                            <div class="input-group-append ">
                                <button type="button" onclick="frmSearch.submit();" class="btn btn-primary">{STR_SEARCH_TITLE}</button>
                            </div>
                        </div>
                    </form>
                </div>-->
            </div>
            <!--Фильтр и Поиск-->


        </div>

        <div class="card-body" id="card-body">
            {NODATA}
            <div class=" table-bordered table-responsive-sm">
                <table class="table table-hover w-100" style="{HIDDEN}">
                    <thead>
                        <tr>
                            <th>{STR_NUMBER}</th>
                            <th>{STR_STATUS_TITLE}</th>
                            <th class="w-15">{STR_SMETA_INNER_DESCR_TITLE}</th>
                            <th>{STR_DATE_AND_TIME_CREATE}</th>
                            <th>{STR_AUTHOR}</th>
                            <th>{STR_REQUEST_WORKER_TITLE}</th>
                            <th>{STR_RATING_TITLE}</th>
                            <th>{STR_ACTION_TITLE}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {ROWS}
                    
                    </tbody>
                </table>
               

            </div>
            <br/>
            <div class="center-block text-center">
            <ul class="pagination mb-5 mb-lg-0">
            {LIST_PAGES}
            </ul>
        </div>

        </div>
    </div>
</div>

<!-- add request citizen -->
<div class="modal fade" id="request_citizens-add-request-citizen" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
        <form action="" method="post" name="frmAddRequest" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="send">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">{STR_REQUEST_ADD_TITLE}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vscroll" style="max-height:400px">
                
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_TPL_FLAT_TITLE}:</label>
                        <select class="form-control select2-universal" name="flat_id" required>
                            <option value="" disabled>{STR_REQUEST_SELECT_FLAT_TITLE}</option>
                            {CITY_LIST}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_REQUEST_JOB_TITLE}:</label>
                        <select class="form-control select2-universal" name="type_id" required>
                            <option selected="" disabled >{STR_REQUEST_SELECT_JOB_TITLE}</option>
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

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                <button type="submit" class="btn btn-primary">{STR_ADD_TITLE}</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- review request citizen -->
<div class="modal fade" id="AddReview" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">{STR_REQUEST_CITIZEN_REVIEW}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">
                <form action="" method="post" name="AddReviewForm" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="AddReviewFormSend">
                    <div class="rating-stars block" id="rating">
                        <label for="recipient-name" class="form-control-label">{STR_RATING_TITLE}:</label>
                        <input type="number" readonly="readonly" class="rating-value" name="rating-stars-value" id="rating-stars-value" value="3" required>
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
                        <textarea rows="3" class="form-control" name="review" value="" placeholder="{STR_WRITE_REVIEW}" required>{STR_HERE_REVIEW_TEXT}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                <button type="button" onclick="AddReviewForm.submit();" class="btn btn-primary">{STR_SEND_TITLE}</button>
            </div>

        </div>
    </div>
</div>
<!-- not finished request citizen -->
<div class="modal fade" id="NotFinishedRequest" role="dialog" aria-hidden="true">
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
                    <textarea rows="3" class="form-control" name="review" placeholder="{STR_ENTER_REASON}" required>{STR_REASON_TEXT}</textarea>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                    <button onclick="NotFinishedRequestForm.submit();" type="button" class="btn btn-primary">{STR_LEAVE_REVIEW}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Not accepted request osi -->
<div class="modal fade" id="not-accept-request-osi" role="dialog" aria-hidden="true">
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
                    <button onclick="notAcceptRequest.submit();" type="button" class="btn btn-primary">{STR_LEAVE_REVIEW}</button>
                </div>
            </form>
        </div>
    </div>
</div>