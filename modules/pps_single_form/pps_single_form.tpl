<div class="row">
    <div class="col-md-12 col-lg-12">
     <h4 class="text-center text-red">После добавления данных убедитесь что все поля заполнены правильно и нажмите кнопку "ОТПРАВИТЬ" (для каждой записи) чтобы вам начислились баллы</h4>
        {NODATA}
        <div class="card" id="add_record_in_form" {DISPLAY}>

            <div class="card-header">

                <div class="card-title"> &nbsp;&nbsp; Форма #{FORM_ID} / {FORM_NAME}</div>
                <div class="card-options">
                    <a onclick="createFormForTable({FORM_ID});" class="btn btn-primary">Добавить запись</a>
                </div>
            </div>
            <div class="card-body">

                {CHECK}
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>{GROUP_HEADER}</tr>
                            <tr>

                                <th class="wd-25p">№</th>
                                {HEADERS}
                                <th class="wd-25p">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {SINGLE_FORM_ROWS}

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>

</div>
