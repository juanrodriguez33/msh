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
                <?=__('login')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
    
    <?php endif; ?>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

        <article class="contentBlock half">
            <p class="head head1"><?=__('title.amysecondhomeaccount')?></p>
            <p>
                <?=__('text.describemysecondhomeaccount')?>
            </p>
            <?php /* <a class="button orange" id="aRegisterNow" href="<?=url_for('portal_registration')?>" title="<?=__('portal.account.create');?>"><?=__('portal.account.create');?></a> */?>
        </article>

        <aside class="contentBlock half">
            <p class="head head1"><?=__('login')?></p>

            <form id="form_sign_in" action="<?php echo url_for('level1', array('level1' => Functions::slugify(__('url.login')))) ?>" method="post" enctype="multipart/form-data">
                <?= $form['_csrf_token']->render()?>
                <table class="form">
                    <tbody>
                    <tr>
                        <th>
                            <label for="account_email_address"><?=__('formlabel.login.email')?></label>
                        </th>
                        <td>
                            <?php echo $form['user']->render() ?>
                            <?php echo $form['password']->renderError() ?>
                        </td>
                    </tr>
                    <tr id="tr_account_password">
                        <th>
                            <label for="account_company_name"><?=__('formlabel.login.password')?></label>
                        </th>
                        <td>
                            <?php echo $form['password']->render() ?>
                            <?php echo $form['password']->renderError() ?>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="float_right">
                            <input class="float_right shadow" tabindex="6" type="submit" value="<?=__('form.login')?> &raquo;" />
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </aside>
    </section>

    <?php if($form['user']->hasError()): ?>
      <script>
        initNotification('error', '<?php echo $form['user']->getError() ?>');
      </script>
    <?php elseif($form['password']->hasError()): ?>
      <script>
        initNotification('error', '<?php echo $form['password']->getError() ?>');
      </script>
    <?php endif; ?>