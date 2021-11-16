<form action="" name="frmChangePassword" method="post">
    <input type="hidden" name="change_send" value="1">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label class="form-label">{STR_CABINET_CHANGE_PASSWORD_1_TITLE}</label>
                <input type="text" name="oldPassword" class="form-control" placeholder="{STR_CABINET_CHANGE_PASSWORD_2_TITLE}" required />
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <label class="form-label">{STR_CABINET_CHANGE_PASSWORD_3_TITLE}</label>
                <input type="text" name="newPassword" class="form-control" placeholder="{STR_CABINET_CHANGE_PASSWORD_4_TITLE}" required />
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <label class="form-label">{STR_CABINET_CHANGE_PASSWORD_5_TITLE}</label>
                <input type="text" name="reNewPassword" class="form-control" placeholder="{STR_CABINET_CHANGE_PASSWORD_6_TITLE}" required />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">{STR_CABINET_CHANGE_PASSWORD_7_TITLE}</button>
</form>