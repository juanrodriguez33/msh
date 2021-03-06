<section id="breadcrumb">
    <nav itemprop="breadcrumb">


        <?php /** @var myUser $sf_user */ ?>

        <?php if(!get_slot('is_portal', false) && !get_slot('is_login',false)):?>
            <a href="<?=url_for('homepage')?>" title="<?=__('homepage')?>"><?=__('homepage')?></a>
            <?php if($sf_user->getPhase() == 0): ?>
                <a href="<?=MSHTools::getPhaseUrl(0)?>" title="<?=__('phase.orient')?>"><?=__('phase.orient')?></a>
            <?php elseif($sf_user->getPhase() == 1): ?>
                <?php if($sf_user->getCountry()):?>
                   <!-- <a href="<?=MSHTools::getCountryUrl($sf_user->getCountry())?>" title="<?=__('phase.inform')?>"><?=$sf_user->getCountry()->getTitle();?></a>  --> 
                <?php endif;?>
            <?php /*
            <a href="<?=MSHTools::getCountryUrl($sf_user->getCountry())?>" title="<?=__('phase.inform')?>"><?=__('phase.inform')?></a>
            */ ?>
            <?php elseif($sf_user->getPhase() == 2): ?>
                <?php if($sf_user->getCountry()):?>
                    <!-- <a href="<?=MSHTools::getCountryUrl($sf_user->getCountry())?>" title="<?=__('phase.inform')?>"><?=$sf_user->getCountry()->getTitle()?></a>  -->
                <?php endif;?>
                <a href="<?=MSHTools::getCountryAdviceUrl($sf_user->getCountry())?>" title="<?=__('phase.advice')?>"><?=__('phase.advice')?></a>
            <?php elseif($sf_user->getPhase() == 3): ?>
                <?php /*if($sf_user->getCountry()):?>
                    <a href="<?=MSHTools::getCountryUrl($sf_user->getCountry())?>" title="<?=__('phase.inform')?>"><?=$sf_user->getCountry()->getTitle()?></a>
                <?php endif*/;?>
                <a href="<?=MSHTools::getPhaseUrl(3)?>" title="<?=__('phase.find')?>">jojo<?=__('phase.find')?></a>
            <?php endif;?>
        
        <?php else: ?>
            <a href="<?=url_for('portal_overview')?>" title="<?=__('portal.overview')?>"><?=__('portal.overview')?></a>
        <?php endif; ?>


        <?php
            $bc = get_slot('bc', array());

            foreach($bc as $k => $v){
        ?>
                <a href="<?=$k?>" title="<?=$v?>"><?=$v?></a>
        <?php
            };
        ?>
        

       <?php if($sf_user->getCountry()):?>
            <a class="float_right border_none" href="<?=MSHTools::getCountryUrl($sf_user->getCountry())?>" title="<?=__('phase.inform')?>">See more from <?=$sf_user->getCountry()->getTitle()?></a>
       <?php endif;?>
    </nav>
</section>