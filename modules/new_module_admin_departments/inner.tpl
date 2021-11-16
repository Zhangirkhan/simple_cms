<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">{TABLE_INNER_NAME}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#add" href="#">{STR_ADD}</a>
                        <!--<a class="btn btn-success" href="/pps_nirs_pdf.php" target="blank">{STR_DOWNLOAD_DEPARTMENTS_TYPES_LIST}</a> -->
                    </div>
                </div>
            </div>
            <div class="card-body">
            {NODATA}
            <div class="table-responsive" {NODATA_DISPLAY}>
                    <table id="univers" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Метод</th>
                                <th class="wd-15p">Категория показателей</th>
                                <th class="wd-15p">Дата и время активности</th>
                                <th class="wd-15p">Статус</th>
                                <th class="wd-15p">Действия</th>
                                <!--<th class="wd-15p">Значение</th>
                                <th class="wd-15p">Файл</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            {ROWS_INNER}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>


<div id="forms-place"></div>

<div class="modal fade" id="add" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">{STR_ADD}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form action="" method="post" name="frmAdd" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="inner_send">
                    <input type="hidden" value="{DEPARTMENT_ID}" name="department_id">
            <div class="modal-body vscroll" style="max-height:700px">
                    <div class="form-row">

                        <!-- <div class="form-group form-check col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="users_type" id="departments_user" onchange="newAccessesUserTypeChange(this)" value="1" checked>
                                <label class="form-check-label" for="departments_user">
                                    Департаменты пользователей
                                </label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="all_down_category" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Все нижние подразделения тоже</label>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="users_type" id="individual_users" onchange="newAccessesUserTypeChange(this)" value="2">
                                <label class="form-check-label" for="individual_users">
                                    Индивидуальные пользователи
                                </label>
                            </div>
                        </div> -->
                        <div class="col-12 form-group " id="method_select">
                            <label for="method_select">Метод</label>
                            <select class="select2-show-search" id = "method_select" name="method" required>
                                <option value="1">Добавить</option>
                                <option value="0">Исключить</option>
                            </select>
                        </div>

                        <div class="col-12 form-group " id="indicators_type_select">
                            <label for="indicator_id" class="form-control-label">Категория показателей:</label>
                            <select class="form-control select2-show-search" id = "indicator_id" name="indicator_or_category_ids[]" multiple required>
                                {INDICATORS_CATEGORY_LIST}
                            </select>
                        </div>



                        <div class="form-group col-12">
                        <label class="form-control-label">Доступы</label>
                        <div class="row">
                            <div class="col-6">
                                <label class="form-control-label">От</label>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><input class="flatpickr flatpickr-input form-control" autocomplete="off" name="time_on"  type="text" placeholder="{STR_CHOOSE_DATE}.." value=""  required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-control-label">До</label>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div><input class="flatpickr flatpickr-input form-control" autocomplete="off" name="time_to" id="time_to" type="text" placeholder="{STR_CHOOSE_DATE}.." value=""  required />
                                    </div>
                                </div>
                            </div>
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
