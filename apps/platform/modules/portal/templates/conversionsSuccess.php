<?php include_component('portal', 'header'); ?>

<section class="content" id="sectionLogin">
    <div class="wrapper">

        <h1><?=__('portal.conversions')?></h1>
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
                        <a class="actions delete" href="<?=url_for('portal_conversions_delete', array('id' => $oContact->getId(), 'goto' => 'conversions'))?>" id="a_delete_conversion_<?=$oContact->getId()?>" title="<?=__('portal.conversion.delete')?>"><?=__('portal.conversion.delete')?></a>
                        <script type="text/javascript">
                            setConfirm('a_delete_conversion_<?=$oContact->getId()?>', '<?=__('portal.conversion.confirm.delete')?>');
                        </script>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</section>