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
                <?=__('title.registerStep3')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
<?php endif; ?>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

            <div id="selling-steps">

                <?php if($sType == 'business'): ?>
                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 1))?>" title="<?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>">
                        <?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.yourdata')?>">
                        <?=__('portal.text.step')?>2: <?=__('portal.text.yourdata')?>
                    </a>

                    <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>">
                        <?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>">
                        <?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>
                    </a>
                <?php else: ?>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.step')?>1: <?=__('portal.text.yourdata')?>">
                        <?=__('portal.text.step')?>1: <?=__('portal.text.yourdata')?>
                    </a>

                    <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.termsandconditions')?>">
                        <?=__('portal.text.step')?>2: <?=__('portal.text.termsandconditions')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.submitandpay')?>">
                        <?=__('portal.text.step')?>3: <?=__('portal.text.submitandpay')?>
                    </a>
                <?php endif; ?>



            </div>

            <h1 class="mb-10px">
                <?=__('portal.text.step')?><?= ($sType=='private')? '2' : '3'?>: <?=__('portal.text.termsandconditions')?>
            </h1>
            <p class="mt-0px">
                <?=__('portal.description.termsandconditions')?>
            </p>
            <section class="article" id="termsAndConditions">
                <p>
                    <?=$oPageTerms->getContent(ESC_RAW); ?>
                </p>
                <div>
                    <input class="shadow" onclick="document.location='<?=url_for('portal_register', array('step' => 4, 'accept' => 1))?>'" title="<?=__('portal.text.accepttermsandconditions')?>" type="submit" value="<?=__('portal.text.accepttermsandconditions')?> &raquo;" />
                </div>
            </section>
        </div>
    </section>

