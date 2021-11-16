<div class="row text-center">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card bg-lime text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/megaphone.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Набранные баллы</p>
                <h1 class="mb-0 counter mt-1">{USER_BALLS}</h1> баллов
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card bg-orange text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/picture.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Макс. количество баллов</p>
                <h1 class="mb-0 counter mt-1">{CATEGORY_MAX_BALLS}</h1> баллов
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card bg-purple text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/mail.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего форм</p>
                <h1 class="mb-0 counter mt-1">{FORMS_COUNT}</h1> форм
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-2">
        <div class="card bg-pink text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/blogging.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего заполнено форм

</p>
                <h1 class="mb-0 counter mt-1">{FORMS_FULLED}</h1> форм
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="users">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Международная деятельность - ФОРМЫ для заполнения</div>
                <!--<div class="card-options">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#add-user" href="#">Добавить пользователя</a>
                </div>-->
            </div>

            <div class="card-body">
                {NODATA}
                <div class="table-responsive" {DISPLAY}>
                    <table id="example" class="table table-responsive-sm table-striped table-bordered" {DISPLAY}>
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Название форм</th>
                                <th >Баллы за заполнение</th>
                                <th >Макс. балл</th>
                                <th >Создана</th>
                                <th >Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {VOSPITATEL_RABOTA_FORMS_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>


<!-- Not accepted request osi
<div class="modal fade" id="add-user" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Добавить пользователя</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" name="addUserForm" enctype="multipart/form-data">
                <input type="hidden" value="1" name="addUserSend">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="fio" class="form-control-label">ФИО</label>
                            <input type="text" class="form-control" name="fio" id="fio" placeholder="Введите ФИО пользователя" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="login" class="form-control-label">Логин</label>
                            <input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="password" class="form-control-label">Пароль</label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Пароль" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="user_type" class="form-control-label">Тип пользователя</label>
                            <select name="user_type" id="user_type" class="form-control select2-show-search" placeholder="" required>
                                <option value="0" selected>Выберите тип пользователя </option>
                                {USER_TYPE_LIST}
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-control-label">Университет</label>
                            <select name="univer_id" id="univer_id" class="form-control select2-show-search" onchange="changefacultets();" placeholder="" required>
                                <option value="0" selected>Выберите университет </option>
                                {UNIVER_LIST}
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-control-label">Факультет</label>
                            <select name="facultet_id" id="facultet_id" class="form-control select2-show-search" placeholder="" required>

                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Добавить пользователя</button>
                </div>
            </form>
        </div>
    </div>
</div>
-->
