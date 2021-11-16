<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="users">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Свод на почасовую оплату труда ППС - ФОРМЫ для заполнения</div>
               <div class="card-options">
                <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#addSvod" href="#"><i class="fa fa-plus"></i> Добавить сводку</a>
            </div>
            </div>

            <div class="card-body">
                {NODATA}
                <div class="table-responsive" {DISPLAY}>
                    <table border="1" class="table table-responsive-sm table-striped table-bordered" {DISPLAY}>
                        <thead>

                        <tr>
                            <tr>
                                <td rowspan="3">"№ п/п"</td>
                                <td rowspan="3">Год</td>
                                <td rowspan="3">Месяц</td>
                                <td colspan="2">Должность</td>
                                <td rowspan="3">Кол-во административных часов</td>
                                <td colspan="7">Количество академ. часов по видам занятий</td>

                            </tr>
                            <tr>
                                <td rowspan="2">Педагогическая</td>
                                <td rowspan="2">Административная</td>
                                <td colspan="4">Аудиторная нагрузка</td>
                                <td rowspan="2">Провед.на англ.языке</td>
                                <td rowspan="2">Рук-во ДП, МД, ДД, практикой, членство ГАК</td>
                                <td rowspan="2">ВСЕГО</td>
                            </tr>
                            <tr>
                                <td>лекции</td>
                                <td>практика</td>
                                <td>лаборат.</td>
                                <td>итого</td>
                            </tr>

                        </thead>
                        <tbody>
                            {SVOD_ROWS}
                            <tr><td colspan="12">ВСЕГО</td><td class="font-weight-bold">{ALL_VSEGO}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>

<!-- Добавить сводку-->
<div class="modal fade" id="addSvod" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
        <form action="" method="post" name="frmaddSvod" enctype="multipart/form-data">
                    <input type="hidden" value="1" name="add_record">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Добавить сводку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vscroll" style="max-height:400px">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="year" class="form-control-label">Год:</label>
                        <select class="form-control select2-universal" name="year" required>
                            <option selected="" value="" disabled>Выберите год</option>
                            {YEARS}
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="month" class="form-control-label">Месяц:</label>
                        <select class="form-control select2-universal" name="month" required>
                            <option selected="" disabled >Выберите месяц</option>
                            {MONTHS}
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="dolzhnost" class="form-control-label">Должность:</label>
                        <select class="form-control select2-universal" name="dolzhnost" required>
                            <option selected="" disabled >Выберите должность</option>
                            <option value="1" >Педагогическая</option>
                            <option value="2" >Административная</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="admin_kolvo" class="form-control-label">Кол-во административных часов</label>
                        <input type="number" class="form-control" id="admin_kolvo" name="admin_kolvo" value="Укажите кол-во административных часов" required/>
                    </div>

                    <div class="form-group col-6">
                        <label for="lecture" class="form-control-label">Лекции</label>
                        <input type="number"  class="form-control" id="lecture" name="lecture" value="Укажите кол-во" required/>
                    </div>

                    <div class="form-group col-6">
                        <label for="practica" class="form-control-label">Практика</label>
                        <input type="number"  class="form-control" id="practica" name="practica" value="Укажите кол-во" required/>
                    </div>

                    <div class="form-group col-6">
                        <label for="lab" class="form-control-label">Лаборат.</label>
                        <input type="number"  class="form-control" id="lab" name="lab" value="Укажите кол-во" required/>
                    </div>

                    <div class="form-group col-6">
                        <label for="in_english" class="form-control-label">Провед.на англ.языке.</label>
                        <input type="number"  class="form-control" id="in_english" name="in_english" value="Укажите кол-во" required/>
                    </div>

                    <div class="form-group col-6">
                        <label for="rukovod" class="form-control-label">Рук-во ДП, МД, ДД, практикой, членство ГАК .</label>
                        <input type="number"  class="form-control" id="rukovod" name="rukovod" value="Укажите кол-во" required/>
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
