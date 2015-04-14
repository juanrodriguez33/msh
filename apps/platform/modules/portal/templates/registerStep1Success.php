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
                <?=__('title.registerStep1')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
<?php endif; ?>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

            <div id="selling-steps">
                <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 1))?>" title="<?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>">
                    <?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>
                </a>

                <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.yourdata')?>">
                    <?=__('portal.text.step')?>2: <?=__('portal.text.yourdata')?>
                </a>

                <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>">
                    <?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>
                </a>

                <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>">
                    <?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>
                </a>

            </div>

            <h1>
                <?=__('portal.text.step')?>1: <?=__('portal.text.choosepackage')?>
            </h1>
            <p class="mt-0px">
                <?=__('portal.description.choosepackage')?>
            </p>

            <p class="head head1">
                <?=__('portal.text.ourpackages')?>
            </p>

            <form action="<?=url_for('portal_register', array('step' => 2))?>" id="form_newaccount" method="POST">
            <input type="hidden" value="<?=$iPackage?>" name="package" id="package">

            <ul class="block packets">
                <?php foreach($aPackage as $oPackage): ?>
                    <li <?=$oPackage->getId()!==intval($iPackage) && ($oPackage->getPreferred() && !$iPackage) || $oPackage->getId()==$iPackage ? 'class="big"' : '' ?>>
                        <?if($oPackage->getId()==$iPackage): ?>
                            <span class="selected"><?=__('portal.package.selected');?></span>
                        <?php endif; ?>
                        <p class="head head2"><?=$oPackage?></p>
                        <p>
                            <strong>&euro; <?=format_currency_msh($oPackage->getPrice(), null, null, false)?> / <?=__('portal.text.month');?></strong>
                        </p>
                        <ul class="li-gt">
                            <li>
                                <span>
                                    <?=$oPackage->getPlacements() ?> <?=__('portal.text.placements')?> <?=__('text.or')?><br />
                                    <?=$oPackage->getDevelopments() ?> <?=($oPackage->getDevelopments()==1?__('portal.text.development'):__('portal.text.developments'));?>
                                </span>
                            </li>
                            <li>
                                <span>
                                    <?=__('portal.package.companyprofile')?>
                                </span>
                            </li>
                            <li>
                                <span>
                                    <?=__('portal.package.statistics')?>
                                </span>
                            </li>

                        </ul>
                            <span>
                                <a class="button orange raquo" href="Javascript:selectPackage('<?=$oPackage->getId()?>')" title="<?=__('portal.text.select')?>"><?=__('portal.text.select')?></a>
                            </span>
                    </li>
                <?php endforeach; ?>
            </ul>

                <div class="full">
                    <?=__('portal.text.contractperiod')?>
                    <input <?=$iPackagePeriod == 6 ? 'checked' : ''?> id="_contract_period_6" type="radio" value="6" name="contract_period" required=""/>
                    <label for="_contract_period_6">6 <?=__('text.months')?></label>
                    <input <?=$iPackagePeriod == 12 ? 'checked' : ''?> id="_contract_period_12" type="radio" value="12" name="contract_period" required=""/>
                    <label for="_contract_period_12">12 <?=__('text.months')?></label>
                    <input <?=$iPackagePeriod == 24 ? 'checked' : ''?> id="_contract_period_24" type="radio" value="24" name="contract_period" required=""/>
                    <label for="_contract_period_24">24 <?=__('text.months')?></label>
                </div>
                
                <div class="full">
                    <p><?=__('portal.text.priceexvat');?>
                </div>

            </form>

            <script type="text/javascript">
                function selectPackage(value) {
                    $('#package').val(''+value);
                    $('.packets li').removeClass('big');
                    $('#form_newaccount').submit();

                }
            </script>
            
            <aside class="mt-20px" id="paymentOptionsBlock">
                <p class="head head1">
                    <?=__('portal.text.paywith')?>
                </p>
                <p class="paymentOptions">
                    <img alt="iDeal" src="./graphics/website/payment/ideal.png" title="iDeal">
                    <img alt="American Express" src="./graphics/website/payment/american_express.png" title="American Express">
                    <img alt="PayPal" src="./graphics/website/payment/paypal.png" title="PayPal">
                    <img alt="Visa" src="./graphics/website/payment/visa.png" title="Visa">
                    <img alt="MasterCard" src="./graphics/website/payment/mastercard.png" title="MasterCard">
                </p>
            </aside>
        </div>
    </section>