<div class="col-xl-10 col-lg-12 col-md-12">
    <div class="panel-body pt-0">
        <div class="card mb-2">
            <form action="" method="post" enctype="multipart/form-data" name="frmAdd">
                <input type="hidden" name="send" value="1">
                <div class="card-header ">
                    <a href="{KNOWLEGE_LINK}" id="cabinet-back" style="display: inline;"><i class="fa fa-arrow-left"></i></a>
                    <h3 class="card-title">{STR_KN_NEW_ARTICLE}</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label text-dark">{STR_KN_SELECT_TYPE_ARTICLE}</label>
                        <select class="form-control" data-placeholder="Выбрать" name="type" required>
                            {TYPE_LIST}
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label text-dark">{STR_TITLE_TEXT_TITLE}</label>
                        <input type="text" class="form-control" name="title" required/>
                    </div>
                    <div class="form-group">
                        <textarea class="content" name="editor" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{STR_PHOTO_TITLE}</label>
                        <div class="custom-file">
                            <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="main_pic" data-height="180" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">{STR_KN_ADD_PHOTO_TITLE}</label>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="file1" data-height="180" />
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="file2" data-height="180" />
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="file3" data-height="180" />
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" name="file4" data-height="180" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <button type="submit" class="btn btn-success btn-block">{STR_SEND_TITLE}</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>