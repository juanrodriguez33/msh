<?php include_component('portal', 'header'); ?>

<section class="content white">
    <div class="wrapper">
        <h1>
            <?=__('portal.title.recentonlineproperties')?>
            <a class="button orange" href="<?=url_for('portal_properties_add')?>" title="<?=__('portal.addproperty')?>">
                <?=__('portal.addproperty')?>
            </a>
        </h1>
        <?php if(sizeof($aProperty)==0):?><p><?=__('portal.notice.noonlineproperties')?></p><?php endif;?>
        <ul class="block topRated big">
            <?php $i=0; foreach($aProperty as $oProperty):?>
                <?php include_partial('portal/propertyItemPhoto', array('left' => $i%4==0, 'oProperty' => $oProperty, 'bUpsell' => true)); ?>
            <?php $i++; endforeach;?>
        </ul>
    </div>

    <div class="wrapperDevider"></div>

    <div class="wrapper">
        <p class="head head1"><?=__('portal.notice.recentofflineproperties')?></p>
        <?php if(sizeof($aPropertyOffline)==0):?><p><?=__('portal.notice.noofflineproperties')?></p><?php endif;?>
        <ul class="block inactive topRated big">
            <?php $i=0; foreach($aPropertyOffline as $oProperty):?>
                <?php include_partial('portal/propertyItemPhoto', array('left' => $i%4==0, 'oProperty' => $oProperty)); ?>
            <?php $i++; endforeach;?>
        </ul>
    </div>
</section>