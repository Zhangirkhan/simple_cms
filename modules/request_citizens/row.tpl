<tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{ID}" aria-expanded="false" aria-controls="group-of-rows-{ID}" style="cursor: pointer;">
    <td>
        <h5>#{ID}</h5>
    </td>
    <td>{STATUS}</td>
    <td style="white-space: normal;">
        <h5><b>{TYPE}</b></h5>
        <h6>{DESCR}</h6>
    </td>

    <td>{DATE} <br> {TIME}</td>
    <td><b>{AUTHOR} <br> {AUTHOR_PHONE}</b> <br> {CITY}, {STR_STREET_SOKR_TITLE} {STREET} {HOUSE} {FLAT_NUMBER}</td>
    <td>
        <h6 class="font-weight-semibold"><b>{EXECUTOR} </b> </h6> {EXECUTOR_PHONE}
    </td>
    <td>{REVIEW}</td>
    <td>
        {ACTION}
    </td>
</tr>
<tr id="group-of-rows-{ID}" class="collapse">
    <td colspan="8">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-md-6 col-xl-6 col-lg-6">
                    <h5>{STR_DESCRIPTION_TITLE}:</h5>
                    <p style="white-space: normal;">{DESCR2}</p>
                    {REVIEW_TEXT}
                </div>
                <div class="col-xs-3 col-md-3 col-xl-3 col-lg-3">
                </div>
                <div class="col-xs-3 col-md-3 col-xl-3 col-lg-3">
                    <div class="card-body">
                        <div id="carousel-controls-{ID}" class="carousel slide" data-ride="carousel-{ID}">
                            <div class="carousel-inner">
                                {IMAGES_LIST}
                            </div>
                            <a class="carousel-control-prev" href="#carousel-controls-{ID}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-controls-{ID}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer pull-right">
            {ACTION2}
        </div>
    </td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
</tr>