<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Оформить предварительный заказ</h3>
    </div>

        <form method='post' action="./handler.php">
            <div class="modal-body modal-height">

                <div class="mainform-line-item control-group">
                    <label for="user-goods" class="control-label">Желаемый товар</label>
                    <div>
                        <select id="user-goods"  name="user[goods]" strong="true">
                            <option value="package">Пчелопакеты</option>
                            <option value="family">Пчелосемьи</option>
                            <option value="beesquen">Пчеломатки</option>
                            <option value="honey">Мёд</option>
                        </select>
                    </div>
                </div>
                <div class="mainform-line-item control-group">
                    <label class="control-label" for="user-name"> Имя </label>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input  class="span5" type="text" placeholder="Пример: Иванов Иван Иванович" id="user-name" name="user[name]">
                    </div>
                </div>

                <div class="mainform-line-item control-group">
                    <label class="control-label" for="user-email"> Email</label>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-envelope"></i></span>
                        <input  class="span5" type="email" placeholder="Пример: ivanov@mail.ru" id="user-email" name="user[email]">
                    </div>
                </div>

                <div class="mainform-line-item control-group">
                    <label class="control-label" for="user-phone"> Контактный телефон</label>
                    <div class="input-prepend">
                        <span class="add-on"><i class=" icon-globe"></i></span>
                        <input  class="span5" type="text" placeholder="Пример: +375-29-987-48-78" id="user-phone" name="user[phone]">
                    </div>
                </div>

                <div class="mainform-line-item control-group">
                    <label class="control-label" for="user-msg"> Дополнительная информация</label>
                    <textarea rows="5"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
                <button class="btn btn-primary" >Отправить</button>
            </div>
        </form>
</div>
<script type="text/javascript">
    $("#myModal").modal('show')
</script>
<!-- End Modal-->
