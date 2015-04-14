<section class="content" id="title">
    <div class="wrapper">

        <?php
        if ($sf_user->hasCountry()) {
            include_component('property','searchBox'); 
        }
        ?>
 
        <div class="left-buttons">
            <?php if($sf_user->hasCountry()): ?>
            <p class="head head1" id="country">
                <?=$sf_user->getCountry()->getTitle()?>
            </p>
            <?php endif; ?>
    <?php /*        <p class="head head1">
                <span class="step"><?=__('step')?> <?=($sf_user->getPhase()+1)?></span>
                <?php if($sf_user->getPhase() == 0): ?>
                    <?=__('phase.orient')?>
                <?php elseif($sf_user->getPhase() == 1): ?>
                    <?=__('phase.inform')?>
                <?php elseif($sf_user->getPhase() == 2): ?>
                    <?=__('phase.advice')?>
                <?php elseif($sf_user->getPhase() == 3): ?>
                    <?=__('phase.find')?>
                <?php endif;?>
        </p>*/?>
        </div>

<?php /*?>
        <div class="central-buttons">
            <?php if($sf_user->hasCountry()): ?>
                <img src="graphics/website/portal/arrow.png" width="100" height="57"/>
                <a class="button big-orange float-right" href="<?=null!==$sf_user->getCountry() ? (MSHTools::getCountryPropertiesUrl($sf_user->getCountry()).'?clear=clear') : MSHTools::getChooseCountryUrl()?>">
               <?=__('text.seeallproperties')?> <?=__('text.for')?> <?php echo $sf_user->getCountry()->getTitle()?>
               </a>
            <?php endif;?>
        </div>

        <div class="right-buttons">
            <?php if(!$sf_user->hasCountry()): ?>
                <a style="float:right;" class="button gray proceed" href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('step.proceed')?> 2</a>
            <?php elseif($sf_user->getPhase() == 0): ?>
                <a style="float:right;" class="button gray proceed" href="<?=MSHTools::getCountryUrl($sf_user->getCountry());?>"><?=__('step.proceed')?> 2</a>
            <?php elseif($sf_user->getPhase() == 1): ?>
                <a style="float:right;" class="button gray proceed" href="<?=MSHTools::getCountryAdviceUrl($sf_user->getCountry());?>"><?=__('step.proceed')?> 3</a>
            <?php elseif($sf_user->getPhase() == 2): ?>
                <a style="float:right;" class="button gray proceed" href="<?=MSHTools::getPhaseUrl(3);?>"><?=__('step.proceed')?> 4</a>
            <?php elseif($sf_user->getPhase() == 3): ?>
            <?php endif;?>
    </div>
    <?php */?>

        <?= include_component('system','breadcrumb'); ?>
    </div>
</section>