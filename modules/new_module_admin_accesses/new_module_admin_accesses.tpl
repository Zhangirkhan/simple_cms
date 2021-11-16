<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">{PAGE_TITLE}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#add" href="#">{STR_ADD}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="mail-option">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <form action="" method="post" name="user_filterForm">
                            <input type="hidden" name="ex" value="0">
                            <div class="form-group">
                                <select name="userFilter" class="form-control" onchange="user_filterForm.submit();">
                                    <option value="0">{STR_SHOW_ALL}</option>
                                    {USER_FILTER_LIST}
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <form action="" method="post" name="indicatorFilterForm">
                            <input type="hidden" name="ex" value="0">
                            <div class="form-group">
                                <select name="indicatorFilter" class="form-control" onchange="indicatorFilterForm.submit();">
                                    <option value="0">{STR_SHOW_ALL}</option>
                                    {INDICATORS_LIST}
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {NODATA}
            <div class="table-responsive" {NODATA_DISPLAY}>
                    <table id="univers" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-25p">Пользователь</th>
                                <th class="wd-25p">Группа показателей</th>
                                <th class="wd-25p">Статус</th>
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

<div class="modal fade" id="add" role="dialog" aria-hidden="true" style="-webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
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
                    <input type="hidden" value="{TABLE}" name="table">
            <div class="modal-body vscroll" style="max-height:700px">
                    <div class="form-row">
                        <div class="form-group col-12" id = "user_type_select">
                            <label for="recipient-name" class="form-control-label">Пользователь (Исследователь)</label>
                            <select class="form-control select2-show-search" name="user_id" required>
                                {RESERCHER_USERS_LIST}
                            </select>
                        </div>

                        <div class="form-group col-12" id="indicators_type_select">
                            <label for="recipient-name" class="form-control-label">Категория показателей:</label>
                            <select class="form-control select2-show-search" name="group_indicators[]" multiple required>
                                {INDICATORS_CATEGORY_LIST}
                            </select>
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
