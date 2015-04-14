<?php include_component('portal', 'header'); ?>

<section class="content" id="">
    <div class="wrapper">

        <h1><?=__('portal.conversiondetail')?></h1>
        <a class="button gray laquo mt-10px" href="<?=url_for('portal_conversions')?>" title="<?=__('portal.backtooverview')?>"><?=__('portal.backtooverview')?></a>

        <div class="devider"></div>

        <section class="large" id="conversionDetail">

            <table class="table">
                <tbody>
                <tr>
                    <th><?=__('portal.conversion.name')?></th>
                    <td><?=$oContact->getName()?></td>
                </tr>
                <tr>
                    <th><?=__('portal.conversion.email')?></th>
                    <td>
                        <strong>
                            <a href="mailto:<?=$oContact->getEmailAddress()?>" title="<?=$oContact->getEmailAddress()?>">
                                <?=$oContact->getEmailAddress()?>
                            </a>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <th><?=__('portal.conversion.phone')?></th>
                    <td><?=$oContact->getPhoneNumber()?></td>
                </tr>
                <tr>
                <th><?=__('portal.conversion.message')?></th>
                <td>
                    <p>
                        <?=$oContact->getContent()?>
                    </p>
                </td>
                </tbody>
            </table>
        </section>
        <aside class="small" id="conversionDetailAside">
            <ul class="block topRated big">
                <?php if(null!==$oContact->getProperty()): $oProperty = $oContact->getProperty();?>
                    <li left="true">
                        <a href="<?=MSHTools::getCountryPropertyUrl($oProperty)?>" title="<?=$oProperty?>" target="_blank">
                            <img alt="<?=$oProperty->getCountry()?>" height="165" width="220" src="<?=$oProperty->getFirstImageUrl(220,165)?>" pagespeed_no_transform />
                            <p class="head head4">
                                <?=$oProperty->getCountry()->getTitle()?>
                            </p>
                            <p class="details">
                                <?=$oProperty->getCity()?>, <?=$oProperty->getRegion()?><br />
                                <?php if(intval($oProperty->getSurface()) > 1):?><?=$oProperty->getSurface()?> m<sup>2</sup><?php endif;?><?php if(intval($oProperty->getSurface()) > 1 && intval($oProperty->getRooms()) > 0):?>, <?php endif;?><?php if(intval($oProperty->getRooms()) > 0):?><?=$oProperty->getRooms()?> <?=__('text.rooms')?><?php endif;?>&nbsp;
                            </p>
                            <p class="price">&euro; <?=format_currency_msh($oProperty->getPrice())?></p>
                            <p class="light">
                                <?=__('portal.addedon')?>: <?= format_date($oProperty->getCreatedAt())?>
                            </p>
                        </a>
                    </li>
                <?php elseif(null!==$oContact->getDevelopment()): $oDevelopment = $oContact->getDevelopment();?>
                    <?php
                    /** @var Development $oDevelopment */
                    $aInfo = $oDevelopment->getDevelopmentInfo();
                    ?>
                    <li left="true">
                        <a href="<?=MSHTools::getCountryDevelopmentUrl($oDevelopment)?>" title="<?=$oDevelopment?>" target="_blank">
                            <img alt="<?=$oDevelopment?>" height="165" width="220" src="<?=$oDevelopment->getFirstImageUrl(220,165)?>" pagespeed_no_transform />
                            <p class="head head4"><?=$oDevelopment?></p>
                            <p class="head head5"><?=$oDevelopment->getCountry()->getTitle()?></p>
                            <p>
                                <?=$oDevelopment->getCity()?>, <?=$oDevelopment->getRegion()?><br>
                                <?=$aInfo['count']?> <?=__('text.properties')?>
                            </p>
                            <?php if(!isset($aInfo['min_price'])):?>
                                <p><?=__('text.developmenthasnopropertiesyet')?></p>
                            <?php else: ?>
                                <p class="price from-to"><span><?=__('text.pricefrom')?>:</span> &euro; <?=format_currency_msh($aInfo['min_price'])?></p>
                                <p class="price from-to"><span><?=__('text.priceto')?>:</span> &euro; <?=format_currency_msh($aInfo['max_price'])?></p>
                            <?php endif; ?>
                            <p class="light">
                                <?=__('portal.addedon')?>: <?= format_date($oDevelopment->getCreatedAt())?>
                            </p>
                        </a>
                    </li>
                <?php endif;?>
            </ul>
        </aside>

    </div>
</section>