<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">{PAGE_TITLE}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <!--<a class="btn btn-primary" data-toggle="modal" data-target="#add" href="#">{STR_ADD_DEPARTMENTS_TYPES}</a>
                        <a class="btn btn-success" href="/pps_nirs_pdf.php" target="blank">{STR_DOWNLOAD_DEPARTMENTS_TYPES_LIST}</a> -->
                    </div>
                </div>
            </div>
            <div class="card-body">

            <div class="mail-option">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <form action="" method="post" name="categoryFilterForm">
                            <input type="hidden" name="ex" value="0">
                            <div class="form-group">

                                <select name="categoryFilter" class="form-control" onchange="categoryFilterForm.submit();">
                                    <option value="0">{STR_SHOW_ALL}</option>
                                    {CATEGORY_FILTER_LIST}
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {NODATA}
            <div class="table-responsive" {NODATA_DISPLAY}>

                    <table id="indicators" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Категория</th>
                                <th class="wd-15p">Название</th>
                                <th class="wd-15p">Заполнено</th>
                                <!--<th class="wd-15p">Формула</th>
                                <th class="wd-15p">Значение</th>
                                <th class="wd-15p">Файл</th>-->
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ROWS}
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
                <h5 class="modal-title" id="example-Modal3">{STR_ADD_DEPARTMENTS_TYPES}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form action="" method="post" name="frmAdd" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="send">
                    <input type="hidden" value="{TABLE}" name="table">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Название</label>
                            <input type="text" class="form-control" name="name" placeholder="Введите {STR_INTER_DEPARTMENT_TYPES_NAME}" required />
                        </div>
                        <!--<div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Тип НИР-а:</label>
                            <select class="form-control select2-show-search" name="nir_id" required>
                                <option value="0" selected="">Выберите тип НИР-а</option>
                                {NIR_WORK_TYPE_LIST}
                            </select>
                        </div> -->
                        <!-- <div class="form-group col-6">
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
                        </div> -->
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
