<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="users">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Учебная работа - ФОРМЫ для заполнения</div>
                <!--<div class="card-options">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#add-user" href="#">Добавить пользователя</a>
                </div>-->
            </div>

            <div class="card-body">
                {NODATA}
                <div class="table-responsive" {DISPLAY}>
                    <table id="example" class="table table-responsive-sm table-striped table-bordered" {DISPLAY}>
                        <thead>
                            <tr>
                                <th >#</th>
                                <th >Название форм</th>
                                <th >Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ACTION_FORMS_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>
