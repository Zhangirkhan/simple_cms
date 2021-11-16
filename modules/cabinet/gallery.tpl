<div class="card">
    <div class="card-header">
        <h3 class="card-title">{GALLERY_TITLE}</h3>
        <div class="card-options">
            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options" type="button" onclick="setGalleryId({GALLERY_ID}, '{GALLERY_TITLE}');" data-toggle="modal" data-target="#edit-albome"> <i class="fe fe-edit-3"></i></a>
            <a href="#" class="card-options-remove" data-toggle="card-remove" onclick="deleteGallery({GALLERY_ID});"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="demo-gallery">
            <ul id="lightgallery" class="list-unstyled row">
                {IMAGES_ROWS}
            </ul>
        </div>
    </div>
</div>