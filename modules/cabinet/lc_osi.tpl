<h3>{RESULT_MESSAGE}</h3>
<div class="ads-tabs">
    <div class="tabs-menus">
        <ul class="nav panel-tabs">
            <li class=""><a href="#tab1" class="active" data-toggle="tab">{STR_CABINET_TAB_1_TITLE}</a></li>
            <li><a href="#tab2" data-toggle="tab" class="">{STR_CABINET_TAB_3_TITLE}</a></li>
           <!-- <li><a href="#tab3" data-toggle="tab" class="">{STR_CABINET_TAB_2_TITLE}</a></li>
            <li><a href="#tab4" data-toggle="tab" class="">{STR_CABINET_TAB_6_TITLE}</a></li>-->
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="tab1">

            <form name="frmEdit" method="post" action="" style="margin: 0px; padding: 0px;" enctype="multipart/form-data">
                <input type="hidden" value="1" name="send">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="fio" class="form-control-label">ФИО</label>
                        <input type="text" class="form-control" name="fio" id="fio" placeholder="Введите ФИО пользователя" required value="{FIO}">
                    </div>
                    <div class="form-group col-6">
                        <label for="login" class="form-control-label">Логин</label>
                        <input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин" required value="{LOGIN}">
                    </div>
                    <div class="form-group col-6">
                        <label for="login" class="form-control-label">Номер телефон</label>
                        <input type="tel" class="form-control" name="phone_number" id="phoneMask" placeholder="Напишите номер телефон" required value="{PHONE_VALUE}">
                    </div>
                    <div class="form-group col-6">
                        <label for="login" class="form-control-label">Почта</label>
                        <input type="email" class="form-control" name="email" id="emailMask" placeholder="Напишите почту" required value="{EMAIL_VALUE}">
                    </div>
                    <div class="form-group col-6">
                        <label for="login" class="form-control-label">Адрес</label>
                        <input type="text" class="form-control" name="adress" id="adress" placeholder="Напишите адрес" required value="{ADRESS_VALUE}">
                    </div>

                    <div class="form-group col-6">
                        <label for="user_type" class="form-control-label">Тип пользователя</label>
                        <select name="user_type" id="user_type" class="form-control select2-show-search" placeholder=""  disabled>
                            <option value="0" selected>Выберите тип пользователя </option>
                            {USER_TYPE_LIST}
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-control-label">Университет</label>
                        <select name="univer_id" id="univer_id" class="form-control select2-show-search" onchange="changefacultets();" placeholder=""  disabled>
                            <option value="0" selected>Выберите университет </option>
                            {UNIVER_LIST}
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-control-label">Факультет</label>
                        <select name="facultet_id" id="facultet_id" class="form-control select2-show-search" placeholder=""  disabled>
                            {FACULTET_LIST}
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{STR_SAVE_TITLE}</button>
            </form>
        </div>
        <div class="tab-pane" id="tab2">
            {CHANGE_PASSWORD}
        </div>
    </div>
</div>
