<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE_INNER}
            <div class="card-header">
                <div class="card-title">{USER_FIO}</div>
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
                                <th class="wd-15p">Департамент</th>
                                <th class="wd-15p">Ставка</th>
                                <th class="wd-15p">Должность</th>
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


<div class="modal fade" id="add" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Добавить департамент</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" name="addDepartmentForm" enctype="multipart/form-data">
                <input type="hidden" value="1" name="addDepartmentSend">
                <input type="hidden" value="{USER_ID}" name="userID">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
							<label class="form-control-label">Должность</label>
                            <select name="dolzhnost" id="dolzhnost" class="form-control select2-show-search"  placeholder="Должность" required>
                                {NEW_DOLZHNOST_LIST}
                            </select>
                        </div>
                         <div class="form-group col-6">
                            <label class="form-control-label">Университет</label>
                            <select name="univer_id" id="univer_id" class="form-control select2-show-search" onchange="changeINSTITUTE();" placeholder="" required>
                                <option value="0" selected>Выберите университет </option>
                                {NEW_UNIVER_LIST}
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-control-label">Подразделение</label>
                            <select name="department_id" id="department_id" class="form-control select2-show-search" placeholder="" >

                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="stavka" class="form-control-label">Ставка</label>
                            <input type="number" step="0.01" max="1.75" min="0.25" class="form-control" name="stavka" id="stavka" placeholder="Ставка" required>
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
