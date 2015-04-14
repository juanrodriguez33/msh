<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */
?>

<?php if(get_slot('bDisableBreadcrumb', false) !== true): ?>
    <section class="content" id="title">
        <div class="wrapper">
            <h1>
                <?=__('title.registerStep2')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
<?php endif; ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">

        <article class="contentBlock half">
            <p class="head head1"><?=__('portal.title.a2ndhomeaccount')?></p>
            <p>
                <?=__('portal.text.a2ndhomeaccount')?>
            </p>
        </article>

        <aside class="contentBlock half">
            <p class="head head1"><?=__('portal.text.createaccount')?></p>
            <form action="<?=url_for('portal_registration')?>" id="form_account" method="post" name="form_account" >
                <?=$form['_csrf_token']->render()?>
                <p>
                    <?=__('portal.text.alreadyhaveanaccount')?>
                    <strong><a class="blackUrl" href="<?php echo url_for('level1', array('level1' => Functions::slugify(__('url.login')))) ?>" title="<?=__('portal.text.continuehere')?>"><?=__('portal.text.continuehere')?></a></strong>
                </p>
                <table class="form">
                    <tbody>
                    <tr>
                        <th class="accountType">
                            <?=__('portal.title.accounttype')?>
                        </th>
                        <td class="accountType">
                            <?= $form['account_type']->render()?>
                            <?=$form['account_type']->renderError();?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?=$form['personal_surname']->renderLabel();?>
                        </th>
                        <td>
                            <?=$form['personal_surname']->render();?>
                            <?=$form['personal_surname']->renderError();?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <?=$form['personal_email']->renderLabel();?>
                        </th>
                        <td>
                            <?=$form['personal_email']->render();?>
                            <?=$form['personal_email']->renderError();?>
                        </td>
                    </tr>
                    <tr id="tr_account_company_name" style="display: none;">
                        <th>
                            <?=$form['company_name']->renderLabel();?>
                        </th>
                        <td>
                            <?=$form['company_name']->render();?>
                            <?=$form['company_name']->renderError();?>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="float_right" colspan="2">
                            <input class="float_right shadow" tabindex="6" type="submit" value="<?=__('portal.text.nextstep')?> &raquo;" />
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>

            <script type="text/javascript">

                $('#form_account input[type="radio"]').change(function(){

                    if($('#simple_register_account_type_business').is(':checked'))  $('#tr_account_company_name').slideDown('slow');
                    else                                            $('#tr_account_company_name').slideUp('slow');
                });
                $('#form_account input[type="radio"]').change();
            </script>

        </aside>

    </div>
</section>

<script>


</script>