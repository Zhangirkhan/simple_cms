<script type="text/javascript">
    var onloadCallback = function() {
        grecaptcha.render('html_element', {
            'sitekey': '6Lf4mcIZAAAAAMS0nZEyAeNYBITNlzVaWeQCUzOc'
        });
    };
</script>
<form action="" method="post" name="frmLogin" autocomplete="off">
    <div class="page">
        <div class="page-content z-index-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-12 col-md-12 d-block mx-auto">
                        <div class="card mb-0">
                            <div class="card-header">
                                <h3 class="card-title">Система</h3>
                            </div>
                            <div class="card-body">
                                {RESULT_MESSAGE}
                                <div class="form-group">
                                    <label class="form-label text-dark">Логин</label>
                                    <input required type="text" name="login" id="login" class="form-control" autocomplete="off" placeholder="Введите логин" value="{USR_LOGIN}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-dark">Пароль</label>
                                    <input required type="password" name="password" class="form-control" autocomplete="off" id="password" placeholder="Введите пароль" value="{USR_PASSW}">
                                </div>

                                <!--<div class="form-group">
                                    <label class="custom-control custom-checkbox">
                                        <a href="{LANG_INDEX}/forgot_password" class="float-right small text-dark mt-1">{STR_FORGET_PWD_TITLE}</a>
                                        <input type="checkbox" class="custom-control-input" name="chk_save" id="rememberMe" {SAVE} />
                                        <span class="custom-control-label text-dark">{STR_REG_REMEMBER_TITLE}</span>
                                    </label>
                                </div>-->

                                <div class="form-footer mt-2">
                                    <input type="submit" name="send" class="btn btn-primary btn-block" value="{STR_ENTER_TITLE}">
                                </div>
                                <!--<div class="text-center mt-3 text-dark">
                                    {STR_NO_ACCOUNT_TITLE} <a href="/ru/reg">{STR_REG_TITLE}</a>
                                </div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
