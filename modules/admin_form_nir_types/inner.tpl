<div class="col-xl-10 col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="/ru/expense_budget_osi/" id="cabinet-back" style="display: inline;"><i class="fa fa-arrow-left"></i></a>
            <h3 class="card-title">{STR_MONTHLY_EXPENSES}</h3>
            <div class="card-options">
                {ADD_BUTTON}
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive border-top userprof-tab">
                <table class="table table-bordered table-hover mb-0 text-nowrap">
                    <thead>
                        <tr>
                            <th>{STR_KN_NUMBER_TITLE}</th>
                            <th>{STR_SMETA_INNER_TITLE}</th>
                            <th>{STR_SMETA_INNER_DESCR_TITLE}</th>
                            <th>{STR_REQUEST_JOB_TITLE}</th>
                            <th>{STR_EXPENSE_AMOUNT}</th>
                            <th>{STR_ACTION_TITLE}</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                        {INNER_ITEMS}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3"></th>
                            <th>{STR_BUDGET_TG}</th>
                            <th colspan="2">{SUMM_BUDGET}</th>


                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>{STR_SPENT_TG}</th>
                            <th colspan="2">{SUMM_EXPENSE}</th>

                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>{STR_REMAINING_TG}</th>
                            <th colspan="2">{SUMM_BALANCE}</th>
                        </tr>

                    </tfoot>
                </table>
            </div>

        </div>

    </div>
</div>


<!-- Not accepted request osi -->
<div class="modal fade" id="add-expense" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">{STR_ADD_MONTHTY_CALCULATION}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{STR_CLOSE_TITLE}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" name="addExpense" enctype="multipart/form-data">
                <input type="hidden" value="1" name="addExpenseSend">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_INNER_TITLE}</label>
                        <input type="text" class="form-control" name="title" placeholder="{STR_PLZ_INTER_TEXT}" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_SMETA_INNER_DESCR_TITLE}</label>
                        <textarea rows="3" class="form-control" name="description" placeholder="{STR_ENTER_DESCRIPTION}" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="form-control-label">{STR_EXPENSE}</label>
                        <input type="text" class="form-control" name="expense" placeholder="{STR_ENTER_EXPENSE}" required>
                    </div>
                    <div class="form-group">
                        <label for="work_type" class="form-control-label">{STR_REQUEST_JOB_TITLE}</label>
                        <select id="work_type" name="work_type" class="form-control" required>
                            {WORK_LIST}
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-control-label">{STR_ADD_FILE}</label>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <input type="file" class="dropify" name="file1" data-height="180" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{STR_CLOSE_TITLE}</button>
                    <button type="submit" class="btn btn-primary">{STR_SMETA_ADD_RASHOD_TITLE}</button>
                </div>
            </form>
        </div>
    </div>
</div>