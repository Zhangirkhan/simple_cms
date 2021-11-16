<div class="ads-tabs">
    <div class="tabs-menus">
        <ul class="nav panel-tabs">
            <li class=""><a href="#tab1" class="active" data-toggle="tab">{STR_CABINET_TAB_1_TITLE}</a></li>
           
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="tab1">
            {RESULT_MESSAGE}
            <form name="frmEdit" method="post" action="" style="margin: 0px; padding: 0px;" enctype="multipart/form-data">
                <input type="hidden" value="1" name="send">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <label class="form-label">{STR_FIO_TITLE}</label>
                        <input type="text" class="form-control" name="name" maxlength="50" value="{NAME_VALUE}" placeholder="{STR_ENTER_NAME_PLACEHOLDER_TITLE}" required />
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <label class="form-label">{STR_PHONE_TITLE}</label>
                        <input type="text" class="form-control" id="phoneMask3" name="phone" readonly value="{PHONE_VALUE}" placeholder="{STR_ENTER_PHONE_TITLE}" required />
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <label class="form-label">{STR_EMAIL_PLACEHOLDER_TITLE}</label>
                        <input type="text" class="form-control" name="email"  id="emailMask" value="{EMAIL_VALUE}" placeholder="{STR_ENTER_EMAIL_TITLE}" required />
                    </div>
                   
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <label class="form-label">Деятельность</label>
                        <select id="inputState" name="work_type" class="form-control" required>
                            <option value="0">Выберите деятельность</option>
                            {WORK_TYPE_LIST}
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 form-group">
                        <div class="form-label">{STR_USER_IMAGE}</div>
                        <div class="custom-file">
                            <input type="file" class="dropify" name="file" value="{STR_CHOOSE_USER_IMG}">
                            
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{STR_SAVE_TITLE}</button>
            </form>
        </div>
        <div class="tab-pane" id="tab2">
            {CHANGE_PASSWORD}
        </div>
        <div class="tab-pane" id="tab3">
            <p class="red">{STR_USER_S_REVIEWS}</p>
            <table class="table table-bordered table-hover mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="w-1">{STR_KN_NUMBER_TITLE}</th>
                        <th style="white-space: normal;">{STR_REVIEW_TITLE}</th>
                        <th class="w-1">{STR_RATING_TITLE}</th>
                        <th class="w-3">{STR_REQUEST_WORKER_TITLE}</th>
                    </tr>
                </thead>
                <tbody>
                    {REVIEWS_ROW}
                </tbody>
            </table>
        </div>
    </div>
</div>