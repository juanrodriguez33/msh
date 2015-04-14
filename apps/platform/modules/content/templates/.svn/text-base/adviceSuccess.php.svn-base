<?= include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">

        <article class="large" id="articleList">
        
            <h1>
                <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_question_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch')), null, true))) ?>
                <?=__('subject.all')?>
            </h1>

            <script type="text/javascript">
                submitOnReturn($('#form_information_search'), $('#form_information'));
            </script>

            <?php include_component('content','subjectSelection', array('bQuestion' => true)); ?>

            <div id="ajax_articles" class="ajax">
                <ul class="block category no-js" id="QandA">
                    <?php include_partial('contentQuestions', array('aQuestion' => $aQuestion))?>
                </ul>
            </div>
            <a href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectall')),2,true)?>" class="button right gray raquo" id="a_load_articles" title="<?=__('morequestions')?>"><?=__('morequestions')?></a>
        </article>

        <aside class="small" id="asideBanner">
            <?php include_partial('system/doubleclick'); ?>
            <?php include_component('content', 'askExpert'); ?>
            <?php include_component('property','asideTopProperties');?>
        </aside>

    </div>
</section>

<section class="content" id="experienceFooter">
    <div class="wrapper">
        <section class="float_left">
            <p class="head head2"><?=__('experiences')?></p>
            <ul class="block experiences <?=(count($aExperience)==0?'autoHeight':'')?>">
                <?php foreach($aExperience as $oExperience): ?>
                <li>
                    <a href="<?=MSHTools::getCountryExperienceUrl($oExperience)?>" title="<?=$oExperience?>">
                        <p>
                            <?php if($oExperience->getSquareImage() !== NULL):?>
                            <img alt="<?=$oExperience?>" src="<?=$oExperience->getSquareImage()->getFormatUrl(60,60,true);?>" pagespeed_no_transform />
                            <?php endif; ?>
                            <span class="title"><?=$oExperience?></span>
                            <?=$oExperience->getIntro()?>
                        </p>
                        <p class="author"><?=$oExperience->getName()?></p>
                    </a>
                </li>
                <?php endforeach ?>
            </ul>
            <?php if(count($aExperience)>2):?>
            <a class="button dark float_right gray raquo" href="<?=MSHTools::getCountryExperiencesUrl($sf_user->getCountry())?>" title="<?=__('moreexperienceds')?>"><?=__('moreexperienceds')?></a>
            <?php endif; ?>
        </section>
        <aside class="float_right">
            <?php include_component('content','footerRecentNews'); ?>
            <a class="button dark float_right gray raquo" href="<?=MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectall')))?>" title="<?=__('news.more')?>"><?=__('news.more')?></a>
        </aside>
    </div>
</section>

