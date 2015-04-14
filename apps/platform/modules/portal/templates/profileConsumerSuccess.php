<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">
        <h1><?=__('portal.title.editprofile')?></h1>

        <form action="<?=url_for('portal_profile_consumer')?>" class="account_form" id="form_employee" method="post" enctype="multipart/form-data">
        <?=$oForm['_csrf_token']->render()?>

            <div class="column">

                <div>
                    <p class="head head2"><?=__('portal.text.profile')?></p>
                    <table class="form">
                        <tbody>
                        <tr>
                            <th>
                                <label for="employee_photo" title="<?=__('portal.text.photo')?>"><?=__('portal.text.photo')?></label>
                            </th>
                            <td class="imageContainer">
                                <?=$oForm['image_id']->render();?>
                                <?=$oForm['image_id']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_name" title="<?=__('portal.text.firstname')?>"><?=__('portal.text.firstname')?></label>
                            </th>
                            <td>
                                <?=$oForm['first_name']->render();?>
                                <?=$oForm['first_name']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_name" title="<?=__('portal.text.surname')?>"><?=__('portal.text.surname')?></label>
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
                                <label for="employee_function" title="<?=__('portal.text.password')?>"><?=__('portal.text.password')?></label>
                            </th>
                            <td>
                                <?=$oForm['password']->render();?>
                                <?=$oForm['password']->renderError();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="employee_function" title="<?=__('portal.text.password_confirm')?>"><?=__('portal.text.password_confirm')?></label>
                            </th>
                            <td>
                                <?=$oForm['password_confirm']->render();?>
                                <?=$oForm['password_confirm']->renderError();?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>



            <div class="devider"></div>

            <div class="column" id="formFooter">
                <div>
                    <input class="float_left shadow" tabindex="63" type="submit" value="<?=__('portal.form.saveprofile')?>" />
                    <p><?=__('portal.form.15minutewarning')?></p>
                </div>
            </div>

        </form>

        <script src="./js/jquery.form2.js"></script>

        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


    </div>
</section>