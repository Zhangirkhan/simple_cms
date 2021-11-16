<tr>
    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;">
        <h5>№{ID} </h5>
    </td>
    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;">
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
    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;"><a class="badge badge-danger" style="color: white">{STATUS}</a></td>
    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;">{DATE} <br> {TIME}</td>
    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;"><b>{AUTHOR} <br> {AUTHOR_PHONE}</b> <br> {CITY}, {STR_STREET_SOKR_TITLE} {STREET} {HOUSE} {FLAT_NUMBER}</td>
    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;">
        <h6 class="font-weight-semibold"><b>{EXECUTOR} </b> </h6> {EXECUTOR_PHONE}
    </td>

    <td onclick="showinfo({ID}, 2)" style="cursor: pointer;">{WHY}</td>
    <td>
        {ACTION}
    </td>
</tr>