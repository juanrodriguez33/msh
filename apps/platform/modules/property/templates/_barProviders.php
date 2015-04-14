<section class="content white">
    <div class="wrapper">
        <p class="head head1"><?=__('title.providers')?></p>
        <ul class="block providers">
        <?php $i=0; foreach($aProvider as $oProperty): $oProvider = $oProperty->getAssociation()?>
            <?php include_partial('providerItem', array('left' => $i%4==0, 'oProvider' => $oProvider)); ?>
        <?php $i++; endforeach; ?>
        </ul>
        <sup>
            <?=__('text.my2ndhomehas')?> <strong><?=$iCountProvider?> <?=__('text.providers')?></strong>
            <a class="button orange raquo" href="<?=MSHTools::getCountryProvidersUrl($sf_user->getCountry())?>">
                <?=__('text.seeallproviders')?>
            </a>
        </sup>
    </div>
</section>