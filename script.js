
var insta_count = 0;
var insta_mob_count = 0;
var selected = 0;
var input_val = 4;
function setDefaultPage(a) {
    if (
        navigator.appVersion.indexOf("MSIE 5.") != -1 ||
        navigator.appVersion.indexOf("MSIE 6.") != -1
    ) {
        a.style.behavior = "url(#default#homepage)";
        a.setHomePage(location.protocol + "//www." + location.host);
    } else {
        location.href = "";
    }
}
function showPhoto(url, width, height, title) {
    var top, left;
    top = Math.floor((screen.height - height) / 2 - 14);
    left = Math.floor((screen.width - width) / 2);
    imgparam =
        "left=" +
        left +
        ",top=" +
        top +
        ",height=" +
        height +
        ",width=" +
        width +
        ",location=0,scrollbars=no,toolbar=no,directories=no,menubar=no,status=no,resizable=no";
    wnd = window.open("", "", imgparam);
    wnd.document.writeln("<html><head><title>" + title + "</title>");
    wnd.document.writeln(
        "<script language='JavaScript'> function myClose() { window.close(); } </script>"
    );
    wnd.document.writeln(
        "</head><body bgcolor='#F1F2F4' leftmargin='0' topmargin='0' rightmargin='0' bottommargin='0' marginheight='0' marginwidth='0'>"
    );
    wnd.document.write(
        "<table width=100% height=100% cellpadding=0 cellspacing=0 border=0><tr><td align=center valign=middle>"
    );
    wnd.document.write("<a href='javascript: myClose();'><img src='");
    wnd.document.write(url);
    wnd.document.writeln(
        "' border='0' alt='Close' onLoad='window.resizeTo(this.width+10, this.height+35)'></a></td></tr></table>"
    );
    wnd.document.writeln("</body></HTML>");
}
function showFlash(url, width, height, title, fullscreen) {
    var top, left;
    top = Math.floor((screen.height - height) / 2 - 14);
    left = Math.floor((screen.width - width) / 2);
    if (fullscreen == true)
        imgparam =
            "left=0,top=0,height=" +
            screen.availHeight +
            ",width=" +
            screen.availWidth +
            ",location=0,scrollbars=yes,toolbar=no,directories=no,menubar=no,status=no,resizable=yes";
    else
        imgparam =
            "left=" +
            left +
            ",top=" +
            top +
            ",height=" +
            height +
            ",width=" +
            width +
            ",location=0,scrollbars=no,toolbar=no,directories=no,menubar=no,status=no,resizable=no";
    wnd = window.open("", "", imgparam);
    wnd.document.writeln("<html><head><title>" + title + "</title>");
    wnd.document.writeln(
        "<script language='JavaScript'> function myClose() { window.close(); } </script>"
    );
    wnd.document.writeln(
        "</head><body bgcolor='#F1F2F4' leftmargin='0' topmargin='0' rightmargin='0' bottommargin='0' marginheight='0' marginwidth='0'>"
    );
    wnd.document.write(
        "<table width=100% height=100% cellpadding=0 cellspacing=0 border=0><tr><td align=center valign=middle>"
    );
    wnd.document.write(
        '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="' +
        width +
        '" height="' +
        height +
        '">'
    );
    wnd.document.write("<param name=bgcolor VALUE=#FFFFFF>");
    wnd.document.write('<param name="movie" value="' + url + '">');
    wnd.document.write('<param name="quality" value="high">');
    wnd.document.write(
        '<embed src="' +
        url +
        '" quality="high" BGCOLOR=#FFFFFF pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="' +
        width +
        '" height="' +
        height +
        '"></embed>'
    );
    wnd.document.write("</object>");
    wnd.document.writeln("</td></tr></table>");
    wnd.document.writeln("</body></HTML>");
}
function checkFields(user_form, msg, color) {
    if (!color || color == "") color = "#FFF9DF";
    for (var i = 0; i < user_form.length; i++) {
        if (user_form[i].type == "text") user_form[i].style.background = "#FFFFFF";
    }
    for (var i = 0; i < user_form.length; i++) {
        if (
            user_form[i].type == "text" ||
            user_form[i].type == "textarea" ||
            user_form[i].type == "password"
        ) {
            if (
                (user_form[i].required == 1 || user_form[i].required == "yes") &&
                user_form[i].value == ""
            ) {
                if (msg != "") alert(msg);
                user_form[i].style.background = color;
                user_form[i].focus();
                return false;
            }
        }
    }
    return true;
}
function validateCheckboxes(user_form, msg) {
    for (var i = 0; i < user_form.length; i++) {
        if (user_form[i].type == "checkbox") {
            if (user_form[i].checked == 1) return true;
        }
    }
    if (msg != "") alert(msg);
    return false;
}
function validateField(field, error_message) {
    if (field.value == "") {
        if (error_message != "") alert(error_message);
        field.focus();
        return false;
    }
    return true;
}
function validateEmail(field, msg) {
    if (field.value != "") {
        var reg_exp = /^[a-z_\-\][\w\.]*@[\w\.-]+\.[a-z]{2,3}/i;
        if (!reg_exp.test(field.value)) {
            if (msg) alert(msg);
            field.focus();
            return false;
        }
    }
    return true;
}
function onlyDigits() {
    with (window.event) {
        if (shiftKey) return false;
        if (
            (keyCode >= 48 && keyCode <= 57) ||
            (keyCode >= 96 && keyCode <= 105) ||
            keyCode == 9 ||
            keyCode == 116 ||
            keyCode == 8 ||
            keyCode == 13 ||
            keyCode == 39 ||
            keyCode == 37 ||
            keyCode == 190 ||
            keyCode == 191 ||
            keyCode == 46
        )
            return true;
        else return false;
    }
}
function openDiv(layerID) {
    if (document.getElementById(layerID).style.display == "none") {
        document.getElementById(layerID).style.display = "";
        console.log("open div work open");
    } else {
        document.getElementById(layerID).style.display = "none";
        console.log("open div work close");
    }
    return false;
}
function showDoc(filePath, width, height, title) {
    var top, left;
    top = Math.floor(screen.height - height - height / 2);
    left = Math.floor((screen.width - width) / 2);
    $fileType = filePath.substr(filePath.length - 3, 3);
    $fileType = $fileType.toLowerCase();
    if (!title) title = "";
    switch ($fileType) {
        case "swf":
            showFlash(filePath, width, height, title, true);
            break;
        case "gif":
            showPhoto(filePath, width, height, title);
            break;
        case "jpg":
            showPhoto(filePath, width, height, title);
            break;
        default:
            wparam =
                "left=" +
                left +
                ",top=" +
                top +
                ",height=" +
                height +
                ",width=" +
                width +
                ",location=0,scrollbars=yes,toolbar=no,directories=no,menubar=no,status=yes,resizable=yes";
            window.open(filePath, "", wparam);
            break;
    }
}
function validateRadio(user_form) {
    for (var i = 0; i < user_form.length; i++) {
        if (user_form[i].type == "radio") {
            if (user_form[i].checked == true) return true;
        }
    }
    return false;
}
function textCounter(field, counter, name) {
    var charcnt = field.value.length;
    document.getElementById(counter).innerHTML = name + ": " + charcnt;
}
function changeHouseOsiStatus(id, status) {
    if (confirm("Вы действительно хотите сменить статус?")) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            id: id,
            status: status,
            action: 1,
        },
            onChangeHouseOsiStatus
        );
    }
}
function onChangeHouseOsiStatus(data) {
    //Код для того чтобы оставать на нужном табе
    if (window.history.pushState) {
        window.history.pushState('', '/', window.location.pathname)
    } else {
        window.location.hash = '';
    }

    window.location = window.location.href + "#tab" + data; // вот та самая дата и подставляем в url чтобы после перезагрузки страницы понимать где мы были
    window.location.reload();
    $('body,html').animate({ scrollTop: 0 }, 0);   // поднимает онко браузера вверх сразу а то у нас элемент якоря расположен ниже
}
//Старая функция
// function changeStreet() {
//     jQuery.post(
//         "ajax.php", {
//         type: "html-request",
//         value: $("#street").val(),
//         action: 2,
//     },
//         onChangeStreet
//     );
// }
// function onChangeStreet(data) {
//     document.getElementById("house_number").innerHTML = data;
// }


function onlineVscroll() {
    // ______________mCustomScrollbar
    $(".vscroll").mCustomScrollbar();
    $(".app-sidebar").mCustomScrollbar({
        theme: "minimal",
        autoHideScrollbar: true,
        scrollbarPosition: "outside"
    });
}
function onlineSelect2() {
    // Select2 by showing the search
    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        language: "ru",
        placeholder: "Поиск",
        width: '100%', // need to override the changed default
    });
}

function onlineFlatpickr() {
    $(".flatpickr").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y",
        locale: "ru",
        allowInput: true,
    });
}

function onlineFlatpickrRange() {
    $(".flatpickrRange").flatpickr({
        enableTime: false,
        mode: "range",
        dateFormat: "d-m-Y",
        locale: "ru",
        allowInput: true,
    });
}

function deleteFlatCitizen(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 3,
    },
        ondeleteFlatCitizen
    );
}
function ondeleteFlatCitizen(data) {
    window.location.reload();
}
function ChangeOsiAndUcStatus(id, status, new_entry) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        status: status,
        action: 4,
        new_entry: new_entry,
    },
        onChangeOsiAndUcStatus
    );
}
function onChangeOsiAndUcStatus(data) {

    //Код для того чтобы оставать на нужном табе
    if (window.history.pushState) {
        window.history.pushState('', '/', window.location.pathname)
    } else {
        window.location.hash = '';
    }

    window.location = window.location.href + "#tab" + data; // вот та самая дата и подставляем в url чтобы после перезагрузки страницы понимать где мы были
    window.location.reload();
    $('body,html').animate({ scrollTop: 0 }, 0);   // поднимает онко браузера вверх сразу а то у нас элемент якоря расположен ниже

}
function citizenOsiStatus(id, status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        status: status,
        action: 5,
    },
        onCitizenOsiStatus
    );
}
function onCitizenOsiStatus(data) {
    window.location.reload();
}
function changeCityUc() {
    var sityID = document.getElementById("citySelect").value;
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: sityID,
        action: 6,
    },
        onChangeCityUc
    );
}
function onChangeCityUc(data) {
    document.getElementById("namesUC").innerHTML = data;
}
function deleteUcOsi(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 7,
    },
        onDeleteUcOsi
    );
}
function onDeleteUcOsi(data) {

    //Код для того чтобы оставать на нужном табе
    if (window.history.pushState) {
        window.history.pushState('', '/', window.location.pathname)
    } else {
        window.location.hash = '';
    }

    window.location = window.location.href + "#tab" + data; // вот та самая дата и подставляем в url чтобы после перезагрузки страницы понимать где мы были
    window.location.reload();
    $('body,html').animate({ scrollTop: 0 }, 0);   // поднимает онко браузера вверх сразу а то у нас элемент якоря расположен ниже

}
function ChangeRequest(id, status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        id: status,
        action: 8,
    },
        OnChangeRequest
    );
}
function OnChangeRequest(data) {
    window.location.reload();
}
function deleteRequest(id, who, who_type) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        who: who,
        who_type: who_type,
        action: 9,
    },
        OnDeleteRequest
    );
}
function OnDeleteRequest(data) {
    window.location.reload();
}
function changeAccepted(id, status, name, who, who_type) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        status: status,
        name: name,
        who: who,
        who_type: who_type,
        action: 10,
    },
        OnchangeAccepted
    );
}
function OnchangeAccepted(data) {
    window.location.reload();
}
function changeRequestStatus(id, status, name, accept) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        status: status,
        name: name,
        accept: accept,
        action: 11,
    },
        OnChangeRequestStatus
    );
}
function OnChangeRequestStatus(data) {
    window.location.reload();
}
function recycleRequest(id, name) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        name: name,
        action: 12,
    },
        OnКecycleRequest
    );
}
function OnКecycleRequest(data) {
    window.location.reload();
}
function requestHistory(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 13,
    },
        OnRequestHistory
    );
}
function OnRequestHistory(data) {
    $("#history").remove();
    var out =
        `<div class="modal fade" id="history" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 2000 !important ;">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="example-Modal3">История заявок</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body vscroll" style="max-height:400px; overflow:auto;"">
<table class="table table-bordered text-nowrap">
<thead>
<tr>
<th>Время заявки</th>
<th>Действие</th>
<th>Автор</th>
<th>Тип автора</th>
</tr>
</thead>
<tbody>
` +
        data +
        `
</tbody>
</table>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>`;
    $('#card-body').append(out);
    $("#history").modal();
}
function checkQuestions(index) {
    var checkRadio = jQuery('input[name="answer' + index + '"]:checked').val();
    if (checkRadio != undefined) {
        $(".tab" + (index + 1)).addClass("active");
        $("#tab" + (index + 1)).addClass("active");
        $(".tab" + index).removeClass("active");
        $("#tab" + index).removeClass("active");
        $(".tab" + (index + 1)).focus();
    } else {
        alert("Выберите ответ для вопроса номер " + index);
    }
}
function FinishPoll(index) {
    var checkRadio = jQuery('input[name="answer' + index + '"]:checked').val();
    if (checkRadio != undefined) {
        frmPoll.submit();
    } else {
        alert("Выберите ответ для вопроса номер " + index);
    }
}
function OnКecycleRequest(data) {
    window.location.reload();
}
function selectAllFlatsForPoll() {
    $('.flat-check').prop('checked', true);
}
function unSelectAllFlatsForPoll() {
    $('.flat-check').prop('checked', false);
}
function selectFlatforPoll(id) {
    var checkCheckbox = jQuery('input[name="polledFlats[]"]:checked').val();
    if (checkCheckbox != undefined) {
    } else {
        alert("Выберите один или несколько квартир чтобы голосовать");
    }
}
function pollDeactivate(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 14,
    },
        onPollDeactivate
    );
}
function onPollDeactivate(data) {
    window.location.reload();
}
function pollActivate(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 15,
    },
        onPollActivate
    );
}
function onPollActivate(data) {
    window.location.reload();
}
function changeActiveWorkerUC(id, worker_type, activeStatus) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        worker_type: worker_type,
        activeStatus: activeStatus,
        action: 16, //найди в ajax.php функцию php
    },
        onChangeActiveWorkerUC
    );
}
function onChangeActiveWorkerUC(data) {

    //Код для того чтобы оставать на нужном табе
    if (window.history.pushState) {
        window.history.pushState('', '/', window.location.pathname)
    } else {
        window.location.hash = '';
    }

    window.location = window.location.href + "#tab" + data; // вот та самая дата и подставляем в url чтобы после перезагрузки страницы понимать где мы были
    window.location.reload();
    $('body,html').animate({ scrollTop: 0 }, 0);   // поднимает онко браузера вверх сразу а то у нас элемент якоря расположен ниже

};

function sendNewPassword(email, worker_type) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        email: email,
        worker_type: worker_type,
        action: 17,
    },
        onSendNewPassword
    );
}
function onSendNewPassword(data) {
    window.location.reload();
}
function deleteSmetaInner(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 18,
    },
        onDeleteSmetaInner
    );
}
function onDeleteSmetaInner(data) {
    window.location.reload();
}
function deleteSmeta(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 19,
    },
        onDeleteSmeta
    );
}
function onDeleteSmeta(data) {
    window.location.reload();
}
function editSmeta(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 20,
    },
        onEditSmeta
    );
}
function onEditSmeta(data) {
    var obj = JSON.parse(data);
    document.getElementById("edit_smeta_id").value = obj.id;
    document.getElementById("edit_house").selectedIndex = obj.house_id;
    document.getElementById("edit_quantity").value = obj.quantity;
    document.getElementById("edit_type").selectedIndex = obj.type_id;
    document.getElementById("edit_description").value = obj.description;
}
function radioCheckedNotice(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 21,
    },
        OnRadioCheckedNotice
    );
}
function OnRadioCheckedNotice(data) {
    document.getElementById("notice_houses").innerHTML = data;
}
function sendSms() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        phone: document.getElementById('phoneMask').value,
        type_user: document.getElementById('type_user').value,
        forgot: document.getElementById('forgot_id').value,
        action: 22,
    },
        onSendSms
    );
}
function onSendSms(data) {
    $('#cardbody').append(data);
}
function readedStatus(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 23,
    },
        OnreadedStatus
    );
    $("#notice-" + id).css("background-color", "white");
    $("#notice-" + id).removeClass("unreaded");
    $("#notice-" + id).addClass("readed");
}
function OnreadedStatus(data) {
    $("#openinfonotice").remove();
    $('#notices').append(data);
    $("#openinfonotice").modal({
        zIndex: 1010
    }).show();
}
function deleteArticle(id) {
    if (confirm("Вы действительно хотите удалить запись?")) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            id: id,
            action: 24,
        },
            onDeleteArticle
        );
    }
}
function onDeleteArticle(data) {
    window.location.reload();
}
function deleteImage(id) {
    $.confirm({
        animation: 'zoom',
        closeAnimation: 'scale',
        title: 'Удаление',
        theme: 'modern',
        content: 'Вы действительно хотите удалить фотографию?',
        buttons: {
            confirm: {
                text: 'Удалить',
                btnClass: 'btn-red',
                keys: ['enter', 'shift'],
                action: function () {
                    jQuery.post(
                        "ajax.php", {
                        type: "html-request",
                        id: id,
                        action: 25,
                    },
                        onDeleteImage
                    );
                }
            },
            cancel: {
                text: 'Отмена',
                btnClass: 'btn-gray',
                keys: ['enter', 'shift'],
                action: function () {
                    window.location.reload();
                }
            }
        }
    });
}
function onDeleteImage(data) {

    //Код для того чтобы оставать на нужном табе
    if (window.history.pushState) {
        window.history.pushState('', '/', window.location.pathname)
    } else {
        window.location.hash = '';
    }

    window.location = window.location.href + "#tab" + data; // вот та самая дата и подставляем в url чтобы после перезагрузки страницы понимать где мы были
    window.location.reload();
    $('body,html').animate({ scrollTop: 0 }, 0);   // поднимает онко браузера вверх сразу а то у нас элемент якоря расположен ниже

}
function deleteGallery(id) {
    if (confirm("Вы действительно хотите удалить фотогаллерею?")) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            id: id,
            action: 26,
        },
            onDeleteGallery
        );
    }
}
function onDeleteGallery(data) {
}
function setGalleryId(id, title) {
    document.getElementById('gallery_id').value = id;
    document.getElementById('gallery_title').value = title;
}
function deleteDoc(id) {
    if (confirm("Вы действительно хотите удалить документ?")) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            id: id,
            action: 27,
        },
            onDeleteDoc
        );
    }
}
function onDeleteDoc(data) {
    window.location.reload();
}
function showinfo(id, tab) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        tab: tab,
        action: 28,
    },
        onShowinfo
    );
}
function onShowinfo(data) {
    $("#openinfo").remove();
    $('#requests').append(data);
    $("#openinfo").modal({
        zIndex: 1010
    }).show();
}
function showinfoNotice(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 28,
    },
        onShowinfo
    );
}
function onShowinfoNotice(data) {
    $("#openinfo").remove();
    $('#requests').append(data);
    $("#openinfo").modal({
        zIndex: 1010
    }).show();
}
function getCities() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        action: 29,
    },
        onGetCities
    );
}
function onGetCities(data) {
    document.getElementById("all-cities").innerHTML = data;
}
function getStreets() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#all-cities").val(),
        action: 30,
    },
        onGetStreets
    );
}
function onGetStreets(data) {
    document.getElementById("all-street-in-cities").innerHTML = data;
}
function getHouses() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#all-street-in-cities").val(),
        action: 31,
    },
        onGetHouses
    );
}
function onGetHouses(data) {
    document.getElementById("all-house-in-streets").innerHTML = data;
}
function goOsi(lang) {
    var idOSi = $("#all-house-in-streets").val();
    window.location.href = lang + "/profile_osi_portal/" + idOSi;
}
function resetPolled(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 32,
    },
        onResetPolled
    );
}
function onResetPolled(data) {
    window.location.reload();
}
function deleteBudget(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 33,
    },
        onDeleteBudget
    );
}
function onDeleteBudget(data) {
    window.location.reload();
}
function deleteExpense(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 34,
    },
        ondeleteExpense
    );
}
function ondeleteExpense(data) {
    window.location.reload();
}
function my_citizen_osi_deactivate(items, status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        items: items,
        action: 35,
        status: status,
    },
        on_my_citizen_osi_deactivate
    );
}
function on_my_citizen_osi_deactivate(data) {
    window.location.reload();
}
function my_houses_osi_deactivate(items, status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        items: items,
        action: 36,
        status: status,
    },
        on_my_houses_osi_deactivate
    );
}
function on_my_houses_osi_deactivate(data) {
    window.location.reload();
}
function my_uc_osi_deactivate(items, status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        items: items,
        action: 37,
        status: status,
    },
        on_my_uc_osi_deactivate
    );
}
function on_my_uc_osi_deactivate(data) {
    window.location.reload();
}
function my_uc_osi_delete(items) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        items: items,
        action: 38,
    },
        on_my_uc_osi_delete
    );
}
function on_my_uc_osi_delete(data) {

    //Код для того чтобы оставать на нужном табе
    if (window.history.pushState) {
        window.history.pushState('', '/', window.location.pathname)
    } else {
        window.location.hash = '';
    }

    window.location = window.location.href + "#tab" + data; // вот та самая дата и подставляем в url чтобы после перезагрузки страницы понимать где мы были
    window.location.reload();
    $('body,html').animate({ scrollTop: 0 }, 0);   // поднимает онко браузера вверх сразу а то у нас элемент якоря расположен ниже
}
function my_osi_uk_deactivate(items, status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        items: items,
        action: 39,
        status: status,
    },
        on_my_osi_uk_deactivate
    );
}
function on_my_osi_uk_deactivate(data) {
    window.location.reload();
}
function deleteInvoice(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 40,
    },
        ondeleteInvoice
    );
}
function ondeleteInvoice(data) {
    window.location.reload();
}
function sendHouseCitizens(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 41,
    },
        onsendHouseCitizens
    );
}
function onsendHouseCitizens(data) {
    window.location.reload();
}
function deleteRequestForSpec(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 42,
    },
        ondeleteRequestForSpec
    );
}
function ondeleteRequestForSpec(data) {
    window.location.reload();
}
function showinfoRequestSpec(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 43,
    },
        onshowinfoRequestSpec
    );
}
function onshowinfoRequestSpec(data) {
    $("#openinfo").remove();
    $('#requests').append(data);
    $("#openinfo").modal({
        zIndex: 1010
    }).show();
}
function showinfoResponseSpec(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 44,
    },
        onshowinfoResponseSpec
    );
}
function onshowinfoResponseSpec(data) {
    $("#openinfo").remove();
    $('#requests').append(data);
    $("#openinfo").modal({
        zIndex: 1010
    }).show();
}
function appointAsExecutor(id, spec_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        spec_id: spec_id,
        action: 45,
    },
        onappointAsExecutor
    );
}
function onappointAsExecutor(data) {
    window.location.reload();
}
function finishRequestSpec(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 46,
    },
        onfinishRequestSpec
    );
}
function onfinishRequestSpec(data) {
    window.location.reload();
}
function requestReviewSpec(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 47,
    },
        onrequestReviewSpec
    );
}
function onrequestReviewSpec(data) {
    $("#openinfo2").remove();
    $('#requests').append(data);
    $("#openinfo2").modal({
        zIndex: 1010
    }).show();
}
function endPoll(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 48,
    },
        onendPoll
    );
}
function onendPoll(data) {
    window.location.reload();
}
function changeCitizenStatus(id, statdata, house_id, citizen_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        statdata: statdata,
        house_id: house_id,
        citizen_id: citizen_id,
        action: 49,
    },
        onchangeCitizenStatus
    );
}
function onchangeCitizenStatus(data) {
    window.location.reload();
}
function sovetPoll(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 50,
    },
        onsovetPoll
    );
}
function onsovetPoll(data) {
    window.location.reload();
}
function endPollOSI(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 51,
    },
        onendPollOSI
    );
}
function onendPollOSI(data) {
    window.location.reload();
}
function forgot_password() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        pass: document.getElementById('code').value,
        action: 52,
        phone: document.getElementById('phoneMask').value,
        user_type: document.getElementById('type_user').value,
    },
        onforgot_password
    );
}
function onforgot_password(data) {
    if (data == "Вы ввели правильный код") {
        $('#cardbody').append(`<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<strong>`+ data + `</strong>
</div>`);
        $("#password").show();
    } else {
        $('#cardbody').append(`<div class="alert alert-danger">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<strong>`+ data + `</strong>
</div>`);
    }
}
function addflats() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        flats_count: document.getElementById('flats_count').value,
        action: 53,
    },
        onaddflats
    );
}
function onaddflats(data) {
    $('#flats').append(data);
}

//Квартиры изменение квадратуры
function updateKvadrat(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        kvadratura: document.getElementById('kvadratura_' + id).value,
        action: 54,
    },
        onupdateKvadrat
    );
}
function onupdateKvadrat(data) {
    //Уведомление как тост
    $.growl.notice({
        title: "Сохранен",
        message: "Данные успешно сохранены"
    });

}

//Квартиры изменение квадратуры
function deleteFlat(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,

        action: 55,
    },
        ondeleteFlat
    );
}
function ondeleteFlat(data) {
    //Уведомление как тост
    $.growl.error({
        title: "Удален",
        message: "Данные успешно удалены"
    });
    window.location.reload();
}


//Чистичная оплата
function addInvoicePayment(flat_id, rowid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        flat_id: flat_id,
        rowid: rowid,
        action: 56,
    },
        onaddInvoicePayment
    );
}
function onaddInvoicePayment(data) {
    //Уведомление как тост
    $("#openinfo").remove();
    $('#invoices').append(data);
    $("#openinfo").modal().show();
}

//Информация об оплатах
function infoInvoice(flat_id, rowid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        flat_id: flat_id,
        rowid: rowid,

        action: 57,
    },
        oninfoInvoice
    );
}
function oninfoInvoice(data) {
    //Уведомление как тост
    $("#openinfo2").remove();
    $('#invoices').append(data);
    $("#openinfo2").modal().show();
}
//Выбор города для квартир жителя
// function changeCityFlats () {
//     jQuery.post(
//         "ajax.php", {
//         type: "html-request",
//         value: $("#city_id").val(),
//         action: 58,
//     },
//         onchangeCityFlats
//     );
// }
// function onchangeCityFlats(data) {
//     document.getElementById("street").innerHTML = data;
// }

//Выбор номер дома в зависимости от дома и района
function changeHouses() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#city_id").val(),
        value2: $("#district_id").val(),
        value3: $("#street").val(),
        action: 58,
    },
        onchangeHouses
    );
}
function onchangeHouses(data) {
    document.getElementById("house_number").innerHTML = data;
}


//Выбор номер квартир списком
function changeflatsNumbers() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#house_number").val(),
        value1: $("#street").val(),
        value2: $("#city_id").val(),
        action: 59,
    },
        onchangeflatsNumbers
    );
}
function onchangeflatsNumbers(data) {
    document.getElementById("flat_number").innerHTML = data;
}

function homepageRequestForm() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        email: document.getElementById('homepageModalEmail').value,
        name: document.getElementById('homepageModalName').value,
        adress: document.getElementById('homepageModalAdress').value,
        action: 60,
    },
        onhomepageRequestForm
    );
}
function onhomepageRequestForm() {

}


//Выбор района в зависимости от города
function changeDistricts() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#city_id").val(),
        action: 61,
    },
        onchangeDistricts
    );
}
function onchangeDistricts(data) {
    document.getElementById("district_id").innerHTML = data;
}

//Выбор улицы в зависимости от района
function changeStreets() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#city_id").val(),
        value2: $("#district_id").val(),
        action: 62,
    },
        onchangeStreets
    );
}
function onchangeStreets(data) {
    document.getElementById("street").innerHTML = data;
}






// ПОДПИСАНИЕ ДОКУМЕНТОВ С ЭЦП

let base64 = '';

$("#polls_sign #ecpFile").change(async function (e) {
    let res = await getBase64(e.target.files[0]);
    let split = res.split(',');
    base64 = split[1];
});

function signByEcp(poll_id, user_id) {
    $("#polls_sign #signBtn").prop('disabled', true);
    $('#polls_sign .modal-body').hide();
    $('#polls_sign .loader-div').show();
    jQuery.post(
        "ajax.php",
        {
            type: "html-request",
            p12: base64,
            password: $("#polls_sign #password").val(),
            fileName: user_id + '_' + poll_id,
            poll_id: poll_id,
            action: 63,
        },
        function (data) {
            $("#polls_sign #signBtn").prop('disabled', false);
            $('#polls_sign .modal-body').show();
            $('#polls_sign .loader-div').hide();
            // console.log(data);
            // alert(data);
            window.location.reload();
        }
    ).fail(function (e) {
        $("#polls_sign #signBtn").prop('disabled', false);
        $('#polls_sign .modal-body').show();
        $('#polls_sign .loader-div').hide();
        console.error(e);
        alert("error");
    });
}

//ПОДПИСЬ СОВЕТНИКОВ ДОМА

$("#polls_sign_sovetnik #ecpFile").change(async function (e) {
    let res = await getBase64(e.target.files[0]);
    let split = res.split(',');
    base64 = split[1];
});

function signByEcpSovet(poll_id, user_id) {
    $("#polls_sign_sovetnik #signBtn").prop('disabled', true);
    $('#polls_sign_sovetnik .modal-body').hide();
    $('#polls_sign_sovetnik .loader-div').show();
    jQuery.post(
        "ajax.php",
        {
            type: "html-request",
            p12: base64,
            password: $("#polls_sign_sovetnik #password").val(),
            fileName: user_id + '_' + poll_id,
            poll_id: poll_id,
            action: 76,
        },
        function (data) {
            $("#polls_sign_sovetnik #signBtn").prop('disabled', false);
            $('#polls_sign_sovetnik .modal-body').show();
            $('#polls_sign_sovetnik .loader-div').hide();
            // console.log(data);
            // alert(data);
            window.location.reload();
        }
    ).fail(function (e) {
        $("#polls_sign_sovetnik #signBtn").prop('disabled', false);
        $('#polls_sign_sovetnik .modal-body').show();
        $('#polls_sign_sovetnik .loader-div').hide();
        console.error(e);
        alert("error");
    });
}

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

function deleteHouseOsi(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 64,
    },
        ondeleteHouseOsi
    );
}
function ondeleteHouseOsi(data) {
    window.location.reload();
}

//Чистичная оплата
function PayForInvoice(flat_id, rowid, dolg) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        flat_id: flat_id,
        rowid: rowid,
        dolg: dolg,
        action: 65,
    },
        onPayForInvoice
    );
}
function onPayForInvoice(data) {
    //Уведомление как тост
    $("#openinfo").remove();
    $('#invoices').append(data);
    $("#openinfo").modal().show();
}

function deleteFlatsCitizen(id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        action: 66,
    },
        ondeleteFlatsCitizen
    );
}
function ondeleteFlatsCitizen(data) {
    window.location.reload();
}

function getOSIPhoneNumber() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#house_number").val(),
        action: 67,
    },
        ongetOSIPhoneNumber
    );
}
function ongetOSIPhoneNumber(data) {
    document.getElementById("osi_number").innerHTML = data;
}
//Выбор всех квартир даже с жильцами рядом с кв.
function getFlatsInHouse() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#house_id").val(),
        action: 68,
    },
        ongetFlatsInHouse

    );
}
function ongetFlatsInHouse(data) {

    $("#predcedatel_sobrania").empty();
    document.getElementById("predcedatel_sobrania").innerHTML = data;


}

function getSecretar() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value2: $("#secretar").val(),
        value: $("#house_id").val(),
        action: 69,
    },
        ongetSecretar

    );
}
function ongetSecretar(data) {

    $("#secretar_sobrania").empty();
    document.getElementById("secretar_sobrania").innerHTML = data;

}

//******************************НАЧИНАЮТЬСЯ ГОЛОСОВАНИЯ НОВЫЕ ОТ ЖАНГИРХАНА НЕ ТРОГАТЬ */

function changePollStatus(id, status_number) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        id: id,
        status_number: status_number,
        action: 70,
    },
        onchangePollStatus

    );
}
function onchangePollStatus(data) {
    window.location.reload();
}

function createProtocol(pollid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        pollid: pollid,
        action: 71,
    },
        oncreateProtocol

    );
}
function oncreateProtocol(data) {
    window.location.reload();
}

function ApproveWithoutECP(pollid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        pollid: pollid,
        action: 72,
    },
        onApproveWithoutECP

    );
}
function onApproveWithoutECP(data) {
    window.location.reload();
}

//Закрытие голосования ОСИ (он же инициатор)
function ClosePoll(pollid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        pollid: pollid,
        action: 73,
    },
        onClosePoll

    );
}
function onClosePoll(data) {
    window.location.reload();
}

//Досрочное завершить голосование
function Dosrochno(pollid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        pollid: pollid,
        action: 74,
    },
        onDosrochno

    );
}
function onDosrochno(data) {
    window.location.reload();
}


//ДЕЙСТВИЯ СОВЕТНИКОВ
function Sovetnik(pollid) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        pollid: pollid,
        action: 75,
    },
        onSovetnik

    );
}
function onSovetnik(data) {
    window.location.reload();
}


/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////
/////////////////////////////
////////////////////////////

//Изменение факультета при выборе университета или колледжа
function changefacultets() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#univer_id").val(),
        action: 101,
    },
        onchangefacultets

    );
}
function onchangefacultets(data) {

    $("#facultet_id").empty();
    document.getElementById("facultet_id").innerHTML = data;

}

//Удаление формы админом
function deleteform(form_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            form_id: form_id,
            action: 102,
        },
            ondeleteform
        );
    }
}
function ondeleteform(data) {
    window.location.reload();
}

//Удаление формы админом
function changeFormStatus(form_id, form_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        form_id: form_id,
        form_status: form_status,
        action: 103,
    },
        onchangeFormStatus
    );
}
function onchangeFormStatus(data) {
    window.location.reload();
}



//Меняем статус пользователя
function changeUserStatus(user_id, user_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        user_id: user_id,
        user_status: user_status,
        action: 104,
    },
        onchangeUserStatus
    );
}
function onchangeUserStatus(data) {
    window.location.reload();
}



//Удаление пользователя
function deleteUser(user_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            user_id: user_id,
            action: 105,
        },
            ondeleteUser
        );
    }
}
function ondeleteUser(data) {
    window.location.reload();
}


//Вывод настроек пользователя
function openSettingUser(user_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        user_id: user_id,
        action: 106,
    },
        onopenSettingUser
    );
}
function onopenSettingUser(data) {

    $("#opendialog").remove();
    $('#users').append(data);
    $("#opendialog").modal().show();
}


//Вывод настроек пользователя
function changePassUser(user_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        user_id: user_id,
        action: 107,
    },
        onchangePassUser
    );
}
function onchangePassUser(data) {

    $("#opendialog").remove();
    $('#users').append(data);
    $("#opendialog").modal().show();
}


//Вывод настроек пользователя
function generateNewPass() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        action: 108,
    },
        ongenerateNewPass
    );
}
function ongenerateNewPass(data) {
    $("#newpassword").val("");
    $("#newpassword").val(data);
}


//Вывод настроек формы
function openSettings(form_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        form_id: form_id,
        action: 109,
    },
        onopenSettings
    );
}
function onopenSettings(data) {
    $("#update-setting-form").remove();
    $('#forms').append(data);
    $("#update-setting-form").modal().show();
    onlineVscroll();
    onlineSelect2();
}



//Удаление из формы группу
function deleteFormGroup(form_group_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            form_group_id: form_group_id,
            action: 110,
        },
            ondeleteFormGroup
        );
    }
}
function ondeleteFormGroup(data) {
    window.location.reload();
}


//ГЛАВНАЯ ФУНКЦИЯ ДЛЯ СОЗДАНИЯ ФОРМЫ
function createFormForTable(form_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        form_id: form_id,
        action: 111,
    },
        oncreateFormForTable
    );
}
function oncreateFormForTable(data) {
    //console.log(data);
    $("#add-form").remove();
    $('#add_record_in_form').append(data);
    $("#add-form").modal().show();


    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
	onlineVscroll();
}


//Удаление строки из таблицы как АДМИН
function deleteRecordFromTable(form_id, row_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            form_id: form_id,
            row_id: row_id,
            action: 112,
        },
            ondeleteRecordFromTable
        );
    }
}
function ondeleteRecordFromTable(data) {
    window.location.reload();
}


//Удаление категории форм
function deleteCategory(category_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            category_id: category_id,
            action: 113,
        },
            ondeleteCategory
        );
    }
}
function ondeleteCategory(data) {
    window.location.reload();
}


//Меняем статус пользователя
function changeCategoryStatus(category_id, category_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        category_id: category_id,
        category_status: category_status,
        action: 114,
    },
        onchangeCategoryStatus
    );
}
function onchangeCategoryStatus(data) {
    window.location.reload();
}


//Меняем статус факультета
function changeFacultetStatus(facultet_id, facultet_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        facultet_id: facultet_id,
        facultet_status: facultet_status,
        action: 115,
    },
        onchangeFacultetStatus
    );
}
function onchangeFacultetStatus(data) {
    window.location.reload();
}


//Удаление факультет
function deleteFacultet(facultet_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            facultet_id: facultet_id,
            action: 116,
        },
            ondeleteFacultet
        );
    }
}
function ondeleteFacultet(data) {
    window.location.reload();
}


//Удаление университета
function deleteUniver(univer_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            univer_id: univer_id,
            action: 117,
        },
            ondeleteUniver
        );
    }
}
function ondeleteUniver(data) {
    window.location.reload();
}


//Меняем статус универа
function changeUniverStatus(univer_id, univer_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        univer_id: univer_id,
        univer_status: univer_status,
        action: 118,
    },
        onchangeUniverStatus
    );
}
function onchangeUniverStatus(data) {
    window.location.reload();
}

function changeForms() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#category_form_id").val(),
        action: 119,
    },
        onchangeForms
    );
}
function onchangeForms(data) {
    $("#form_id").empty();
    document.getElementById("form_id").innerHTML = data;
}


//Меняем статус универа
function changeAccessStatus(access_id, access_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        access_id: access_id,
        access_status: access_status,
        action: 120,
    },
        onchangeAccessStatus
    );
}
function onchangeAccessStatus(data) {
    window.location.reload();
}


//Удаление настройки форм
function deleteAccess(access_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            access_id: access_id,
            action: 121,
        },
            ondeleteAccess
        );
    }
}
function ondeleteAccess(data) {
    window.location.reload();
}



//Удаление строки из таблицы как Преподаватель
function deleteRecordFromTablePPS(form_id, row_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            form_id: form_id,
            row_id: row_id,
            action: 122,
        },
            ondeleteRecordFromTablePPS
        );
    }
}
function ondeleteRecordFromTablePPS(data) {
    window.location.reload();
}



//РЕДАКТИРОВАТЬ СТРОКУ ЛЮБОЙ ФОРМЫ
function editRecordFromTablePPS(form_id, row_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        form_id: form_id,
        row_id: row_id,
        action: 123,
    },
        oneditRecordFromTablePPS
    );
}
function oneditRecordFromTablePPS(data) {
    $("#edit-form").remove();
    $('#add_record_in_form').append(data);
    $("#edit-form").modal().show();
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}

//РЕДАКТИРОВАТЬ категорию
function editCategory(row_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        row_id: row_id,
        action: 124,
    },
        oneditCategory
    );
}
function oneditCategory(data) {
    $("#edit-category").remove();
    $('#categories').append(data);
    $("#edit-category").modal().show();
}

//РЕДАКТИРОВАТЬ настройку форм
function editFormSettings(row_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        row_id: row_id,
        action: 125,
    },
        oneditFormSettings
    );
}
function oneditFormSettings(data) {
    $("#edit-form-settings").remove();
    $('#settings').append(data);
    $("#edit-form-settings").modal().show();
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}


//Меняем статус универа
function changeNIRStatus(nir_id, nir_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        nir_id: nir_id,
        nir_status: nir_status,
        action: 126,
    },
        onchangeNIRStatus
    );
}
function onchangeNIRStatus(data) {
    window.location.reload();
}


//Удаление настройки форм
function deleteNIR(nir_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            nir_id: nir_id,
            action: 127,
        },
            ondeleteNIR
        );
    }
}
function ondeleteNIR(data) {
    window.location.reload();
}


//Удаление настройки форм
function deleteNIRRecord(nir_record_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            nir_record_id: nir_record_id,
            action: 128,
        },
            ondeleteNIRRecord
        );
    }
}
function ondeleteNIRRecord(data) {
    window.location.reload();
}


//Отправляем данные пользователя и блокируем редактирование и удаление
function sendRecordPPS(form_id, row_id) {
    if (confirm('Вы точно хотите отправить данные?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            form_id: form_id,
            row_id: row_id,
            action: 129,
        },
            onsendRecordPPS
        );
    }
}
function onsendRecordPPS(data) {

    $.growl.notice({
        title: "Вы получили " + data + " баллов",
        message: "Через несколько секунд страница будет перезагружена",
        location: "br"
    });

    setTimeout(function () {
        window.location.reload();
    }, 5000);

}



//редактируем баллы
function editBallsSience(form_id, row_id) {

    jQuery.post(
        "ajax.php", {
        type: "html-request",
        form_id: form_id,
        row_id: row_id,
        action: 130,
    },
        oneditBallsSience
    );

}
function oneditBallsSience(data) {
    $("#editBallForm").remove();
    $('#add_record_in_form').append(data);
    $("#editBallForm").modal().show();
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}


//Ввод баллов и значений в селекты
function addSelectBalls(form_id) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        form_id: form_id,
        action: 131,
    },
        onaddSelectBalls
    );
}
function onaddSelectBalls(data) {
    $("#editSelects").remove();
    $('#forms').append(data);
    $("#editSelects").modal().show();
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}


//Удаление из формы группу
function deleteOption(option_id) {
    if (confirm('Вы точно хотите удалит?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            option_id: option_id,
            action: 132, //110
        },
            ondeleteOption
        );
    }
}
function ondeleteOption(data) {
    window.location.reload();
}


//Очистка таблиц
function clearDATA() {
    if (confirm('Вы точно хотите очистить всю базу?')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            action: 133, //110
        },
            onclearDATA
        );
    }
}

function onclearDATA(data) {

    if (data == 1) {
        $.growl.error({
            title: "ОШИБКА",
            message: "Увы у вас это не получилось",
            location: "br"
        });

    } else {
        $.growl.notice({
            title: "Успешно",
            message: "Вы очистили все таблицы. Теперь вы можете начать работу с чистого листа",
            location: "br"
        });

        setTimeout(function () {
            window.location.reload();
        }, 5000);
    }
}


//Удаление из формы группу
function bulkUpdateBalls(form_id) {
    if (confirm('Вы точно хотите удалить старые баллы и проставить новые? Предупреждение: когда вы обновите баллы вы удалите баллы которые были проставлены вручную')) {
        jQuery.post(
            "ajax.php", {
            type: "html-request",
            form_id: form_id,
            action: 134,
        },
            onbulkUpdateBalls
        );
    }
}
function onbulkUpdateBalls(data) {
    $.growl.notice({
            title: "Успешно",
            message: "Вы обновили все баллы в этой таблице",
            location: "br"
        });

        setTimeout(function () {
            window.location.reload();
        }, 5000);
}


//Транслитерация в name
function translit(column_id) {
    var str = $("#label_" + column_id).val();
    var space = '_';
    var link = '';
    var transl = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
        'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
        'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
        'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': space,
        'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya'
    }
    if (str != '')
        str = str.toLowerCase();

    for (var i = 0; i < str.length; i++) {
        if (/[а-яё]/.test(str.charAt(i))) { // заменяем символы на русском
            link += transl[str.charAt(i)];
        } else if (/[a-z0-9]/.test(str.charAt(i))) { // символы на анг. оставляем как есть
            link += str.charAt(i);
        } else {
            if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
        }
    }
    document.getElementById("name_" + column_id).value = link.substr(0, 64);
}

function translitUserName() {
    var str = $("#fio").val();
    var space = '_';
    var link = '';
    var transl = {
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
        'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
        'о': 'o', 'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
        'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': space,
        'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya'
    }
    if (str != '')
        str = str.toLowerCase();

    for (var i = 0; i < str.length; i++) {
        if (/[а-яё]/.test(str.charAt(i))) { // заменяем символы на русском
            link += transl[str.charAt(i)];
        } else if (/[a-z0-9]/.test(str.charAt(i))) { // символы на анг. оставляем как есть
            link += str.charAt(i);
        } else {
            if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
        }
    }
    document.getElementById("login").value = link.substr(0, 64);
}


/////////////////
//EXAMPLES
////////////////

function newDeleteId(table, id) {
    if (confirm('Вы точно хотите удалит?')) {
    jQuery.post(
            "ajax.php", {
            type: "html-request",
            table: table,
            id: id,
            action: "deleteID",
        },
            onnewDeleteId
        );

    }
}
function onnewDeleteId(data){

    if (data == 401) {
        $.growl.error({
            title: "ОШИБКА",
            message: "Увы у вас это не получилось",
            location: "br"
        });

    } else if (data == 200) {
        $.growl.notice({
            title: "Успешно",
            message: "Вы удалили запись. Сейчас страница обновиться",
            location: "br"
        });

        setTimeout(function () {
            window.location.reload();
        }, 5000);
    }
}


function newSHOWEditId(table, id) {
    jQuery.post(
            "ajax.php", {
            type: "html-request",
            table: table,
            id: id,
            action: "updateID",
        },
            onnewSHOWEditId
        );

}
function onnewSHOWEditId(data){

    $("#editForm").remove();
    $('#forms-place').append(data);
    $("#editForm").modal().show();
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}


function addNewData(table, id) {
    jQuery.post(
            "ajax.php", {
            type: "html-request",
            table: table,
            id: id,
            action: "AddID",
        },
            onaddNewData
        );

}
function onaddNewData(data){

    $("#addData").remove();
    $('#forms-place').append(data);
    $("#addData").modal().show();
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}

//Изменение факультета при выборе университета или колледжа
function changeINSTITUTE() {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        value: $("#univer_id").val(),
        action: "CHANGE_DEPARTMENT",
    },
        onchangefacultets

    );
}
function onchangefacultets(data) {

    $("#department_id").empty();
    document.getElementById("department_id").innerHTML = data;

}


function sendIndicators(table, id) {
    if (confirm('Вы точно хотите отправить индикаторы/показатели на проверку ?. После отправки их нельза будет редактировать')) {
    jQuery.post(
            "ajax.php", {
            type: "html-request",
            table: table,
            id: id,
            action: "sendIndicators",
        },
            onsendIndicators
        );

    }
}
function onsendIndicators(data){

    if (data == 401) {
        $.growl.error({
            title: "ОШИБКА",
            message: "Увы у вас это не получилось",
            location: "br"
        });

    } else if (data == 200) {
        $.growl.notice({
            title: "Успешно",
            message: "Вы удалили запись. Сейчас страница обновиться",
            location: "br"
        });

        setTimeout(function () {
            window.location.reload();
        }, 2000);
    }
}



function newAccessesUserTypeChange(src) {
    console.log(src.value);
    jQuery.post(
            "ajax.php", {
            type: "html-request",
            users_type: src.value,
            action: "AccessesUserTypeChange",
        },
            onnewAccessesUserTypeChange
        );

}
function onnewAccessesUserTypeChange(data){

    $("#user_type_select").empty();
    $('#user_type_select').append(data);
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}



function newAccessesIdicatorsTypeChange(src) {
    console.log(src.value);
    jQuery.post(
            "ajax.php", {
            type: "html-request",
            indicator_type: src.value,
            action: "AccessesIdicatorsTypeChange",
        },
            onnewAccessesIdicatorsTypeChange
        );

}
function onnewAccessesIdicatorsTypeChange(data){
    $("#indicators_type_select").empty();
    $('#indicators_type_select').append(data);
    onlineVscroll();
    onlineSelect2();
    onlineFlatpickr();
    onlineFlatpickrRange();
}



//Меняем статус пользователя
function newChangeUserStatus(user_id, user_status) {
    jQuery.post(
        "ajax.php", {
        type: "html-request",
        user_id: user_id,
        user_status: user_status,
        action: "ChangeUserStatus",
    },
        onnewChangeUserStatus
    );
}
function onnewChangeUserStatus(data) {
    window.location.reload();
}
