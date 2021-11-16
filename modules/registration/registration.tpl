<form action="" method="post" name="frmReg">
    <div class="page">

        <div class="container">
            <div class="row">

                <div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
                    <div class="card mb-xl-0" style="z-index: 9999;">
                        <div class="card-header">
                            <h3 class="card-title">{STR_REG_TITLE}</h3>
                        </div>
                        <div class="card-body" >
                            {RESULT_MESSAGE}
                                
                            <div class="form-group">
                                <label class="form-label text-dark">{STR_SELECT_USER_TYPE_TITLE}</label>

                                <select class="form-control" name="type_user" id="type_user">
                                    <option value="1">{STR_USER_TYPE_1_TITLE}</option>
                                    <option value="2">{STR_USER_TYPE_2_TITLE}</option>
                                    <!--<option value="3">{STR_USER_TYPE_3_TITLE}</option>-->
                                    <option value="5">Специалист</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label text-dark">{STR_FIO_TITLE}</label>
                                <input type="text" name="fio" class="form-control" autocomplete="off" placeholder="{STR_ENTER_NAME_PLACEHOLDER_TITLE}" />
                                <input type="hidden" name="forgot_id" id="forgot_id" value="0" />
                            </div>
                            <div class="form-group" style="margin-bottom: 10px" id="cardbody">
                                <label class="form-label text-dark">Номер телефона</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="phoneMask" autocomplete="off" name="phone" placeholder="{STR_ENTER_PHONE_TITLE}" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" onclick="sendSms();" type="button">{STR_SEND_TITLE}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label text-dark">{STR_CONFIRM_SMS_CODE_TITLE}</label>
                                <input type="text" name="code" class="form-control" autocomplete="off" placeholder="{STR_CONFIRM_SMS_CODE_TITLE}">
                            </div>
                            <div class="form-group">
                                <label class="form-label text-dark">{STR_EMAIL_PLACEHOLDER_TITLE}</label>
                                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="{STR_ENTER_EMAIL_TITLE}" />
                            </div>
                            <div class="form-group">
                                <label class="form-label text-dark">{STR_PASSWORD_PLACEHOLDER_TITLE}</label>
                                <input type="password" name="password" class="form-control" autocomplete="off" id="exampleInputPassword1" placeholder="{STR_ENTER_PASSWORD_TITLE}" />
                            </div>

                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input">
                                    <span class="custom-control-label text-dark">{STR_IAM_AGREE_TITLE} <a href="/ru/licence">{STR_WITH_RULES_TITLE}</a></span>
                                </label>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6Lf4mcIZAAAAAMS0nZEyAeNYBITNlzVaWeQCUzOc"></div>
                            <div class="form-footer mt-2">
                                <input type="submit" name="send" class="btn btn-primary btn-block" value="{STR_CREATE_ACCOUNT_BTN_TITLE}">
                            </div>
                            <div class="text-center mt-3 text-dark">
                                {STR_YOU_HAVE_ACCOUNT_TITLE} <a href="{LANG_INDEX}/auth">{STR_ENTER_TITLE}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>