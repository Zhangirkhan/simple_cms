
<div class="row">
    <div class="col-lg-12">
    <h1 class="text-center">Рейтинг преподавателей &nbsp; <a class="btn btn-primary" href="/ru/auth" >Войти</a> <a class="btn btn-success" href="/instruction/instruction.doc" >Инстукция по заполнению</a> <a class="btn btn-success" href="/instruction/presentation.ppt" >Презентация проекта</a></h1>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">РЕЙТИНГ</h3>
            </div>
            <div class="card-body">
            <div class="mail-option">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <form action="" method="post" name="frmFilter1">
                                        <input type="hidden" name="ex" value="0">
                                        <div class="form-group">
                                            <select name="facultet_filters" class="select2-show-search" onchange="frmFilter1.submit();">
                                                <option value="0">Все факультеты</option>
                                                <option value="1" {FILTER1}>Факультет Архитектуры</option>
                                                <option value="2" {FILTER2}>Факультет Дизайна</option>
                                                <option value="3" {FILTER3}>Факультет Общего Строительства</option>
                                                <option value="4" {FILTER4}>Факультет Строительных Технологий, Инфраструктуры и Менеджмента</option>
												 <option value="14" {FILTER14}>Факультет Общеобразовательных Дисциплин</option>
                                                <option value="5" {FILTER5}>Факультет Общеобразовательных и Гуманитарных Наук</option>
                                                <option value="6" {FILTER6}>Факультет Экономики и Права</option>
                                                <option value="7" {FILTER7}>Факультет Прикладных Наук</option>

                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <div class="table-responsive border-top">
                    <table class="table table-bordered table-hover mb-0 text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th>Место</th>
                                <th>ФИО</th>
                                <th>Факультет</th>
                                <th>Внеаудиторная работа</th>
                                <th>Научно-методическая работа</th>
                                <th>Общий баллы</th>
                            </tr>
                        </thead>
                        <tbody>
                        {RAITING_ROWS}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
