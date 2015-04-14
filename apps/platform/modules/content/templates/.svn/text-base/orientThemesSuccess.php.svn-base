<?= include_component('content', 'stepHeader'); ?>

<section class="content white">
    <div class="wrapper">
        <p class="head head1"><?=__('themes')?></p>
        <ul class="block oneThird" id="secondHomeSurroundings">
        <?php $i=0; foreach($aTheme as $oTheme):?>
            <li left="<?=($i%3==0 ? 'true' : '')?>">
                <img alt="<?=$oTheme?>" height="160" width="300" src="<?=$oTheme->getFirstImageUrl(300,160)?>" pagespeed_no_transform />
                <p class="head head4"><?=$oTheme?></p>
                <?php $aCountry = $oTheme->getCountries();?>
                <ul class="li-gt">
                    <?php $a=0; foreach($aCountry as $sCountry => $oCountry) { ?>
                        <?php if($a>3) break; ?>
                        <li>
                            <a href="<?=MSHTools::getCountryUrl($oCountry)?>" title="<?=$oCountry->getTitle()?>"><?=$oCountry->getTitle()?></a>
                        </li>
                    <?php $a++; } ?>
                </ul>
                <a class="button gray raquo" href="<?=MSHTools::getThemeUrl($oTheme)?>"><?=__('readmore')?></a>
            </li>
        <?php $i++;endforeach;?>
        </ul>
    </div>
</section>