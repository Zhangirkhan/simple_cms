<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="users">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Факультеты - {UNIVER}</div>
                <div class="card-options">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#add-facultet" href="#">Добавить факультет</a>
                </div>
            </div>

            <div class="card-body">
                {NODATA_FACULTET}
                <div class="table-responsive-sm" {DISPLAY}>
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Название Факультета</th>
                                <th class="wd-10p">Дата создания</th>
                                <th class="wd-10p">Статус</th>
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {FACULTET_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>


<!-- ADD FACULTET -->
<div class="modal fade" id="add-facultet" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Добавить факультет</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" name="addFacultetForm" enctype="multipart/form-data">
                <input type="hidden" value="1" name="addFacultetSend">
                <input type="hidden" value="{UNIVER_ID}" name="univer">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="fio" class="form-control-label">Факультет</label>
                            <input type="text" class="form-control" name="facultet" id="facultet" placeholder="Введите название факультета" required>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>
