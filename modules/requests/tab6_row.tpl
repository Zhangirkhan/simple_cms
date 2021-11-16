<tr>
    <td onclick="showinfo({ID}, 6)" style="cursor: pointer;">
        <h5>#{ID} </h5>
    </td>
    <td onclick="showinfo({ID}, 6)" style="cursor: pointer; white-space: normal;">
        <div class="media mt-0 mb-0">
            <div class="media-body">
                <div class="card-item-desc p-0">
                    <a class="text-dark">
                        <h5>{TYPE}</h5>
                        <h6>{DESCR}</h6>
                    </a>
                </div>
            </div>
        </div>
    </td>
    <td onclick="showinfo({ID}, 6)" style="cursor: pointer; white-space: normal;"><a class="badge badge-danger" style="color: white">{STATUS}</a></td>
    <td onclick="showinfo({ID}, 6)" style="cursor: pointer; white-space: normal;">{DATE} <br> {TIME}</td>
    <td onclick="showinfo({ID}, 6)" style="cursor: pointer; white-space: normal;"><b>{AUTHOR} <br> {AUTHOR_PHONE}</b> <br> {CITY}, {STR_STREET_SOKR_TITLE} {STREET} {HOUSE} {FLAT_NUMBER}</td>
    <td onclick="showinfo({ID}, 6)" style="cursor: pointer; white-space: normal;">
        <h6 class="font-weight-semibold"><b>{EXECUTOR} </b> </h6> {EXECUTOR_PHONE}
    </td>

    <td onclick="showinfo({ID}, 6)" style="cursor: pointer; white-space: normal;">
        {REVIEW_TEXT}
    </td>
    <td>
        {ACTION}
    </td>
</tr>