<?= include_component('content', 'stepHeader'); ?>

<section class="content white">
    <div class="wrapper">
        <p class="head head1"><?=__('countries')?></p>
        <ul class="block oneThird countrySelect" id="secondHomeSurroundings">
        <?php $i=0; foreach($aCountry as $oCountry):?>
            <li left="<?=($i%3==0 ? 'true' : '')?>">
                <?php if($sf_user->getPhase()== 2) { ?>
                    <a href="<?=MSHTools::getCountryAdviceUrl($oCountry);?>" title="<?=__('readmore')?>">
                <?php } elseif($sf_user->getPhase()== 3) { ?>
                    <a href="<?=MSHTools::getCountryPropertiesUrl($oCountry);?>" title="<?=__('readmore')?>">
                <?php } else { ?>
                    <a href="<?=MSHTools::getCountryUrl($oCountry);?>" title="<?=__('readmore')?>">
                <?php } ?>
                    <img alt="<?=$oCountry?>" height="160" width="300" src="<?=$oCountry->getFirstImageUrl(300,160)?>" pagespeed_no_transform />
                    <p class="head head4"><?=$oCountry->getTitle()?></p>
                </a>
            </li>
        <?php $i++;endforeach;?>
        </ul>
    </div>
</section>