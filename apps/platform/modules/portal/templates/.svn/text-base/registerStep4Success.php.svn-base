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
                <?=__('title.registerStep4')?>
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

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>">
                        <?=__('portal.text.step')?>3: <?=__('portal.text.termsandconditions')?>
                    </a>

                    <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>">
                        <?=__('portal.text.step')?>4: <?=__('portal.text.submitandpay')?>
                    </a>
                <?php else: ?>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.step')?>1: <?=__('portal.text.yourdata')?>">
                        <?=__('portal.text.step')?>1: <?=__('portal.text.yourdata')?>
                    </a>

                    <a class="button noTransition proceed" href="<?=url_for('portal_register', array('step' => 3))?>" title="<?=__('portal.text.step')?>2: <?=__('portal.text.termsandconditions')?>">
                        <?=__('portal.text.step')?>2: <?=__('portal.text.termsandconditions')?>
                    </a>

                    <a class="active button noTransition proceed" href="<?=url_for('portal_register', array('step' => 4))?>" title="<?=__('portal.text.step')?>3: <?=__('portal.text.submitandpay')?>">
                        <?=__('portal.text.step')?>3: <?=__('portal.text.submitandpay')?>
                    </a>
                <?php endif; ?>



            </div>

            <h1 class="mb-10px">
                <?=__('portal.text.step')?><?= ($sType=='private')? '3' : '4'?>: <?=__('portal.text.submitandpay')?>
            </h1>
            <p class="mt-0px">
                <?=__('portal.description.submitandpay')?>
            </p>
            <section class="article" id="finalCheckAndPayment">
                <p class="head head1"><?=__('portal.text.checkyourdata')?></p>
                <?php if($sType == 'business'): ?>
                <div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.company_name')?>
                            </th>
                            <td>
                                <?=$aValues['company_name'];?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.email')?>
                            </th>
                            <td>
                                <?=$aValues['email'];?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.phone')?>
                            </th>
                            <td>
                                <?=$aValues['phone'];?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.address1')?>
                            </th>
                            <td>
                                <?=$aValues['address1'];?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.address2')?>
                            </th>
                            <td>
                                <?=$aValues['address2'];?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.city')?>
                            </th>
                            <td>
                                <?= null!==$oCity ? $oCity->getTitle() : $aValues['city_new']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.region')?>
                            </th>
                            <td>
                                <?= null!==$oRegion ? $oRegion->getTitle() : $aValues['region_new']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.country')?>
                            </th>
                            <td>
                                <?= CountryPeer::retrieveByPK($aValues['country_id'])->getTitle()?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
                <div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.personal_surname')?>
                            </th>
                            <td>
                                <?=$aValues['personal_surname'];?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.personal_firstname')?>
                            </th>
                            <td>
                                <?=$aValues['personal_firstname'];?>
                            </td>
                        </tr>
                        <?php if($sType == 'business'): ?>
                            <tr>
                                <th>
                                    <?=__('portal.formlabel.personal_function')?>
                                </th>
                                <td>
                                    <?=$aValues['personal_function'];?>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th>
                                <?=__('portal.formlabel.personal_email')?>
                            </th>
                            <td>
                                <?=$aValues['personal_email'];?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <a class="button gray raquo" href="<?=url_for('portal_register', array('step' => 2))?>" title="<?=__('portal.text.alteryourdata')?>"><?=__('portal.text.alteryourdata')?></a>
                </div>

                <div class="full">
                    <p class="head head1">
                        <?=__('portal.text.payoff')?>
                    </p>
                    <p>
                        <?=__('portal.description.payoff')?>
                    </p>
                    <p>
                        <?php if($sType == 'business'): ?>
                            <strong><?=__('portal.text.package')?>: <?=$oPackage?> &euro; <?=format_currency_msh($oPackage->getPrice(), null, null, false)?> / <?=__('portal.text.month');?></strong>
                        <?php else: ?>
                            <strong><?=__('portal.text.price')?>: <?=__('portal.text.priceperproperty')?> &euro; <?=format_number_msh(9.95, null, null, false)?> / <?=__('portal.text.month');?></strong>
                        <?php endif;?>
                    </p>
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
                    <a class="button orange raquo" href="<?=url_for('portal_register', array('step' => 5))?>" title="<?=__('portal.text.payoff')?>"><?=__('portal.text.payoff')?></a>
                </div>
            </section>
        </div>
    </section>