<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="categories">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">НИР</div>
                <div class="card-options">
                    <!--<a class="btn btn-primary" data-toggle="modal" data-target="#add-nir" href="#">Добавить НИР</a>-->
                </div>
            </div>
            <div class="card-body">
            <div class="mail-option">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <form action="" method="post" name="frmFilter">
                            <input type="hidden" name="ex" value="1">
                            <div class="form-group" style="{DISPLAYOSI}">
                                <select name="nirWorkTypeFilter" class="select2-show-search" onchange="frmFilter.submit();">
                                    <option value="0">Все</option>
                                    {NIR_WORK_TYPE_LIST}
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered table-responsive-sm">
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
