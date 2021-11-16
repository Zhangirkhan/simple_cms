<div class="ads-tabs">
    <div class="tabs-menus">
        <ul class="nav panel-tabs">
            <li class=""><a href="#tab1" class="active" data-toggle="tab">{STR_CABINET_TAB_1_TITLE}</a></li>
            <li><a href="#tab2" data-toggle="tab" class="">{STR_CABINET_TAB_2_TITLE}</a></li>
            <li><a href="#tab3" data-toggle="tab" class="">{STR_CABINET_TAB_3_TITLE}</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="tab1">
            {RESULT_MESSAGE}

            <form name="frmEdit" method="post" action="" style="margin: 0px; padding: 0px;" enctype="multipart/form-data">
                <input type="hidden" value="1" name="send">

                <div class="form-group">
                    <label class="form-label">{STR_FIO_TITLE}</label>
                    <input type="text" class="form-control" name="name" id="name1" value="{NAME_VALUE}" placeholder="{STR_ENTER_NAME_PLACEHOLDER_TITLE}">
                </div>
                <div class="form-group">
                    <label class="form-label">{STR_PHONE_TITLE}</label>
                    <input type="text" class="form-control" name="phone" id="name1" value="{PHONE_VALUE}" placeholder="{STR_ENTER_PHONE_TITLE}">
                </div>
                <div class="form-group">
                    <label class="form-label">{STR_EMAIL_PLACEHOLDER_TITLE}</label>
                    <input type="text" class="form-control" name="email" id="name1" value="{EMAIL_VALUE}" placeholder="{STR_ENTER_EMAIL_TITLE}">
                </div>
                <a href="javascript:void(0);" class="btn btn-primary" onclick="frmEdit.submit();">{STR_SAVE_TITLE}</a>

            </form>
        </div>
        <div class="tab-pane" id="tab2">

            <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add-document"><i class="fa fa-paypal"></i>{STR_DOC_ADD_BTN_TITLE}</a></p>

            <table class="table table-bordered table-hover mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th>{STR_DOC_NAME}</th>
                        <th>{STR_DATE_ADDED}</th>
                        <th>{STR_ACTIONS}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="checkbox" value="checkbox">
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <div class="media mt-0 mb-0">
                                <div class="media-body">
                                    <div class="card-item-desc p-0">
                                        <a href="#" class="text-dark">
                                            <h4 class="font-weight-semibold">BPO Jobs</h4>
                                        </a>
                                        <a href="#"><i class="fa fa-clock-o w-4"></i>
                                            Feb-21-2018 , 16:54</a><br>
                                        <a href="#"><i class="fa fa-tag w-4"></i> Part
                                            Time</a>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="font-weight-semibold fs-16">$54 - $60</td>

                        <td>
                            <a class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#edit-document" data-original-title="{STR_FILE_DOWNLOAD_TITLE}"><i class="fa fa-arrow-down"></i></a>
                            <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-original-title="{STR_REQUEST_CITIZEN_DELETE}"><i class="fa fa-trash-o"></i></a>

                        </td>
                    </tr>



                </tbody>
            </table>

        </div>
        <div class="tab-pane" id="tab3">
            {CHANGE_PASSWORD}
        </div>
        <div class="tab-pane" id="tab4">
            <p><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add-news"><i class="fa fa-paypal"></i>{STR_ADD_NEWS}</a></p>


            <table class="table table-bordered table-hover mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th class="w-100">{STR_NEWS_TITLE}</th>
                        <th>{STR_DESCRIPTION_TITLE}</th>
                        <th>{STR_PUBLISH_DATE}</th>
                        <th>{STR_ACTIONS}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="checkbox" value="checkbox">
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <div class="media mt-0 mb-0">
                                <div class="media-body">
                                    <div class="card-item-desc p-0">
                                        <a href="#" class="text-dark">
                                            <h4 class="font-weight-semibold">BPO Jobs</h4>
                                        </a>
                                        <a href="#"><i class="fa fa-clock-o w-4"></i>
                                            Feb-21-2018 , 16:54</a><br>
                                        <a href="#"><i class="fa fa-tag w-4"></i> Part
                                            Time</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><i class="fa fa-map-marker mr-1 text-muted"></i>Ambrosia</td>
                        <td class="font-weight-semibold fs-16">$54 - $60</td>

                        <td>
                            <a class="btn btn-warning btn-sm text-white" data-toggle="tooltip" data-original-title="{STR_SEND_TITLE}"><i class="fa fa-send"></i></a>
                            <a class="btn btn-success btn-sm text-white" data-target="#edit-news" data-toggle="tooltip" data-original-title="{STR_POLL_EDIT_TITLE}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-original-title="{STR_REQUEST_CITIZEN_DELETE}"><i class="fa fa-trash-o"></i></a>

                        </td>
                    </tr>



                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="tab5">

            <table class="table table-bordered table-hover mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th class="w-100">{STR_REVIEW_TITLE}</th>
                        <th>{STR_RATING_TITLE}</th>
                        <th>{STR_REVIEW_AUTHOR}</th>
                        <th>{STR_ACTIONS}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="checkbox" value="checkbox">
                                <span class="custom-control-label"></span>
                            </label>
                        </td>
                        <td>
                            <div class="media mt-0 mb-0">
                                <div class="media-body">
                                    <div class="card-item-desc p-0">
                                        <a href="#" class="text-dark">
                                            <h4 class="font-weight-semibold">BPO Jobs</h4>
                                        </a>
                                        <a href="#"><i class="fa fa-clock-o w-4"></i>
                                            Feb-21-2018 , 16:54</a><br>
                                        <a href="#"><i class="fa fa-tag w-4"></i> Part
                                            Time</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><i class="fa fa-map-marker mr-1 text-muted"></i>Ambrosia</td>
                        <td class="font-weight-semibold fs-16">$54 - $60</td>

                        <td>
                            <a class="btn btn-warning btn-sm text-white" data-toggle="tooltip" data-original-title="{STR_SEND_TITLE}"><i class="fa fa-send"></i></a>
                            <a class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-original-title="{STR_POLL_EDIT_TITLE}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-original-title="{STR_REQUEST_CITIZEN_DELETE}"><i class="fa fa-trash-o"></i></a>

                        </td>
                    </tr>



                </tbody>
            </table>
        </div>
    </div>

</div>