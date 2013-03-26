<?php ?>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Оформить предварительный заказ</h3>
    </div>
    <form method='post' action="">
        <div class="modal-body modal-height">
            <table>
                <tr>
                    <td class='span3'>
                        <div
                            class="mainform-line-item control-group <?php print(!empty($error['goods'])) ? 'error' : '' ?>">
                            <label for="user-goods" class="control-label">Желаемый товар</label>

                            <div>
                                <?php if (!empty($error['goods'])): ?>
                                    <select id="user-goods" name="user[goods]" strong="true" class="tooltip-error"  data-toggle="tooltip" data-placement="top" data-original-title="<?php print $error['goods'] ?>">
                                <?php else: ?>
                                    <select id="user-goods" name="user[goods]" strong="true">
                                <?php endif; ?>
                                        <option value="package">Пчелопакеты</option>
                                        <option value="family">Пчелосемьи</option>
                                        <option value="beesquen">Пчеломатки</option>
                                        <option value="honey">Мёд</option>
                                        <option value="perga">Перга</option>
                                        <option value="wax">Воск</option>
                                    </select>
                            </div>
                        </div>
                    </td>
                    <td class='span3'>
                        <div
                            class="mainform-line-item control-group <?php print(!empty($error['name'])) ? 'error' : '' ?>">
                            <label class="control-label" for="user-name"> Контактное лицо </label>

                                    <?php if (!empty($error['name'])): ?>
                                        <div class="input-prepend tooltip-error" data-toggle="tooltip" data-placement="top" data-original-title="<?php print $error['name'] ?>">
                                    <?php else: ?>
                                        <div class="input-prepend">
                                    <?php endif; ?>
                                    <span class="add-on"><i class="icon-user"></i></span>
                                    <input type="text" placeholder="Пример: Иванов Иван " id="user-name"
                                           name="user[name]" value="<?php echo $value['name']; ?>">
                                </div>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td class="span3">
                        <div
                            class="mainform-line-item control-group <?php print(!empty($error['email'])) ? 'error' : '' ?>">
                            <label class="control-label" for="user-email"> Электронный адресс</label>

                            <?php if (!empty($error['email'])): ?>
                            <div class="input-prepend tooltip-error" data-toggle="tooltip" data-placement="top" data-original-title="<?php print $error['email'] ?>">
                            <?php else: ?>
                                <div class="input-prepend">
                            <?php endif; ?>
                                    <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" placeholder="Пример: ivanov@mail.ru" id="user-email"
                                       name="user[email]" value="<?php echo $value['email']; ?>">
                            </div>
                        </div>
                    </td>
                    <td class="span3">
                        <div
                            class="mainform-line-item control-group <?php print(!empty($error['phone'])) ? 'error' : '' ?>">
                            <label class="control-label" for="user-phone"> Контактный телефон</label>

                                <?php if (!empty($error['phone'])): ?>
                                    <div class="input-prepend tooltip-error" data-toggle="tooltip" data-placement="top" data-original-title="<?php print $error['phone'] ?>">
                                <?php else: ?>
                                    <div class="input-prepend">
                                <?php endif; ?>
                                <span class="add-on"><i class=" icon-globe"></i></span>
                                <input type="text" placeholder="Пример: +375-29-987-48-78" id="user-phone"
                                       name="user[phone]" value="<?php echo $value['phone']; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="mainform-line-item control-group">
                            <?php if (!empty($error['msg'])): ?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?php print $error['msg'] ?>
                                </div>
                            <?php endif; ?>
                            <label class="control-label" for="user-msg"> Дополнительная информация</label>
                            <textarea rows="5" id="user-msg" name="user[msg]"><?php echo $value['msg']; ?></textarea>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
            <button class="btn btn-primary">Отправить</button>
        </div>
    </form>
</div>