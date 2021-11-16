<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card add_poll_header">
        <div class="card-header">
            <a href="/ru/all_forms_admin/" id="cabinet-back" style="display: inline;"><i class="fa fa-arrow-left"></i></a>
            <h3 class="card-title">{PAGE_TITLE}</h3>
        </div>
    </div>
    {RESULT_MESSAGE}
    <form action="" method="post" enctype="multipart/form-data" name="add_form">
        <input type="hidden" name="send" value="1">
        <input type="hidden" name="number" value="1" id="number">
        <div class="card mb-2">
            <div class="card-header ">
                <h3 class="card-title">{STR_NEW_POLL_TITLE}</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-label text-dark">Название формы</label>
                        <input type="text" class="form-control" name="form_name" id="form_name" placeholder="" required >
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-label text-dark">Вид деятельности</label>
                        <select required class="form-control  select2-show-search" name="category_id" id="category_id" data-placeholder="">
                            <option value="0">Выберите вид деятельности</option>
                            {CATEGORY_LIST}
                        </select>
                    </div>
                    <!--<div class="form-group col-md-6">
                        <label class="form-label text-dark">Учебное заведение</label>
                        <select required class="form-control  select2-show-search" name="univer_id" id="univer_id" data-placeholder="" onchange="changefacultets();">
                            <option value="0">Выберите категорию</option>
                            {UNIVER_LIST}
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label text-dark">Факультет</label>
                        <select required class="form-control  select2-show-search" name="facultet_id" id="facultet_id" data-placeholder="">
                        </select>
                    </div>-->
                    <div class="form-group col-md-3">
                        <label class="form-label text-dark">Год</label>
                        <select required class="form-control  select2-show-search" name="year" id="year" data-placeholder="">
                            <option value="0">Выберите год</option>
                            {YEAR_LIST}
                        </select>
                    </div>
                    <!--<div class="form-group col-md-6 col-lg-6">
                        <label class="form-label text-dark">Повторяемый</label>
                        <select required class="form-control  select2-show-search" name="repeat_time" id="repeat_time" data-placeholder="">
                            <option value="Неограничено">Неограничено</option>
                            <option value="Раз в неделю">Раз в неделю</option>
                            <option value="Раз в месяц">Раз в месяц</option>
                            <option value="Раз в квартал">Раз в квартал</option>
                            <option value="Раз в год">Раз в год</option>
                        </select>
                    </div>-->
                    <div class="form-group col-md-3">
                        <label class="form-label text-dark">Статус</label>
                        <select required class="form-control  select2-show-search" name="status" id="status" data-placeholder="">
                            <option value="0">Закрыто</option>
                            <option value="1">Открыто для заполнений</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="form-label text-dark" for="ball">Балл за заполнение</label>
                        <input type="number" class="form-control" name="ball" id="ball" placeholder="Введите балл" required />
                    </div>
                </div>
            </div>
        </div>
        <div class="card" id="card-1">
            <input type="hidden" name="pod_number_1" value="0" id="pod_number_1">
            <div class="card-header">
                <h3 class="card-title">Столбец <span>1</span></h3>
                <div class="card-options">
                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="addColumn();"><i class="fa fa-plus"></i> Добавить столбец</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Label</label>
                        <input type="text" class="form-control" name="label[]" id="label_1" placeholder="Напишите название поля" required onKeyUp="translit(1)">
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Name</label>
                        <input type="text" class="form-control" name="name[]" id="name_1" placeholder="Напишите название поля" required>
                    </div>
                    <div class="form-group col-4">
                        <label class="form-label text-dark">Тип поля</label>
                        <select required class="form-control  select2-show-search" name="type_column[]" id="type_column_1" onchange="addGroupPodColumn(1)" data-placeholder="Выберите тип поля" required>
                            <option value="" disabled>Выберите тип поля</option>
                            <!--<option value="1">Группа</option>-->
                            <option value="2">Текст</option>
                            <option value="3">Цифры</option>
                            <option value="4">Почта</option>
                            <option value="5">Номер телефона</option>
                            <option value="6">Файлы</option>
                        </select>
                    </div>

                    <div class="form-group col-4">
                        <label class="form-label text-dark">Placeholder</label>
                        <input type="text" class="form-control" name="placeholder[]" id="placeholder_1" placeholder="Напишите примеры как нужно заполнять данное поле">
                    </div>
                    <div class="form-group col-4">

                        <label class="form-label text-dark">Обязательность</label>
                        <select required class="form-control  select2-show-search" name="required_field[]" id="required_field_1" data-placeholder="Выберите Обязательность" required>
                            <option value="" disabled>Выберите Обязательность</option>
                            <option value="1">Обязательно</option>
                            <option value="2">Не обязателен</option>
                        </select>
                    </div>

                </div>
                <hr>
                <div id="GROUP_ID_1">
                </div>

            </div>
        </div>

        <div id="card_cont"></div>

        <div class="float-right mb-4 mb-lg-0">
            <!-- <a class="btn btn-success w-150" href="javascript:void(0);" onclick="frmAdd.submit();"></a>-->
            <button type="submit" class="btn btn-success w-150">{STR_SEND_TITLE}</button>
        </div>

    </form>


</div>

<script>
    var index = 1;
    var values = new Array();

    var podindex = 1;
    var podvalues = new Array();


    function addColumn() {
        index = index + 1;

        var j = 0;
        for (i = 1; i < index; i++) {
            values[j] = [
                $('#label_' + i).val(),
                $('#name_' + i).val(),
                $('#type_column_' + i).val(),
                $('#placeholder_' + i).val(),
                $('#required_field_' + i).val(),

            ];

            j++;
        }

        var out = `<div class="card" id="card-` + index + `">
            <div class="card-header">
                <h3 class="card-title">Столбец <span>` + index + `</span></h3>
                <div class="card-options">
                <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteColumn(` + index + `);"><i class="fa fa-plus"></i> Удалить столбец</a>&nbsp;
                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="addColumn();"><i class="fa fa-plus"></i> Добавить столбец</a>

                </div>
            </div>
            <div class="card-body">
                <div class="form-row">
                <div class="form-group col-6">
                <label class="form-label text-dark">Label</label>
                <input type="text" class="form-control" name="label[]" id="label_` + index + `" placeholder="Напишите название поля" required onKeyUp="translit(` + index + `)">
            </div>
            <div class="form-group col-6">
                <label class="form-label text-dark">Name</label>
                <input type="text" class="form-control" name="name[]" id="name_` + index + `" placeholder="Напишите название поля" required>
            </div>
            <div class="form-group col-4">
                <label class="form-label text-dark">Тип поля</label>
                <select required class="form-control  select2-show-search" name="type_column[]" id="type_column_` + index + `" onchange="addGroupPodColumn(` + index + `)" data-placeholder="Выберите тип поля" required>
                    <option value="" disabled selected>Выберите тип поля</option>
                    <!--<option value="1">Группа</option>-->
                    <option value="2">Текст</option>
                    <option value="3">Цифры</option>
                    <option value="4">Почта</option>
                    <option value="5">Номер телефона</option>
                    <option value="6">Файлы</option>
                </select>
            </div>

            <div class="form-group col-4">
                <label class="form-label text-dark">Placeholder</label>
                <input type="text" class="form-control" name="placeholder[]" id="placeholder_` + index + `" placeholder="Напишите примеры как нужно заполнять данное поле">
            </div>
            <div class="form-group col-4">

                            <label class="form-label text-dark">Обязательность</label>
                            <select required class="form-control  select2-show-search" name="required_field[]" id="required_field_` + index + `" data-placeholder="Выберите Обязательность" required>
                                <option value="0" selected>Выберите Обязательность</option>

                                <option value="1">Обязательно</option>
                                <option value="2">Не обязателен</option>
                            </select>
            </div>
                </div>
                <hr>
                <div id="GROUP_ID_` + index + `">
                </div>
                </div>
        </div>
                `;

        document.getElementById('card_cont').innerHTML += out;
        document.getElementById('number').value = index;

        var j = 0;
        for (i = 1; i < index; i++) {
            $('#label_' + i).val(values[j][0]),
                $('#name_' + i).val(values[j][1]),
                $('#type_column_' + i).val(values[j][2]),
                $('#placeholder_' + i).val(values[j][3]),
                $('#required_field_' + i).val(values[j][4]),

                j++;
        }
        $('#card-' + index).focus();
        $(document).scrollTop($("#card-" + index).offset().top);
    }

    function addGroupPodColumn(i) {


        console.log(i);
        var a = $('#type_column_' + i + '_1').val();
        if (a == 1) {
            var out = `<div class="expanel expanel-default" id="form_group_id_` + i + `_1">

            <div class="expanel-heading">
                <h3 class="expanel-title">Под столбец <span>` + i + `</span> &nbsp;<a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="addColumnForGroup(` + i + `);"><i class="fa fa-plus"></i> Добавить подстолбец</a>
                </h3>

            </div>
            <div class="expanel-body">
                <div class="row jumbotron">
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Название подстолбца ` + i + `</label>
                        <input type="text" class="form-control" name="podtitle_` + i + `_1" id="podtitle_` + i + `_1" placeholder="" required>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Тип поля</label>
                        <select required class="form-control  select2-show-search" name="type_column_` + i + `_1" id="type_column_` + i + `_1" data-placeholder="">
                            <option value="1">Текст</option>
                            <option value="2">Цифры</option>
                            <option value="3">Почта</option>
                            <option value="4">Номер телефона</option>
                            <option value="5">Файлы</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Пример заполнения</label>
                        <input type="text" class="form-control" name="example_` + i + `_1" id="example_` + i + `_1" placeholder="">
                    </div>
                </div>
            </div>
        </div>`;
            document.getElementById('GROUP_ID_' + i).innerHTML += out;
            document.getElementById('pod_number_' + i).value = podindex;

        } else {
            return;
        }
    }

    function addColumnForGroup(column_id) {

        podindex = podindex + 1;

        var j = 0;
        for (i = 1; i < podindex; i++) {
            values[j] = [
                $('#podtitle_' + column_id + '_' + i).val(),
                $('#type_column_' + column_id + '_' + i).val(),
                $('#example_' + column_id + '_' + i).val(),
            ];

            j++;
        }

        var out = `<div class="expanel expanel-default" id="form_group_id_` + column_id + `_` + i + `">
            <div class="expanel-heading">
                <h3 class="expanel-title">Под столбец <span>` + i + `</span> &nbsp;<a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="addColumnForGroup(` + column_id + `);"><i class="fa fa-plus"></i> Добавить подстолбец</a>
                </h3>

            </div>
            <div class="expanel-body">
                <div class="row jumbotron">
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Название подстолбца ` + i + `</label>
                        <input type="text" class="form-control" name="podtitle_` + column_id + `_` + i + `" id="podtitle_` + column_id + `_` + i + `" placeholder="" required>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Тип поля</label>
                        <select required class="form-control  select2-show-search" name="type_column_` + column_id + `_` + i + `" id="type_column_` + column_id + `_` + i + `" data-placeholder="">
                            <option value="1">Текст</option>
                            <option value="2">Цифры</option>
                            <option value="3">Почта</option>
                            <option value="4">Номер телефона</option>
                            <option value="5">Файлы</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label class="form-label text-dark">Пример заполнения</label>
                        <input type="text" class="form-control" name="example_` + column_id + `_` + i + `" id="example_` + column_id + `_` + i + `" placeholder="">
                    </div>
                </div>
            </div>
        </div>`;

        document.getElementById('GROUP_ID_' + column_id).innerHTML += out;
        document.getElementById('pod_number_' + column_id).value = podindex;
        var j = 0;
        for (i = 1; i < podindex; i++) {
            $('#podtitle_' + column_id + '_' + i).val(values[j][0]),
                $('#type_column_' + column_id + '_' + i).val(values[j][1]),
                $('#example_' + column_id + '_' + i).val(values[j][2]),

                j++;
        }
    }

    function deleteQuestion(id) {
        $('#card-' + id).remove();

    }

    function deleteColumn(id) {
        $('#card-' + id).remove();
        document.getElementById('number').value = document.getElementById('number').value - 1;
        index = index - 1;
    }
</script>
