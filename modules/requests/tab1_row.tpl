<!-- <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{ID}" aria-expanded="false" aria-controls="group-of-rows-{ID}" onclick="showinfo({ID}, 1)" style="cursor: pointer;"> -->
<tr>
    <td onclick="showinfo({ID}, 1)" style="cursor: pointer;">
        <h5>№{ID} </h5>
    </td>
    <td onclick="showinfo({ID}, 1)" style="cursor: pointer;">
        <div class="media mt-0 mb-0">
            <div class="media-body">
                <div class="card-item-desc p-0" style="white-space: normal;">
                    <a class="text-dark">
                        <h5>{TYPE}</h5>
                        <h6>{DESCR}</h6>

                    </a>
                </div>
            </div>
        </div>
    </td>
    <td onclick="showinfo({ID}, 1)" style="cursor: pointer;"><a class="badge badge-success" style="color: white">{STATUS}</a></td>
    <td onclick="showinfo({ID}, 1)" style="cursor: pointer;">{DATE} <br> {TIME}</td>
    <td onclick="showinfo({ID}, 1)" style="cursor: pointer;"><b>{AUTHOR} <br> {AUTHOR_PHONE}</b> <br> {CITY}, {STR_STREET_SOKR_TITLE} {STREET} {HOUSE} {FLAT_NUMBER}</td>
    <td onclick="showinfo({ID}, 1)" style="cursor: pointer;">
        <h6 class="font-weight-semibold"><b>{EXECUTOR} </b> </h6> {EXECUTOR_PHONE}
    </td>
    <td>
        {ACTION}
    </td>
</tr>
<!-- <tr id="group-of-rows-{ID}" class="collapse">
    <td colspan="7">
        <div class="card-body">
            <div class="row">
                <div class="col-xs-6 col-md-6 col-xl-6 col-lg-6">
                    <h5>Описание:</h5>
                    <p style="white-space: normal;">{DESCR2}</p>

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
                                <span class="sr-only">Пред.</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-controls-{ID}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">След.</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pull-right">
            <div class="btn-list mb-2">

                {ACTION2}
            </div>
        </div>

    </td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
    <td style="display:none;"></td>
</tr> -->