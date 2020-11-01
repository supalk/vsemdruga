<div class="ui mini coupled modal mod_confirm-block">
    <i class="close icon"></i>
    <form class="ui form" style="padding: 12px;" onsubmit="return false;" enctype="multipart/form-data" method="post">
        <div style="padding: 10px 5px" class="ui content">
            <div class="field field_message">
            </div>
            <div style="display: none" class="wide required field field_reason">
                <label>Укажите причину:</label>
                <textarea rows="3" required name="reason"></textarea>
            </div>
            <div style="display: none" class="inline fields field_reason_file">
                <div class="field">
                    <label>Прикрепить файл</label>
                    <input type="file" name="reason_file">
                </div>
            </div>

        </div>
        <div class="ui error message"></div>
        <br>
        <div style="height: 40px" class="actions">
            <div class="ui left floated basic blue button btn_confirm">Подтверждаю</div>
            <div class="ui right floated basic button cancel">Отмена</div>
            <br><br><br>
        </div>
    </form>
</div>