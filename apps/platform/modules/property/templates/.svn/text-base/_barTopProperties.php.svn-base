<section class="content topRated">
    <div class="wrapper">
        <?php if(isset($bIsH1) && $bIsH1 === true):?>
        <h1>
            <?php if(null===$oCountry): ?>
                <?=__('topratedproperties')?>
            <?php else: ?>
                <?=__('topratedpropertiesin')?> <?=$sf_user->getCountry()->getTitle()?>
            <?php endif;?>
        </h1>
        <?php else: ?>
        <p class="head head1">
            <?php if(null===$oCountry): ?>
                <?=__('topratedproperties')?>
            <?php else: ?>
                <?=__('topratedpropertiesin')?> <?=$sf_user->getCountry()->getTitle()?>
            <?php endif;?>
        </p>
        <?php endif; ?>
        <ul class="block topRated big">
        <?php $i=0; foreach($aProperty as $oProperty): ?>
            <?php include_partial('propertyItemPhoto', array('left' => $i%4==0, 'oProperty' => $oProperty)); ?>
        <?php $i++; endforeach; ?>
        </ul>
        <sup>
            <?=__('totalofferin')?> <?=$sf_user->getCountry()->getTitle()?> <?=__('is')?> <strong><?=$iTotal?> <?=__('properties')?></strong>
            <a href="<?=null!==$sf_user->getCountry() ? (MSHTools::getCountryPropertiesUrl($sf_user->getCountry()).'?clear=clear') : MSHTools::getChooseCountryUrl()?>" class="button orange raquo">
                <?=__('text.seeallproperties')?>
            </a>
        </sup>
    </div>
</section>