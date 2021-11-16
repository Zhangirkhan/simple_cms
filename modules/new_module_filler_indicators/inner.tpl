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
                                <th class="wd-15p">Запись</th>
                                <th class="wd-15p">Файл</th>
                                <th class="wd-15p">Дата и время заполнения</th>
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
                    <input type="hidden" value="1" name="send">
                    <input type="hidden" value="{TABLE_INNER}" name="table">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Значение</label>
                            <input type="number" step="0.01" class="form-control" name="name" placeholder="Введите {STR_INTER_DEPARTMENT_TYPES_NAME}" required />
                        </div>

                        <div class="form-group col-6">
                            <label class="form-control-label">Загрузите файл</label>
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <input type="file" class="dropify" data-allowed-file-extensions="pdf doc docx rtf" data-max-file-size="10M" name="file1" data-height="180" />
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
