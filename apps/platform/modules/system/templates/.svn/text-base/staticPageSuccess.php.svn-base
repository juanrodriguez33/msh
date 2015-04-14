<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */
?>
<section class="content">
    <div class="wrapper">
        
    <?php if(false===stripos($oStaticPage->getMetaTitle(),'contact')):?>
        <h1><?=$oStaticPage?></h1>
        <?=$oStaticPage->getContent(ESC_RAW);?>
    <?php else: ?>
        <section class="article" id="homeDetailContact">
            <form id="staticContactRequestForm" method="POST">
                <?=$oForm['_csrf_token']->render()?>
                <p class="head head2"><?=__('text.staticcontactform')?></p>

                <?php if($oForm->isBound() && $oForm->isValid()): ?>
                    <p>
                        <?=__('text.thanksforcontactingus')?>
                    </p>
                <?php else: ?>

                    <p>
                        <?=__('text.staticcontactusdescription')?>
                    </p>
                    <table class="form">
                        <tbody>
                        <tr>
                            <th>
                                <label class="ellipsis" for="contact_name"><?=__('form.name')?></label>
                            </th>
                            <td>
                                <?= $oForm['name']->render(array('tabindex' => 1))?><?= $oForm['name']->renderError()?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label class="ellipsis" for="contact_email_address"><?=__('form.email')?></label>
                            </th>
                            <td>
                                <?= $oForm['email_address']->render(array('tabindex' => 2))?><?= $oForm['email_address']->renderError()?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label class="ellipsis" for="contact_phonenumber"><?=__('form.phone')?></label>
                            </th>
                            <td>
                                <?= $oForm['phone_number']->render(array('tabindex' => 3))?><?= $oForm['phone_number']->renderError()?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label class="ellipsis" for="contact_message"><?=__('form.contactmessage')?></label>
                            </th>
                            <td>
                                <?= $oForm['content']->render(array('tabindex' => 4))?><?= $oForm['content']->renderError()?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="contact_request_captcha"><?=__('form.captcha')?></label>
                            </th>
                            <td>
                                <?php echo $oForm['captcha']->render(); ?>
                                <?php if($oForm['captcha']->hasError()) echo $oForm['captcha']->renderError() ?>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <td class="lh-30px">
                                <input class="button float_right orange raquo" tabindex="5" type="submit" value="<?=__('form.contactsend')?> &raquo;">
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                <?php endif;?>
            </form>
            
            <?php #if(false!==stripos($oStaticPage->getMetaTitle(),'contact')):?>
            <div id="contactAsideDiv">
                <h1><?=$oStaticPage?></h1>
                <?=$oStaticPage->getContent(ESC_RAW);?>
            </div>
            <?php #endif; ?>
        </section>
    <?php endif;?>
    
    </div>
</section>