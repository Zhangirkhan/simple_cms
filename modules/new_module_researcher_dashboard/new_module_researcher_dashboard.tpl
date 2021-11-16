<div class="row">
    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card bg-purple text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/megaphone.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего показателей</p>
                <h1 class="mb-0 counter mt-1">{FORMS_COUNT}</h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card bg-purple text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/mail.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего записей</p>
                <h1 class="mb-0 counter mt-1">{RECORDS_COUNT}</h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card bg-purple text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/blogging.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего направлений</p>
                <h1 class="mb-0 counter mt-1">{DIRECTION_COUNT}</h1>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 col-sm-6">
        <div class="card bg-purple text-center p-4 text-white">
            <div class="admin-custom-icon">
                <img src="../assets/images/svg/blogging.svg" alt="email" class="w-30">
            </div>
            <div class="item-all-text mt-3">
                <p class="mb-0">Всего подразделений</p>
                <h1 class="mb-0 counter mt-1">{DEPARTMENTS_COUNT}</h1>
            </div>
        </div>
    </div>
</div>

<!--Топ факультетов-->
<div class="row" {DISPLAY_NONE}>
    <div class="col-xl-12 col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Топ факультетов</h3>
            </div>
            <div class="card-body">
                 <div class="table-responsive border-top">
                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th>Факультет</th>
                                <th>Место</th>
                                <th>Общие баллы</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ROWS}
                            <tr class="bg-green text-white">
                                <td class="font-weight-semibold fs-16">Всего баллов по всем</td>
                                <td></td>
                                <td class="font-weight-semibold fs-16">{ALL_FACULTETS_BALLS}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Топ факультетов-->
<div class="row" {DISPLAY_NONE}>
    <div class="col-xl-12 col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Топ факультетов по Внеаудиторной работе</h3>
            </div>
            <div class="card-body">
                 <div class="table-responsive border-top">
                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th>Факультет</th>
                                <th>Место</th>
                                <th>Баллы по Внеаудиторной работе</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ROWS_VNEAUDIT}
                            <tr class="bg-green text-white">
                                <td class="font-weight-semibold fs-16">Всего баллов по Внеаудиторной работе</td>
                                <td></td>
                                <td class="font-weight-semibold fs-16">{ALL_FACULTETS_VNEAUDIT_BALLS}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!--Топ факультетов-->
<div class="row" {DISPLAY_NONE}>
    <div class="col-xl-12 col-lg-6 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Топ факультетов по научно-методической работе</h3>
            </div>
            <div class="card-body">
                 <div class="table-responsive border-top">
                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th>Факультет</th>
                                <th>Место</th>
                                <th>Баллы научно-методической работе</th>
                            </tr>
                        </thead>
                        <tbody>
                            {ROWS_NAUCHNO}
                            <tr class="bg-green text-white">
                                <td class="font-weight-semibold fs-16">Всего баллов по научно-методической работе</td>
                                <td></td>
                                <td class="font-weight-semibold fs-16">{ALL_FACULTETS_NAUCHNO_BALLS}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    {FACULTETS}
</div>
