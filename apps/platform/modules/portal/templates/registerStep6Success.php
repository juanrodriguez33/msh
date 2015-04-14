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
                <?=__('title.register.paymentupdate')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
<?php endif; ?>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

            <h1 class="mb-10px">
                <?=__('portal.register.paymentupdate')?>
            </h1>
            <p class="mt-0px">
                <?php if($oTransaction->getState() == Transaction::STATE_PAID) {?>
                    <?=__('portal.register.paymentsuccessinfo')?>
                    <br />
                    <a class="button orange mt-20px raquo" href="<?=url_for('level1', array('level1' => Functions::slugify(__('url.login'))))?>" title="<?=__('menu.sign-in')?>">
                        <?=__('menu.sign-in')?>
                    </a>
                <?php } else if($oTransaction->getState() == Transaction::STATE_PROCESSING) {?>
                    <?=__('portal.register.paymentinprocessinfo')?>
                    <br />
                    <a class="button orange mt-20px" id="aTryAgain" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.account.retryPayment');?>"><?=__('portal.account.retryPayment');?></a>
                <?php } else if($oTransaction->getState() == Transaction::STATE_ERROR) {?>
                    <?=__('portal.register.paymenterrorinfo')?>
                    <br />
                    <a class="button orange mt-20px" id="aTryAgain" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.account.retryPayment');?>"><?=__('portal.account.retryPayment');?></a>
                <?php } else if($oTransaction->getState() == Transaction::STATE_CANCELLED) {?>
                    <?=__('portal.register.paymentcancelledinfo')?>
                    <br />
                    <a class="button orange mt-20px" id="aTryAgain" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.account.retryPayment');?>"><?=__('portal.account.retryPayment');?></a>
                <?php } ?>
            </p>
        </div>
    </section>