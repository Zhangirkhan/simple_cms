<!-- Главные настройки --->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">{MAIN_PAGE_TITLE}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#add_Univer" href="#">{STR_ADD}</a>
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
                                <th class="wd-15p">Название</th>
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Настройки должности --->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            <div class="card-header">
                <div class="card-title">{DOLZHNOSTI_PAGE_TITLE}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#add_Dolzhnosti" href="#">{STR_ADD}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            {DOLZHNOSTI_NODATA}
            <div class="table-responsive" {DOLZHNOSTI_NODATA_DISPLAY}>
                    <table id="univers" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Название</th>
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {DOLZHNOSTI_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Настройки степени и категории --->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            <div class="card-header">
                <div class="card-title">{STEPEN_PAGE_TITLE}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#add_Stepen" href="#">{STR_ADD}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            {STEPEN_NODATA}
            <div class="table-responsive" {STEPEN_NODATA_DISPLAY}>
                    <table id="univers" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Название</th>
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {STEPEN_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Настройки типов пользователей --->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            <div class="card-header">
                <div class="card-title">{USER_TYPE_PAGE_TITLE}</div>
                <div class="card-options">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#add_user_type" href="#">{STR_ADD}</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            {USER_TYPE_NODATA}
            <div class="table-responsive" {USER_TYPE_NODATA_DISPLAY}>
                    <table id="user_type" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="wd-15p">#</th>
                                <th class="wd-15p">Название</th>
                                <th class="wd-30p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {USER_TYPE_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="forms-place"></div>

<div class="modal fade" id="add_Univer" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">{STR_ADD_UNIVER}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <form action="" method="post" name="frmAdd" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="send">
                    <input type="hidden" value="{UNIVER_TABLE}" name="table">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Название</label>
                            <input type="text" class="form-control" name="name" placeholder="Введите {STR_INTER_UNIVER_NAME}" required />
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


<div class="modal fade" id="add_Dolzhnosti" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
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
                    <input type="hidden" value="{DOLZHNOSTI_TABLE}" name="table">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Название</label>
                            <input type="text" class="form-control" name="name" placeholder="Введите" required />
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


<div class="modal fade" id="add_Stepen" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
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
                    <input type="hidden" value="{STEPEN_TABLE}" name="table">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Название</label>
                            <input type="text" class="form-control" name="name" placeholder="Введите" required />
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


<div class="modal fade" id="add_user_type" role="dialog" aria-hidden="true" style=" -webkit-box-shadow: 0px 0px 18px 5px rgba(0,0,0,0.75);
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
                    <input type="hidden" value="{USER_TYPE_TABLE}" name="table">
            <div class="modal-body vscroll" style="max-height:500px">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="recipient-name" class="form-control-label">Название</label>
                            <input type="text" class="form-control" name="name" placeholder="Введите" required />
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
