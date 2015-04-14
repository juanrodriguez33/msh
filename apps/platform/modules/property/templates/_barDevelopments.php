<section class="content topRated">
    <div class="wrapper">
        <p class="head head1"><?=__('developments')?></p>
        <ul class="block topRated big">
        <?php $i=0; foreach($aDevelopment as $oProperty): /** @var Property $oProperty */ $oDevelopment = $oProperty->getDevelopment()?>
            <?php include_partial('developmentItemPhoto', array('left' => $i%4==0, 'oDevelopment' => $oDevelopment)); ?>
        <?php $i++; endforeach; ?>
        </ul>
        <sup>
            <?=__('totalofferin')?> <?=$sf_user->getCountry()->getTitle()?> <?=__('is')?> <strong><?=$iCountDevelopment?> <?=__('developments')?></strong>
            <a class="button orange raquo" href="<?=MSHTools::getCountryDevelopmentsUrl($sf_user->getCountry())?>">
                <?=__('text.seealldevelopments')?>
            </a>
        </sup>
    </div>
</section>