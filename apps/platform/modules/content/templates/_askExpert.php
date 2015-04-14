<div id="askAnExpert" class="<?=(!isset($bHideExperts) || !$bHideExperts ? '' : 'noExperts') ?>">
    <a href="<?=MSHTools::getAskUrl($sCat)?>" id="a_askAnExpert">
        <span><?=__('questionnothere')?></span>
        <?=__('directyourquestiontoourexperts')?>
    </a>
    <?php if(!isset($bHideExperts) || !$bHideExperts): ?>
    <p class="head head4"><?=__('experts in')?> <?=$sf_user->getCountry()->getTitle()?></p>
    <ul>
    <?php foreach($aExpert as $oExpert): ?>
        <li>
            <p>
                <img alt="<?=$oExpert->getName()?>" src="<?=$oExpert->getImage() !== null ? $oExpert->getImage()->getFormatUrl(40,40) : ''?>" pagespeed_no_transform />
                <span class="title"><?=$oExpert->getName()?></span>
                <?php /* hier stond tekst, komt nog!  */ ?>
            </p>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>