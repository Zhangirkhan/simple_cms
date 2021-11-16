<div class="col-xl-4 col-lg-6 col-md-12" {DISPLAY}>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{FACULTET_NAME} Топ 10 и общий балл</h3>
            </div>
            <div class="card-body">
                 <div class="table-responsive border-top">
                    <table class="table table-bordered table-hover mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Место</th>
                                <th>Баллы</th>
                            </tr>
                        </thead>
                        <tbody>
                            {FACULTET_ROWS}
                            <tr class="bg-green text-white">
                                <td class="font-weight-semibold fs-16">Всего баллов</td>
                                <td></td>
                                <td class="font-weight-semibold fs-16">{ALL_SUMM_BALLS}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
