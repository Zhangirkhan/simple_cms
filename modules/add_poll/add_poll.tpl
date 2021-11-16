<div class="col-xl-10 col-lg-12 col-md-12">
    <div class="card add_poll_header">
        <div class="card-header">
            <a href="/ru/polls_citizen/" id="cabinet-back" style="display: inline;"><i class="fa fa-arrow-left"></i></a>
            <h3 class="card-title">{PAGE_TITLE}</h3>
        </div>
    </div>

    {RESULT_MESSAGE}
    <form action="" method="post" enctype="multipart/form-data" name="frmAdd">
        <input type="hidden" name="send" value="1">
        <input type="hidden" name="number" value="1" id="number">

        <div class="card mb-2">
            <div class="card-header ">
                <h3 class="card-title">{STR_NEW_POLL_TITLE}</h3>

            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-3">
                        <label class="form-label text-dark">{STR_TITLE_TEXT_TITLE}</label>
                        <textarea class="form-control" name="title" cols="30" rows="6" required>
Приложение 4к 
Протоколу собрания №1
от «»__2020г.
собственников квартир,
нежилого помещения
                        </textarea>
                    </div>
                    <div class="form-group col-9">
                        <label class="form-label text-dark">{STR_DESCRIPTION_TITLE_1}</label>
                        <textarea class="form-control" name="description" cols="30" rows="6" required disabled="">{STR_ADD_POLL_DESCR_TITLE}</textarea>
                    </div>
                </div>
                <div class="form-group mb-4">

                    <div class="row gutters-xs">
                        <div class="col-6 mb-3">
                            <label class="form-label text-dark">{STR_SELECT_HOUSE_TITLE}</label>
                            <select required class="form-control custom-select select2-show-search" name="house_id" id="house_id" onchange="getFlatsInHouse();" data-placeholder="">
                                {FLAT_LIST}
                            </select>
                        </div>
                        <div class="col-6 mb-3" {DISPLAY_SECRETAR}>
                            <label class="form-label text-dark">Кто являеться секратарем собрания?</label>
                            <select required class="form-control custom-select select2-show-search" name="secretar" id="secretar" onchange="getSecretar();" data-placeholder="">
                                <option value="0" selected>ОСИ</option>
                                <option value="1">Житель</option>
                            </select>
                        </div>
                        <div class="col-6" {DISPLAY_PREDCEDATEL}>
                            <label class="form-label text-dark">Председатель собрания</label>
                            <select required class="form-control custom-select select2-show-search" name="predcedatel_sobrania" id="predcedatel_sobrania" data-placeholder="">
                            </select>
                        </div>

                        <div class="col-6" {DISPLAY_SECRETAR}>
                            <label class="form-label text-dark">Секретарь собрания</label>
                            <select required class="form-control custom-select select2-show-search" name="secretar_sobrania" id="secretar_sobrania" data-placeholder="">
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header ">
                <h3 class="card-title">{STR_QUESTION_TITLE} <span>1</span></h3>
                <div class="card-options">
                    <a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="addQuestion();"><i class="fa fa-plus"></i> {STR_ADD_QUESTION_TITLE}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label text-dark">{STR_TITLE_TEXT_TITLE}</label>
                    <input type="text" class="form-control" name="question_title_1" id="question_title_1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label class="form-label text-dark">{STR_DESCRIPTION_TITLE}</label>
                    <textarea class="form-control" name="question_description_1" id="question_description_1" rows="6" placeholder="{STR_ENTER_TEXT_TITLE}" required></textarea>
                </div>
                <div class="row">
                    <div class="form-group mb-0 col-lg-6 col-sm-12">
                        <label class="form-control-label"> {STR_PHOTO_TITLE}</label>
                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo1_question_1" id="photo1_question_1" data-height="180" />
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="photo2_question_1" id="photo2_question_1" data-height="180" />
                            </div>


                        </div>
                    </div>
                    <div class="form-group mb-0 col-lg-6 col-sm-12">
                        <label class="form-control-label"> {STR_DOC_TITLE}</label>
                        <div class="row">

                            <div class="col-lg-6 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="doc docx docm rtf txt xls xlsx xlsm ppt pptx" data-max-file-size="10M" name="doc1_question_1" id="doc1_question_1" data-height="180" />
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="doc docx docm rtf txt xls xlsx xlsm ppt pptx" data-max-file-size="10M" name="doc2_question_1" id="doc2_question_1" data-height="180" />
                            </div>


                        </div>
                    </div>
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

    function addQuestion() {
        index = index + 1;

        var j = 0;
        for (i = 1; i < index; i++) {
            values[j] = [
                $('#question_title_' + i).val(),
                $('#question_description_' + i).val(),
                $('#photo1_question_' + i).val(),
                $('#photo2_question_' + i).val(),
                $('#doc1_question_' + i).val(),
                $('#doc2_question_' + i).val()
            ];

            j++;
        }

        var out = `<div class="card" id="card-` + index + `">
                    <div class="card-header">
<h3 class="card-title">{STR_QUESTION_TITLE} <span>` + index + `</span></h3>
                        <div class="card-options">
<a class="btn btn-info btn-sm" href="javascript:void(0);" onclick="addQuestion();"><i class="fa fa-plus"></i> {STR_ADD_QUESTION_TITLE} </a>&nbsp;  
<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteQuestion(` + index + `);"><i class="fa fa-plus"></i> Удалить вопрос</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
<label class="form-label text-dark">{STR_TITLE_TEXT_TITLE}</label>
                            <input type="text" class="form-control" name="question_title_` + index + `" id="question_title_` + index + `" placeholder="" required>
                        </div>
                        <div class="form-group">
<label class="form-label text-dark">{STR_DESCRIPTION_TITLE}</label>
<textarea class="form-control" name="question_description_` + index + `" id="question_description_` + index + `" rows="6" placeholder="{STR_ENTER_TEXT_TITLE}" required></textarea>
                        </div>

                        <div class="form-group mb-0">
<label class="form-label">{STR_PHOTO_TITLE}</label>
                            <div class="custom-file mb-1">
                                <input type="file" class="custom-file-input" name="photo1_question_` + index + `" id="photo1_question_` + index + `">
<label class="custom-file-label">{STR_ADD_PHOTO_TITLE}</label>
                            </div>

                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input" name="photo2_question_` + index + `" id="photo2_question_` + index + `">
<label class="custom-file-label">{STR_ADD_PHOTO_TITLE}</label>
                            </div>
                            
<label class="form-label">{STR_DOC_TITLE}</label>
                            <div class="custom-file mb-1">
                                <input type="file" class="custom-file-input" name="doc1_question_` + index + `" id="doc1_question_` + index + `">
<label class="custom-file-label">{STR_ADD_DOC_TITLE}</label>
                            </div>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="doc2_question_` + index + `" id="doc2_question_` + index + `">
<label class="custom-file-label">{STR_ADD_DOC_TITLE}</label>
                            </div>
                        </div>
                    </div>
                </div>`;

        document.getElementById('card_cont').innerHTML += out;
        document.getElementById('number').value = index;

        var j = 0;
        for (i = 1; i < index; i++) {
            $('#question_title_' + i).val(values[j][0]),
                $('#question_description_' + i).val(values[j][1]),
                $('#photo1_question_' + i).val(values[j][2]),
                $('#photo2_question_' + i).val(values[j][3]),
                $('#doc1_question_' + i).val(values[j][4]),
                $('#doc2_question_' + i).val(values[j][5])

            j++;
        }
    }

    function deleteQuestion(id) {
        $('#card-' + id).remove();
    }
</script>