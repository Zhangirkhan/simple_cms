<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">НИР</div>
                <div class="card-options">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#add-nir" href="#">Добавить НИР</a>&nbsp;
                    <a class="btn btn-success" href="/pps_nirs_pdf.php" target="blank">Скачать отчет по НИРам</a>
                </div>
            </div>
            <div class="card-body">
            <div class="mail-option">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <form action="" method="post" name="frmFilter">
                            <input type="hidden" name="ex" value="1">
                            <div class="form-group" style="{DISPLAYOSI}">
                                <select name="nirWorkTypeFilter" class="form-control" onchange="frmFilter.submit();">
                                    <option value="0">Все</option>
                                    {NIR_WORK_TYPE_LIST}
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Название</th>
                                <th class="wd-15p">Характер работы</th>
                                <th class="wd-15p">Выходные данные</th>
                                <th class="wd-15p">Объем, п.л.</th>
                                <th class="wd-15p">Соавторы</th>
                                <th class="wd-15p">Файл</th>
                                <th class="wd-15p">Тип работы</th>
                                <th class="wd-10p">Дата создания</th>
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {NIR_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>


<div class="modal fade" id="add-nir" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Добавить НИР</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form action="" method="post" name="frmAddNIR" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="send">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Тип НИР-а:</label>
                            <select class="form-control select2-show-search" name="nir_id" required>
                                <option value="0" selected="">Выберите тип НИР-а</option>
                                {NIR_WORK_TYPE_LIST}
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-control-label">Название</label>
                            <textarea rows="3" class="form-control" name="name" placeholder="Введите название НИР-а" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-control-label">Характер работы</label>
                            <textarea rows="3" class="form-control" name="сharacter_work" placeholder="Опишите характер работы" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-control-label">Выходные данные</label>
                            <textarea rows="3" class="form-control" name="output" placeholder="Укажите выходные данные" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-control-label">Объем, п.л.</label>
                            <textarea rows="3" class="form-control" name="volume" placeholder="Введите объем п.л." required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="recipient-name" class="form-control-label">Соавторы</label>
                            <textarea rows="3" class="form-control" name="co_authors" placeholder="Укажите соавторов" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label class="form-control-label">Загрузите файл статьи</label>
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <input type="file" class="dropify" data-allowed-file-extensions="pdf doc docx rtf" data-max-file-size="10M" name="file_url" data-height="180" />
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
