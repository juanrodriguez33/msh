<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */
?>
    <section class="content" id="title">
        <div class="wrapper">
            <h1>
                <?=__('title.portal.buycredits')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

            <h1>
                <?=__('title.portal.buycredits')?>
            </h1>
            <p class="mt-0px">
                <?=__('portal.description.buycredits')?>
            </p>

            <section class="article" id="finalCheckAndPayment">
                
                <div class="full">
                        <p class="head head1">
                            <?=__('portal.description.choosenumberofcredits')?>
                        </p>

                        <form action="<?=url_for('portal_buycredits')?>" id="form_buy_credits" method="POST">
                            <ul class="" id="ulBuyCredits">
                                <?php foreach($aCreditsPackage as $oPackage):?>
                                    <li>
                                        <input id="input_credit_<?=$oPackage->getId()?>" name="buy_credits" value="<?=$oPackage->getId()?>" type="radio" />
                                        
                                        <label for="input_credit_<?=$oPackage->getId()?>">
                                            <span class="packageName" style="display: inline-block;">
                                                &emsp;<?=$oPackage?>:
                                            </span>
                                            <span class="credits">
                                                <?=$oPackage->getCredits()?> <?=__('text.portal.credits')?>
                                            </span>
                                            <span class="currency" style="display: none;">
                                                &euro;
                                            </span>
                                            <span class="price" style="display: none;">
                                                <?=format_currency_msh($oPackage->getPrice(), null, null, false)?>
                                            </span>
                                        </label>
                                    </li>
                                <?php endforeach?>
                            </ul>
    
                            <p>
                                <?=__('portal.text.paywith')?>:
                            </p>
                            <p class="paymentOptions">
                                <img alt="iDeal" src="./graphics/website/payment/ideal.png" title="iDeal">
                                <img alt="American Express" src="./graphics/website/payment/american_express.png" title="American Express">
                                <img alt="PayPal" src="./graphics/website/payment/paypal.png" title="PayPal">
                                <img alt="Visa" src="./graphics/website/payment/visa.png" title="Visa">
                                <img alt="MasterCard" src="./graphics/website/payment/mastercard.png" title="MasterCard">
                            </p>
                            <a class="button orange raquo" onclick="$('#form_buy_credits').submit();" tabindex="6" title="<?=__('portal.text.payoff')?>"><?=__('portal.text.payoff')?></a>
                        </form>
                    </div>
                
            </section>
        </div>
    </section>
