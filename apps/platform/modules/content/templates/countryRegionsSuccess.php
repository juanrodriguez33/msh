<?= include_component('content', 'stepHeader'); ?>

<section class="content white">
    <div class="wrapper">
        <h1><?=__('country.regions')?></h1>
        <ul class="block oneThird regionSelect" id="secondHomeSurroundings">
        <?php $i=0; foreach($aRegion as $oRegion):?>
            <li left="<?=($i%3==0?'true':'')?>" type="<?=($i%2==0?'odd':'even')?>">
                <a href="<?=MSHTools::getCountryRegionUrl($oRegion)?>" title="<?=$oRegion?>, <?=$oCountry->getTitle()?>">
                    <img alt="" height="160" width="300" src="<?=$oRegion->getFirstImageUrl(300,160,true)?>" pagespeed_no_transform /><?php /*getFirstImageUrl(300,160)*/?>
                    <p class="head head4"><?=$oRegion?></p>
                </a>
            </li>
        <?php $i++;endforeach;?>
        </ul>
    </div>
</section>