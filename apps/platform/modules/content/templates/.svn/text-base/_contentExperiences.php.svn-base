<?php /** @var UserReference $oExperience */ ?>
<?php foreach($aExperience as $oExperience): ?>
    <li>
        <a href="<?=MSHTools::getCountryExperienceUrl($oExperience)?>" title="<?=__('readmore')?>">
            <img alt="" class="loader white" src="<?=null!==$oExperience->getSquareImage() ? $oExperience->getSquareImage()->getFormatUrl(180,180): '' ?>" pagespeed_no_transform />
        </a>
        <p class="ellipsis head head3">
            <a href="<?=MSHTools::getCountryExperienceUrl($oExperience)?>" title="<?=__('readmore')?>">
                <?=$oExperience?>
            </a>
        </p>
        <time class="icon"><?=$oExperience->getCreatedAt('d-m-Y')?></time>
        <p>
            <?=$oExperience->getIntro()?>
        </p>
        <div>
            <a class="bottom button gray raquo" href="<?=MSHTools::getCountryExperienceUrl($oExperience)?>" title="<?=__('readmore')?>"><?=__('readmore')?></a>
        </div>
    </li>
<?php endforeach;?>

<script type="text/javascript">
    if(typeof oArticles !== 'undefined') {
        oArticles.UpdatePageTotal(<?=$iPages?>);
    }
</script>