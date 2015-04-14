<?php include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">

        <article class="large" id="articleList">
            <h1>
                <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_question_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch')), null, true))) ?>
                <?php if($sCurrentSubject == 'all'){ ?>
                    <?=__('subject.all')?>
                <?php } elseif($sCurrentSubject == __('subject.search')) { ?>
                    <?=__('subject.search')?>
                <?php } else {?>
                    <?=$oCategory?>
                <?php } ?>
            </h1>

            <script type="text/javascript">
                submitOnReturn($('#form_information_search'), $('#form_information'));
            </script>

            <?php include_component('content','subjectSelection', array('bQuestion' => true)); ?>
            <?php include_component('content','tagsAndOrdering', array('bQuestion' => true)); ?>

            <div id="ajax_articles" class="ajax">
                <ul class="block category no-js" id="QandA">
                    <?php if(sizeof($aQuestion) == 0): ?>
                        <li>
                            <p class="head head3"><?=__('message.noresults')?></p>
                        </li>
                    <?php else: ?>
                        <?php include_partial('contentQuestions', array('aQuestion' => $aQuestion))?>
                    <?php endif; ?>
                </ul>
            </div>
            <a class="button down gray raquo" id="a_load_questions" title="<?=__('morequestions')?>"><?=__('morequestions')?></a>
        </article>

        <script type="text/javascript">

            var oArticles;
            var object      = { id: 'QandA', speed: <?=sfConfig::get('app_expander_speed')?>, trigger: 'a_load_questions', filter: 'filter', page_total: <?=$iPages?> };

            //
            oArticles = new Articles(object);
            oArticles.Init();
            oArticles.UpdatePageTotal(<?=$iPages?>);
        </script>

        <aside class="small" id="asideBanner">

            <?php include_partial('system/doubleclick'); ?>
            <?php include_component('content', 'askExpert'); ?>

            <?php include_component('property','asideTopProperties');?>
        </aside>

    </div>
</section>