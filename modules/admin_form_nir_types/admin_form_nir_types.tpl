<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Настройки НИР</div>
                <div class="card-options">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#add-nir-work-type" href="#">Добавить тип работы</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Название типа работ</th>
                                <th class="wd-10p">Дата создания</th>
                                <th class="wd-10p">Статус</th>
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {NIR_SETTING_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>


<!-- Not accepted request osi -->
<div class="modal fade" id="add-nir-work-type" role="dialog" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Добавить настройку НИР</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" name="formAddNIRWorkType" enctype="multipart/form-data">
                <input type="hidden" value="1" name="addNIRWorkTypeSend">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="NIR" class="form-control-label">Типа работ (или название журнала)</label>
                            <textarea type="textarea" class="form-control" rows="5" name="NIR" id="NIR" placeholder="Введите название типа работ или название журнала" required></textarea>
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
