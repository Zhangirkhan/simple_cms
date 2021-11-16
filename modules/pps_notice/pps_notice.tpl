<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="users">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Уведомление пользователя</div>
                <!--<div class="card-options">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#add-user" href="#">Добавить пользователя</a>
                </div>-->
            </div>
            <div class="card-body">
                {NODATA}
                <div class="table-responsive-sm" {DISPLAY}>
                    <table {DISPLAY} id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Уведомление</th>
                                <th class="wd-10p">Ссылка</th>
                                <th class="wd-10p">Дата создания</th>
                            </tr>
                        </thead>
                        <tbody>
                            {NOTICE_ROWS}
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
