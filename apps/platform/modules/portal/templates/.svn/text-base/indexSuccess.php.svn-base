<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">

        <h1><?=__('portal.title.recentconversions')?></h1>
        <table class="table conversions">
            <tbody>
            <tr class="thead">
                <th><?=__('portal.conversion.name')?></th>
                <th><?=__('portal.conversion.concerns')?></th>
                <th><?=__('portal.conversion.price')?></th>
                <th><?=__('portal.conversion.date')?></th>
                <th class="last"><?=__('portal.conversion.actions')?></th>
            </tr>
            <?php if(sizeof($aContact)==0):?>
                <tr>
                    <td colspan="5">
                        <?=__('portal.notice.noconversionsavailable')?>
                    </td>
                </tr>
            <?php endif;?>
            <?php foreach($aContact as $oContact):?>
                <tr>
                    <td><?=$oContact->getName()?></td>

                    <?php if(null!==$oContact->getProperty()){ $oProperty = $oContact->getProperty();?>
                        <td>
                            <?=__('portal.conversation.property')?>: <?=$oProperty->getCountry()->getTitle()?>, <?=$oProperty->getRegion()?>, <?=$oProperty->getCity()?>, <?=$oProperty->getAddress1()?>
                        </td>
                        <td>
                            &euro; <?=format_currency_msh($oProperty->getPrice());?>
                        </td>
                    <?php }elseif(null!==$oContact->getDevelopment()){ $oDevelopment = $oContact->getDevelopment();?>
                        <td colspan="2">
                            <?=__('portal.conversation.development')?>: <?=$oDevelopment->getCountry()->getTitle()?>, <?=$oDevelopment->getRegion()?>, <?=$oDevelopment->getCity()?>, <?=$oDevelopment->getAddress1()?>
                        </td>
                    <?php }elseif(null!==$oContact->getAssociation()){?>
                        <td>
                            <?=__('portal.conversation.yourself')?>
                        </td>
                        <td>

                        </td>
                    <?php } ?>

                    <td><?=format_date($oContact->getCreatedAt())?></td>
                    <td>
                        <a class="actions show" href="<?=url_for('portal_conversions_show', array('id' => $oContact->getId()))?>" title="<?=__('portal.conversion.show')?>"><?=__('portal.conversion.show')?></a>
                        <a class="actions delete" href="<?=url_for('portal_conversions_delete', array('id' => $oContact->getId(), 'goto' => 'overview'))?>" id="a_delete_conversion_<?=$oContact->getId()?>" title="<?=__('portal.conversion.delete')?>"><?=__('portal.conversion.delete')?></a>
                        <script type="text/javascript">
                            setConfirm('a_delete_conversion_<?=$oContact->getId()?>', '<?=__('portal.conversion.confirm.delete')?>');
                        </script>                        
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <a class="button float_right orange raquo" href="<?=url_for('portal_conversions')?>" title="<?=__('portal.showallconversions')?>"><?=__('portal.showallconversions')?></a>
    </div>
</section>

<section class="content white">
    <div class="wrapper">
        <p class="head head1"><?=__('portal.title.recentproperties')?></p>
        <ul class="block topRated big">
            <?php $i=0; foreach($aProperty as $oProperty):?>
                <?php include_partial('portal/propertyItemPhoto', array('left' => $i==0, 'oProperty' => $oProperty, 'bUpsell' => true)); ?>
            <?php $i++; endforeach;?>
        </ul>
        <sup>
            <a class="button dark gray raquo" href="<?=url_for('portal_properties')?>" title="<?=__('portal.showallproperties')?>">
                <?=__('portal.showallproperties')?>
            </a>
            <a class="button orange" href="<?=url_for('portal_properties_add')?>" title="<?=__('portal.addproperty')?>">
                <?=__('portal.addproperty')?>
            </a>
        </sup>
    </div>
</section>
<?php if($sf_user->hasCredential('ROLE_ASSOCIATION')): ?>
    <section class="content">
        <div class="wrapper">
            <p class="head head1"><?=__('portal.title.recentdevelopments')?></p>
            <ul class="block topRated big" id="developmentBlocks">
                <?php $i=0; foreach($aDevelopment as $oDevelopment):?>
                    <?php include_partial('portal/developmentItemPhoto', array('left' => $i==0, 'oDevelopment' => $oDevelopment)); ?>
                <?php $i++; endforeach;?>
            </ul>
            <sup>
                <a class="button dark gray raquo" href="<?=url_for('portal_developments')?>" title="<?=__('portal.showalldevelopments')?>">
                    <?=__('portal.showalldevelopments')?>
                </a>
                <?php if($bAllowAddDev):?>
                    <a class="button orange" href="<?=url_for('portal_developments_add')?>" title="<?=__('portal.adddevelopment')?>">
                        <?=__('portal.adddevelopment')?>
                    </a>
                <?php endif;?>
            </sup>
        </div>
    </section>
<?php endif; ?>