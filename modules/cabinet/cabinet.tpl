<div class="col-xl-12 col-lg-12 col-md-12">
    <div class="card user-content-right">
        <div class="card-header">

            <h3 class="card-title">{PAGE_TITLE}</h3>
        </div>
        <div class="card-body">
            {ROWS}
        </div>
    </div>
</div>

<!-- MODAL ADD ALBUM -->
<div class="modal fade" id="add-albome" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <form action="" method="post" name="frmAddAlbum">
                <input type="hidden" name="gallery_send" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-album-title">{STR_ADD_ALBUM_GALLERY_TITLE}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body vscroll" style="max-height:700px">

                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_INNER_TITLE}</label>
                        <input rows="3" class="form-control" maxlength="200" name="title" placeholder="{STR_PHOTO_ENTER_NAME_TITLE}" required />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                    <button type="submit" class="btn btn-primary">{STR_ADD_TITLE}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ADD PHOTO -->
<div class="modal fade" id="add-photo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <form action="" method="post" name="frmAddImage" enctype="multipart/form-data">
                <input type="hidden" name="image_send" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-photo-title">{STR_ADD_PHOTO_GALLERY_TITLE}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label class="form-label text-dark">{STR_PHOTOGALLERY_SELECT_ALBUM_TITLE}</label>
                        <select class="form-control" name="album_id" data-placeholder="{STR_CHOOSE_ALBUM}" required>
                            {ALBUM_LIST}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_INNER_TITLE}</label>
                        <input rows="3" name="title" class="form-control" maxlength="200" placeholder="{STR_PHOTO_ENTER_NAME_TITLE}" required />
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-control-label">{STR_KN_ADD_PHOTO_TITLE}</label>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <input type="file" class="dropify" name="file" data-height="180" data-allowed-file-extensions="jpg jpeg gif png bmp" data-max-file-size="10M" required />
                            </div>

                        </div>
                    </div>
                    <!--<div class="progress" style="display: none;">
                        <div class="bar"></div>
                        <div class="percent">0%</div>
                    </div>
                    <div id="status"></div> -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                    <button type="submit" class="btn btn-primary">{STR_ADD_TITLE}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT ALBUM -->

<div class="modal fade" id="edit-albome" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content ">
            <form action="" method="post" name="frmEditGallery">
                <input type="hidden" name="edit_send" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-albome">{STR_EDIT_ALBUM_TITLE}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body vscroll" style="max-height:700px">

                    <input type="hidden" name="gallery_id" id="gallery_id" value="0">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_INNER_TITLE}</label>
                        <input rows="3" class="form-control" name="title" id="gallery_title" maxlength="200" placeholder="{STR_PHOTO_ENTER_NAME_TITLE}" required />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                    <button type="submit" class="btn btn-primary">{STR_ADD_TITLE}</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- MODAL ADD REPORTS  -->
<div class="modal fade" id="add-report" tabindex="-1" role="dialog" aria-labelledby="add-report" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data" name="frmDocs">
                <input type="hidden" value="1" name="docs_send">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-report-title">{STR_ADD_OTCHET_TITLE}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="title" class="form-control-label">{STR_SMETA_INNER_TITLE}:</label>
                        <input type="text" name="title" class="form-control" maxlength="200" id="title" required />
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-label">{STR_ONE_DOC_TITLE}</label>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <input type="file" name="file" class="dropify" data-allowed-file-extensions="doc docx txt rtf pdf xls xml" data-max-file-size="10M" data-height="180" required />
                            </div>
                        </div>
                    </div>
                    <br>
                    <!--<div class="progress" style="display: none;">
                        <div class="bar"></div>
                        <div class="percent">0%</div>
                    </div>
                    <div id="status"></div>-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                    <button type="submit" class="btn btn-primary">{STR_SAVE_TITLE}</button>
                </div>
            </form>
        </div>
    </div>
</div>
