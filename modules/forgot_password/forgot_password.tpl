<form action="" method="post" name="frmReg">
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
                    <div class="card mb-xl-0" style="z-index: 9999;">
                        <div class="card-header">
                            <h3 class="card-title">{STR_FORGET_PWD_TITLE}</h3>
                        </div>
                        <div class="card-body" id="cardbody">
                            {RESULT_MESSAGE}
                            <form method="post" action="" >
                            <input type="hidden" name="send">
                            <div class="form-group">
                                <label class="form-label text-dark">{STR_SELECT_USER_TYPE_TITLE}</label>

                                <select class="form-control" name="type_user" id="type_user">
                                    <option value="1">{STR_USER_TYPE_1_TITLE}</option>
                                    <option value="2">{STR_USER_TYPE_2_TITLE}</option>
                                    <option value="3">{STR_USER_TYPE_3_TITLE}</option>
                                    <option value="5">{STR_REG_TYPE_3_TITLE}</option>
                                </select>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 10px">
                                <label class="form-label text-dark">{STR_PHONE_TITLE}</label>
                                <div class="input-group">
                                <input type="hidden" id="forgot_id" name="forgot_id" value="1">
                                <input type="text" class="form-control" id="phoneMask" autocomplete="off" name="phone" placeholder="{STR_ENTER_PHONE_TITLE}" />
                                <div class="input-group-append">
                                        <button class="btn btn-primary" onclick="sendSms();" type="button">{STR_SEND_TITLE}</button>
                                </div> 
                                </div>
                            </div>
                           <div class="form-group">
                                <label class="form-label text-dark">{STR_CONFIRM_SMS_CODE_TITLE}</label>
                                <div class="input-group">
                                <input type="text" name="code" id="code" class="form-control" autocomplete="off" placeholder="{STR_CONFIRM_SMS_CODE_TITLE}">
                                <div class="input-group-append">
                                        <button class="btn btn-primary" onclick="forgot_password();" type="button">{STR_CHECK_CODE}</button>
                                </div> 
                                </div> 
                            </div>
                            
                            <div class="form-group" id="password" style="display: none;">
                                <label class="form-label text-dark">{STR_PASSWORD_PLACEHOLDER_TITLE}</label>
                                <input type="password" name="password" class="form-control" autocomplete="off"  placeholder="{STR_ENTER_PASSWORD_TITLE}" />
                            </div>
                            <div class="g-recaptcha" data-sitekey="6Lf4mcIZAAAAAMS0nZEyAeNYBITNlzVaWeQCUzOc"></div>

                            <div class="form-footer mt-2">
                                <input type="submit" name="send" class="btn btn-primary btn-block" value="{STR_RECOVER_PASSWORD}">
                            </div>
                            <div class="text-center mt-3 text-dark">
                                {STR_YOU_REMEMBER_PASSWORD} <a href="{LANG_INDEX}/auth">{STR_LOGIN_PN}</a>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>