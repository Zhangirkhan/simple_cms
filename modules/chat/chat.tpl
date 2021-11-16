<!-- Chat Plugin css-->
<link href="../assets/plugins/chat/jquery.convform.css" rel="stylesheet" />
<!-- Chat js -->
<script src="../assets/plugins/chat/jquery.convform.js"></script>
<script src="../assets/plugins/chat/autosize.min.js"></script>



<div class="col-xl-10 col-lg-12 col-md-12">
    <div class="card chat-room user-content-right">
        <div class="card-header">
            <h3 class="card-title">{STR_CHAT}</h3>
            <div class="card-options">
                <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#chat-addchat" href="#"><i class="fa fa-plus"></i>{STR_ADD_CHAT}</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row px-lg-2 px-2">
                <div class="col-md-4 col-xl-4 px-0">
                    <div class="friends-wrapper white z-depth-1 px-2 pt-3 pb-0 scrollbar-light">
                        <ul class="list-unstyled friend-list">
                            {ROW_USERS}
                            {NO_CHATS}
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-xl-8 pl-md-3 px-lg-auto px-0">
                    <div id="messagesContainer">
                        <div class="vertical-align">
                            <div class="p-0">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="no-border">
                                            <div id="chat" class="conv-form-wrapper">
                                                <div class="wrapper-messages">
                                                    <div class="spinLoader hidden"></div>
                                                    <div id="messages">
                                                        {ROWS_MESSAGES}
                                                    </div>
                                                </div>
                                                <form id="sendMessageForm" method="POST" name="sendMessageForm" class="convFormDynamic" enctype="multipart/form-data" style="overflow-x:hidden;padding-top:17px">
                                                    <div class="options dragscroll">
                                                    </div>
                                                    <div class="recipient-wrapper">
                                                        <input type="text" id="recipient" name="recipient" value="{RECIPIENT_FOR_MESSAGE}" class="d-none">
                                                    </div>
                                                    <textarea id="newMessageInput" name="newMessageInput" rows="1" placeholder="{STR_ENTER_HERE}" class="userInputDynamic" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 33px;"></textarea>
                                                    <button id="sendMessage" type="submit" class="submit">▶</button><span class="clear"></span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="chat-addchat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">{STR_ADD_NOTICE_TITLE}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" name="frmAdd" enctype="multipart/form-data">
                        <input type="hidden" value="1" name="send" />
                        <div class="custom-controls-stacked">
                            <label for="gettype" class="form-control-label">{STR_NOTICE_FOR}:</label>
                            <select id="gettype" name="gettype" class="form-control" placeholder="{STR_SELECT_TYPE_TITLE}" required>
                                <option value="">{STR_NOT_CHOOSEN}</option>
                                {UC_TEXT}
                                {OSI_TEXT}
                                {CITIZENS_TEXT}
                                {WORKERS_TEXT}
                                {MANAGER_TEXT}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="getusers" class="form-control-label">{STR_START_ENTER}:</label>
                            <div id="getusersWrapper">
                                <select class="form-control custom-select" id="getusers" name="getusers" data-placeholder="{STR_NOT_CHOOSEN_M}" required>
                                    {ROW_SEARCH}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-control-label">{STR_MESSAGE_TITLE}:</label>
                            <input id="message" type="text" class="form-control" placeholder="" name="message" required>
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
</div>
<div class="new-messages-summ-wrapper"><input id="newMessagesSumm" class="d-none" value="{NOT_READED_SUMM}"></div>
<style>
    .cursor-ponter {
        cursor: pointer;
    }

    .getchat a {
        color: #343a40;
    }

    .getchat:hover .text-small {
        color: #00a5a7;
    }

    .active-light {
        color: #00a5a7;
    }

    .wrapper-messages {
        background-color: #ffffff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cg fill='%2300a5a7' fill-opacity='0.05'%3E%3Cpolygon fill-rule='evenodd' points='8 4 12 6 8 8 6 12 4 8 0 6 4 4 6 0 8 4'/%3E%3C/g%3E%3C/svg%3E");
    }

    #messages {
        overflow: initial !important;
    }

    div.conv-form-wrapper div.message {
        animation: none !important;
    }

    div.conv-form-wrapper div.message.ready {
        animation: none !important;
    }
</style>
<div class="script-wrapper">
    <script id="pageScripts">
        // События при загрузке страницы
        $(document).ready(function() {
            setInterval(getMessages, 3000);
            url = "{PAGE_LINK}";
            setInterval(function getInfo() {
                $(".friends-wrapper").load(url + " .friend-list");
                $(".script-wrapper").load(url + " #pageScripts");
                $(".new-messages-summ-wrapper").load(url + " #newMessagesSumm");
                var notReadedSumm = $("#newMessagesSumm").val();
                if (notReadedSumm === "0") {
                    document.title = "Чат Ehome";
                } else if (notReadedSumm === "1") {
                    if (document.title === notReadedSumm + " новое сообщение") {
                        document.title = "Чат Ehome";
                    } else {
                        document.title = notReadedSumm + " новое сообщение";
                    }
                } else if (notReadedSumm === "2") {
                    if (document.title === notReadedSumm + " новых сообщения") {
                        document.title = "Чат Ehome";
                    } else {
                        document.title = notReadedSumm + " новых сообщения";
                    }
                } else {
                    if (document.title === notReadedSumm + " новых сообщении") {
                        document.title = "Чат Ehome";
                    } else {
                        document.title = notReadedSumm + " новых сообщении";
                    }
                }
            }, 3000);
        });
        $(".wrapper-messages").ready(function() {
            $(this).scrollTop(99999)
        });

        // Спрятать форму отправки сообщения, если ни один чат не выбран
        $('#sendMessageForm').hide();

        // Получить список пользователей
        $('#gettype').on('change', function() {
            url = "{PAGE_LINK}"+$(this).val();
            $("#getusersWrapper").load(url + " #getusers");
        });

        // Получить список сообщении из чата
        $('.getchat').on('click', function(e) {
            e.preventDefault();
            url = $(this).attr("value")
            $(".friends-wrapper").load(url + " .friend-list");
            $(".recipient-wrapper").load(url + " #recipient");
            $(".wrapper-messages").load(url + " #messages");
            $('#sendMessageForm').show();
            setTimeout(function(){ $('.wrapper-messages').scrollTop(99999); }, 500);
        })

        // Отправить сообщение
        $('#sendMessage').click(function(e) {
            e.preventDefault();
            if ($("#newMessageInput").val().length === 0) {
                alert("Введите сообщение")
            } else {
                e.preventDefault();
                url = "{PAGE_LINK}"+"messagesend/"+$("#recipient").val()
                recipient = $("#recipient").val()
                newMessage = $("#newMessageInput").val()
                $.post(url, {
                    recipient: recipient,
                    newMessageInput: newMessage
                })
                $(".recipient-wrapper").load(url + " #recipient");
                $(".wrapper-messages").load(url + " #messages");
                $(".wrapper-messages").scrollTop("#messages");
                $('#sendMessageForm').show();
                $("#newMessageInput").val("");
                setTimeout(function(){ $('.wrapper-messages').scrollTop(99999); }, 300)
            }
        });

        // Обновлять список сообщении каждые 5 сек
        function getMessages() {
            $(".recipient-wrapper").load(url + " #recipient");
            $(".wrapper-messages").load(url + " #messages");
            $(".script-wrapper").load(url + " #pageScripts");
            $(".wrapper-messages").prepend("<div class='spinLoader hidden'></div>");
            $('#sendMessageForm').show();
        }

        // Сообщение "Чат существует"
        {CHAT_EXISTS}
    </script>
</div>