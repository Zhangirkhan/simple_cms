<div class="col-xl-10 col-lg-12 col-md-12">
    <div class="card mb-2">
        <div class="card-header">
            <a href="/ru/smeta_osi/" id="cabinet-back" style="display: inline;"><i class="fa fa-arrow-left"></i></a>
            <h3 class="card-title">{PAGE_TITLE}</h3>
            <div class="card-options">
                <!-- <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#add-block-smeta-osi" href="#"><i class="fa fa-plus"></i>Добавить Расход</a>-->
                &nbsp;
                {DOWNLOAD_FILE_INNER}
            </div>
        </div>
        <div class="card-body">
            {NODATA}
            <div class="table-responsive border-top userprof-tab" style="{HIDDEN}">
                <table class="table table-bordered table-hover mb-0 text-nowrap ">
                    <thead>
                        <tr>
                            <!--  <th></th> -->
                            <th class="w-30">{STR_REQUEST_TYPE_AND_DESCRIPTION_TITLE}</th>
                            <th>{STR_SMETA_DATE_TITLE}</th>
                            <th>{STR_ADDRESS_PLACEHOLDER_TITLE}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {ITEM_INNER_ROWS}
                    </tbody>
                </table>
            </div>

        </div>
        <!--<div class="card-footer">
                <div class="row">
                    <div class="col-6">
                        <h5> Скачайте файл (Если кнопки скачать файл нет, то вложенный файл отсутвует) </h5>
                        
                    </div>
                    <div class="col-6">
                        {DOWNLOAD_FILE_INNER}
                   
                    </div>

                </div>
            </div> -->
    </div>

    <div class="card mb-2">
        <div class="card-header">
            <h3 class="card-title">{STR_MAKE_VOTE_TITLE}</h3>
        </div>
        <div class="card-body">
            <div class="custom-controls-stacked">
                <form action="" method="post" name="frmPoll">
                    <input type="hidden" value="1" name="poll_send" id="poll_send">
                    <div class="row mb-4">
                        <div class="col-md-4" {DISPLAY_1}>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="answer" value="1" checked="" required>
                                <span class="custom-control-label">{STR_YES_TITLE}</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="answer" value="2" required>
                                <span class="custom-control-label">{STR_NO_TITLE}</span>
                            </label>
                            <label class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="answer" value="3" required>
                                <span class="custom-control-label">{STR_MAYBE_TITLE}</span>
                            </label>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-0 col-10">
                                <div class="chat-details p-2">
                                    <h6 class="mb-0"> <span class="font-weight-normal">{STR_YES_TITLE}</span> <span class="float-right p-1">{NUM_PER_1}%</span> </h6>
                                    <div class="progress  mt-3">
                                        <div class="progress-bar progress-bar-animated bg-success " style="width: {NUM_PER_1}%"> ({POLL_COUNT_1}
                                            {STR_POLL_ANSWERS_COUNT_TITLE})
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-details p-2">
                                    <h6 class="mb-0"> <span class="font-weight-normal">{STR_NO_TITLE}</span> <span class="float-right p-1">{NUM_PER_2}%</span> </h6>
                                    <div class="progress  mt-3">
                                        <div class="progress-bar progress-bar-animated bg-danger " style="width: {NUM_PER_2}%"> ({POLL_COUNT_2}
                                            {STR_POLL_ANSWERS_COUNT_TITLE})
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-details p-2">
                                    <h6 class="mb-0"> <span class="font-weight-normal">{STR_MAYBE_TITLE}</span>
                                        <span class="float-right p-1">{NUM_PER_3}%</span> </h6>
                                    <div class="progress  mt-3">
                                        <div class="progress-bar progress-bar-animated bg-info " style="width: {NUM_PER_3}%"> ({POLL_COUNT_3}
                                            {STR_POLL_ANSWERS_COUNT_TITLE})
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-8">
                            <div class="card-body p-0 col-10">
                                <div class="progress progress-md mb-3 ">
                                    <div class="progress-bar bg-success" style="width: {NUM_PER_1}%"> {NUM_PER_1}% ({POLL_COUNT_1} {STR_POLL_ANSWERS_COUNT_TITLE})</div> 
                                </div>
                                <div class="progress progress-md mb-3">
                                    <div class="progress-bar bg-danger" style="width: {NUM_PER_2}%"> {NUM_PER_2}% ({POLL_COUNT_2} {STR_POLL_ANSWERS_COUNT_TITLE})</div>
                                </div>
                                <div class="progress progress-md mb-">
                                    <div class="progress-bar bg-info" style="width: {NUM_PER_3}%"> {NUM_PER_3}% ({POLL_COUNT_3} {STR_POLL_ANSWERS_COUNT_TITLE})</div>
                                </div>
                            </div>
                        </div>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="frmPoll.submit();" {DISPLAY_2}>{STR_MAKE_VOTE_TITLE}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{STR_POLL_COMMENTS_TITLE}</h3>
        </div>
        <div class="card-body pt-2 ">
            <div class="content1 vscroll" style=" max-height:300px !important;">
                {COMMENTS_ROWS}
            </div>
            <div class="card-body">
                <div>
                    <form action="" method="post" name="frmComment">
                        <input type="hidden" value="1" name="send" id="send">
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="6" placeholder="{STR_WRITE_COMMENT_TITLE}" required></textarea>
                        </div>
                        <a href="javascript:void(0);" onclick="frmComment.submit();" class="btn btn-primary">{STR_SEND_TITLE}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- Message Modal -->
<div class="modal fade" id="add-block-smeta-osi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">{STR_SMETA_ADD_RASHOD_TITLE}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vscroll" style="max-height:500px">
                <form action="" method="post" enctype="multipart/form-data" name="frmAdd">
                    <input type="hidden" name="inner_send" value="1">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_INNER_TITLE}</label>
                        <input class="form-control" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" name="title" required />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_COUNT_TITLE}</label>
                        <input class="form-control" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" name="quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_PRICE_PER_ED_TITLE}</label>
                        <input class="form-control" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" name="price_per" required />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_PRICE_TITLE}</label>
                        <input class="form-control" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" name="price" required />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_SROK_TITLE}</label>
                        <input class="form-control" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" name="srok" required />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_DESCRIPTION_TITLE}</label>
                        <textarea rows="3" class="form-control" name="description" placeholder="{STR_DESCRIPTION_PLACEHOLDER_TITLE}" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                <button type="button" class="btn btn-primary" onclick="frmAdd.submit();">{STR_ADD_TITLE}</button>
            </div>
        </div>
    </div>
</div>