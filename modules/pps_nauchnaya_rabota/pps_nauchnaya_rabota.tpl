<div class="row text-center">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card bg-lime text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/megaphone.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Набранные баллы</p>
                <h1 class="mb-0 counter mt-1">{USER_BALLS}</h1> баллов
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card bg-orange text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/picture.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Макс. количество баллов</p>
                <h1 class="mb-0 counter mt-1">{CATEGORY_MAX_BALLS}</h1> баллов
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card bg-purple text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/mail.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего форм</p>
                <h1 class="mb-0 counter mt-1">{FORMS_COUNT}</h1> форм
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-md-2">
        <div class="card bg-pink text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/blogging.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего заполнено форм</p>
                <h1 class="mb-0 counter mt-1">{FORMS_FULLED}</h1> форм
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card" id="users">
            {RESULT_MESSAGE}
            <div class="card-header">
                <div class="card-title">Научно-методическая работа - ФОРМЫ для заполнения</div>
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
                                <th >Баллы за заполнение</th>
                                <th >Макс. балл</th>
                                <th >Создана</th>
                                <th >Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            {VOSPITATEL_RABOTA_FORMS_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- section-wrapper -->
    </div>
</div>
