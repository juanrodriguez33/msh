<?php include_component('portal', 'header'); ?>

<section class="content" id="">
    <div class="wrapper">

        <h1><?=__('portal.text.upsellproperty')?></h1>
        <a class="button gray laquo mt-10px" href="<?=url_for('portal_properties')?>" title="<?=__('portal.backtooverview')?>"><?=__('portal.backtooverview')?></a>

        <div class="devider"></div>

        <section class="medium float_right" id="upsellNewsletter">
            <p class="head head1"><?=__('portal.text.upsellnewsletter')?></p>
            <p>
                <?=__('portal.description.upsellnewsletter')?>
            </p>
            <p><?=__('portal.text.upsellnewslettercosts')?>:<br /><strong><?=sfConfig::get('app_upsell_cost_newsletter')?> <?= sfConfig::get('app_upsell_cost_newsletter') == 1 ? __('portal.text.credit') : __('portal.text.credit2') ?></strong></p>
            <?php if($oProperty->hasNewsletterPlacement()): ?>
                <p>
                    <?=__('portal.text.alreadyplacedinnewsletter')?>
                </p>
            <?php else: ?>
                <a class="button orange" href="<?=url_for('portal_properties_upsell', array('id' => $oProperty->getId(), 'type' => 'newsletter'))?>" title="<?=__('portal.text.upsellnewsletter')?>">
                    <?=__('portal.button.upsellnewsletter')?>
                </a>
            <?php endif;?>
        </section>

        <section class="medium float_right" id="upsellTopRated">
            <p class="head head1"><?=__('portal.text.upselltoprated')?></p>
            <p>
                <?=__('portal.description.toprated')?>
            </p>
            <p><?=__('portal.text.upselltopratedcosts')?>:<br /><strong><?=sfConfig::get('app_upsell_cost_toprated')?> <?= sfConfig::get('app_upsell_cost_toprated') == 1 ? __('portal.text.credit') : __('portal.text.credit2') ?></strong></p>
            <a class="button orange" href="<?=url_for('portal_properties_upsell', array('id' => $oProperty->getId(), 'type' => 'toprated'))?>" title="<?=__('portal.text.upselltoprated')?>">
                <?=__('portal.button.upselltoprated')?>
            </a>
        </section>

        <aside class="small float_ritht" id="upsellAside">
            <ul class="block topRated big">
                <?php include_partial('portal/propertyItemPhoto', array('left' => $i==0, 'oProperty' => $oProperty, 'bNoLink' => true)); ?>
            </ul>
        </aside>

    </div>
</section>