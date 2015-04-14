<?= include_component('content', 'stepHeader'); ?>

<section class="content white">
    <div class="wrapper">
        <h1><?php echo /*__('country.region.cities') .*/ "Discover all cities from".  " " .$oRegion->getTitle()?></h1>
        <ul class="block oneThird citySelect" id="secondHomeSurroundings">
        <?php $i=0; foreach($aCity as $oCity):?>
            <li left="<?=($i%3==0?'true':'')?>" type="<?=($i%2==0?'odd':'even')?>">
                <a href="<?=MSHTools::getCountryRegionCityUrl($oCity)?>" title="<?=$oCity->getTitle()?>, <?=$oRegion->getTitle()?>">
                    <img alt="" height="45" width="45" src="graphics/website/elements/marker/default.png" pagespeed_no_transform />
                    <p class="head head4"><?=$oCity?></p>
                </a>
            </li>
        <?php $i++;endforeach;?>
        </ul>
    </div>
</section>