<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">
        <h1><?=__('portal.title.editEmployee')?></h1>

        <form action="<?=url_for('portal_profile_edit_user', array('id' => $oUser->getId()))?>" class="account_form" id="form_employee" method="post" enctype="multipart/form-data">
        <?=$oForm['_csrf_token']->render()?>

            <?php foreach($aLang as $oLang): ?>
                <?php if(isset($oForm[$oLang->getCulture()]['id'])): ?>
                    <?= $oForm[$oLang->getCulture()]['id']->render()?>
                    <?= $oForm[$oLang->getCulture()]['culture']->render()?>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="column">

                <div>
                    <p class="head head2"><?=__('portal.text.employee')?></p>
                    <table class="form">
                        <tbody>
                        <tr>
                            <th>
                                <label for="employee_photo" title="<?=__('portal.text.employee.photo')?>"><?=__('portal.text.employee.photo')?></label>
                            </th>
                            <td class="imageContainer">
                                <?=$oForm['image_id']->render();?>
                                <?=$oForm['image_id']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_name" title="<?=__('portal.text.employee.firstname')?>"><?=__('portal.text.employee.firstname')?></label>
                            </th>
                            <td>
                                <?=$oForm['first_name']->render();?>
                                <?=$oForm['first_name']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_insert" title="<?=__('portal.text.employee.insert')?>"><?=__('portal.text.employee.insert')?></label>
                            </th>
                            <td>
                                <?=$oForm['insert']->render();?>
                                <?=$oForm['insert']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_name" title="<?=__('portal.text.employee.surname')?>"><?=__('portal.text.employee.surname')?></label>
                            </th>
                            <td>
                                <?=$oForm['surname']->render();?>
                                <?=$oForm['surname']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_function" title="<?=__('portal.text.employee.email')?>"><?=__('portal.text.employee.email')?></label>
                            </th>
                            <td>
                                <?=$oForm['email_address']->render();?>
                                <?=$oForm['email_address']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_function" title="<?=__('portal.text.employee.password')?>"><?=__('portal.text.employee.password')?></label>
                            </th>
                            <td>
                                <?=$oForm['password']->render();?>
                                <?=$oForm['password']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_function" title="<?=__('portal.text.employee.password_confirm')?>"><?=__('portal.text.employee.password_confirm')?></label>
                            </th>
                            <td>
                                <?=$oForm['password_confirm']->render();?>
                                <?=$oForm['password_confirm']->renderError();?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <p class="head head2"><?=__('portal.text.employee.function')?></p>
                    <table class="form">
                        <tbody>
                        <tr id="association_function_language_switch" style="display: none;">
                            <th>
                                <label for="association_function_language" title="<?=__('portal.form.language')?>"><?=__('portal.form.language')?></label>
                            </th>
                            <td>
                                <span class="dropdown"></span>
                                <select id="association_function_language" tabindex="30">
                                    <?php foreach($aLang as $oLang): ?>
                                        <option value="<?=$oLang->getCulture()?>"><?=format_language($oLang->getCulture())?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <?php foreach($aLang as $oLang): ?>
                            <tr class="language" id="association_function_language_<?=$oLang->getCulture()?>">
                                <td colspan="2">
                                    <?= $oForm[$oLang->getCulture()]['association_function']->render(array('class' => 'w385'))?>
                                    <?= $oForm[$oLang->getCulture()]['association_function']->renderError()?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>



            <div class="devider"></div>

            <div class="column" id="formFooter">
                <div>
                    <input class="float_left shadow" tabindex="63" type="submit" value="<?=__('portal.form.saveemployee')?>" />
                    <?php if($sf_user->getUser()->getId() !== $oUser->getId()):?>
                        <a class="a_icon_delete button float_right gray" href="<?=url_for('portal_profile_delete_user', array('id' => $oUser->getId()))?>" id="a_delete_employee" tabindex="65" title="<?=__('portal.form.deleteemployee')?>"><?=__('portal.form.deleteemployee')?></a>
                    <?php endif; ?>
                    <p><?=__('portal.form.15minutewarning')?></p>
                </div>
            </div>

        </form>

        <script src="./js/jquery.form2.js"></script>

        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

        <script type="text/javascript">
            setConfirm('a_delete_employee', '<?=__('portal.employee.confirm.delete')?>');
        </script>

        <script>

            //
            var object            = { id: 'association_function_language', fields: 'language' };
            var languageSelector  = new LanguageSelection(object);
            languageSelector.Init();


        </script>

    </div>
</section>