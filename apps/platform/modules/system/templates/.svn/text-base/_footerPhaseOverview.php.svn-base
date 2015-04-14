<section class="content secondHome">
    <div class="wrapper">
        <p class="head head1"><?=__('whyneeda2ndhome')?></p>
        <ul class="block steps">
            <li>
                <img width="220" height="90" alt="<?=__('step')?> 1" src="/graphics/website/step1.jpg" pagespeed_no_transform />
                <p class="index">
                    <span class="step"><?=__('step')?> 1</span>
                    <span class="title"><?=__('phase.orient')?></span>
                </p>
                <p class="intro"><?=__('phase.orientdescription')?></p>
                <ul class="li-gt">
                    <?php $aCatPhase = CategoryI18nPeer::retrieveMainCategoryForPhase(0, $sf_user->getCulture());?>
                    <?php foreach($aCatPhase as $oCatI18n):?>
                        <li><a href="<?=MSHTools::getSubjectUrl($oCatI18n->getCategory()->getSlug(), 0)?>" title="<?=$oCatI18n->getTitle()?>"><?=$oCatI18n->getTitle()?></a></li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?=MSHTools::getPhaseUrl(0)?>" class="button gray raquo"><?=__('step.proceed')?> 1</a>
            </li>
            <li>
                <img width="220" height="90" alt="<?=__('step')?> 2" src="/graphics/website/step2.jpg" pagespeed_no_transform />
                <p class="index">
                    <span class="step"><?=__('step')?> 2</span>
                    <span class="title"><?=__('phase.inform')?></span>
                </p>
                <p class="intro"><?=__('phase.informdescription')?></p>
                <ul class="li-gt">
                    <?php $aCatPhase = CategoryI18nPeer::retrieveMainCategoryForPhase(1, $sf_user->getCulture());?>
                    <?php foreach($aCatPhase as $oCatI18n):?>
                        <li><a href="<?=MSHTools::getSubjectUrl($oCatI18n->getCategory()->getSlug(), 1)?>" title="<?=$oCatI18n->getTitle()?>"><?=$oCatI18n->getTitle()?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php if(!$sf_user->hasCountry()): ?>
                    <a class="button gray raquo" href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('step.proceed')?> 2</a>
                <?php else: ?>
                    <a class="button gray raquo" href="<?=MSHTools::getCountryUrl($sf_user->getCountry());?>"><?=__('step.proceed')?> 2</a>
                <?php endif; ?>
            </li>
            <li>
                <img width="220" height="90" alt="<?=__('step')?> 3" src="/graphics/website/step3.jpg" pagespeed_no_transform />
                <p class="index">
                    <span class="step"><?=__('step')?> 3</span>
                    <span class="title"><?=__('phase.advice')?></span>
                </p>
                <p class="intro"><?=__('phase.advicedescription')?></p>
                <ul class="li-gt">
                    <?php if($sf_user->hasCountry()): ?>
                        <li><a href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('subject.all')), 2, true)?>" title="<?=__('questions')?>"><?=__('questions')?></a></li>
                    <?php else: ?>
                        <li><a href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('questions')?></a></li>
                    <?php endif; ?>
                    <?php if($sf_user->hasCountry()): ?>
                        <li><a href="<?=MSHTools::getCountryExperiencesUrl($sf_user->getCountry())?>" title="<?=__('experiences')?>"><?=__('experiences')?></a></li>
                    <?php else: ?>
                        <li><a href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('experiences')?></a></li>
                    <?php endif; ?>
                    <?php if($sf_user->hasCountry()): ?>
                        <li><a href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('subject.all')), 2)?>" title="<?=__('news')?>"><?=__('news')?></a></li>
                    <?php else: ?>
                        <li><a href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('news')?></a></li>
                    <?php endif; ?>
                </ul>
                <?php if(!$sf_user->hasCountry()): ?>
                    <a class="button gray raquo" href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('step.proceed')?> 3</a>
                <?php else: ?>
                    <a class="button gray raquo" href="<?=MSHTools::getCountryAdviceUrl($sf_user->getCountry());?>"><?=__('step.proceed')?> 3</a>
                <?php endif; ?>
            </li>
            <li>
                <img width="220" height="90" alt="<?=__('step')?> 4" src="/graphics/website/step4.jpg" pagespeed_no_transform />
                <p class="index">
                    <span class="step"><?=__('step')?> 4</span>
                    <span class="title"><?=__('phase.find')?></span>
                </p>
                <p class="intro"><?=__('phase.finddescription')?></p>
                <ul class="li-gt">
                    <?php if($sf_user->hasCountry()): ?>
                        <li><a href="<?=MSHTools::getCountryPropertiesUrl($sf_user->getCountry())?>" title="<?=__('text.seeallpropertiesin')?> <?=$sf_user->getCountry()->getTitle()?>"><?=__('text.seeallpropertiesin')?> <?=$sf_user->getCountry()->getTitle()?></a></li>
                    <?php else:?>
                        <li><a href="<?=MSHTools::getChooseCountryUrl()?>" title="<?=__('text.seeallproperties')?>"><?=__('text.seeallproperties')?></a></li>
                    <?php endif; ?>
                    <?php if($sf_user->hasCountry()): ?>
                        <li><a href="<?=MSHTools::getCountryDevelopmentsUrl($sf_user->getCountry())?>" title="<?=__('text.seealldevelopmentsin')?> <?=$sf_user->getCountry()->getTitle()?>"><?=__('text.seealldevelopmentsin')?> <?=$sf_user->getCountry()->getTitle()?></a></li>
                    <?php else: ?>
                        <li><a href="<?=MSHTools::getChooseCountryUrl()?>" title="<?=__('text.seealldevelopments')?>"><?=__('text.seealldevelopments')?></a></li>
                    <?php endif; ?>
                    <?php if($sf_user->hasCountry()): ?>
                        <li><a href="<?=MSHTools::getCountryProvidersUrl($sf_user->getCountry())?>" title="<?=__('text.seeallprovidersin')?> <?=$sf_user->getCountry()->getTitle()?>"><?=__('text.seeallprovidersin')?> <?=$sf_user->getCountry()->getTitle()?></a></li>
                    <?php else: ?>
                        <li><a href="<?=MSHTools::getChooseCountryUrl()?>" title="<?=__('text.seeallproviders')?>"><?=__('text.seeallproviders')?></a></li>
                    <?php endif;?>
                </ul>
                <?php if(!$sf_user->hasCountry()): ?>
                    <a class="button gray raquo" href="<?=MSHTools::getChooseCountryUrl()?>"><?=__('step.proceed')?> 4</a>
                <?php else: ?>
                    <a class="button gray raquo" href="<?=MSHTools::getCountryUrl($sf_user->getCountry());?>"><?=__('step.proceed')?> 4</a>
                <?php endif; ?>
            </li>
        </ul>
    </div>
</section>