<?php include_component('portal', 'header'); ?>


<section class="content" id="">
    <div class="wrapper">
        <h1>
            <?=__('portal.title.recentdevelopments')?>
            <?php if($bAllowAdd):?>
            <a class="button orange raquo" href="<?=url_for('portal_developments_add')?>" title="<?=__('portal.adddevelopment')?>">
                <?=__('portal.adddevelopment')?>
            </a>
            <?php endif; ?>
        </h1>
        <?php if(sizeof($aDevelopment)==0):?><p><?=__('portal.notice.nodevelopments')?></p><?php endif;?>
        <ul class="block topRated big" id="developmentBlocks">
            <?php $i=0; foreach($aDevelopment as $oDevelopment):?>
                <?php include_partial('portal/developmentItemPhoto', array('left' => $i==0, 'oDevelopment' => $oDevelopment)); ?>
                <?php $i++; endforeach;?>
        </ul>
    </div>
</section>