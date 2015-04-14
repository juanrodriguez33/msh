<?php include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper pt-10px">

        <section class="large" id="articleList">
            <p class="head head1 mt-2px">
                <?php if($sCurrentSubject == 'all'){ ?>
                    <?=__('subject.all')?>
                <?php } elseif($sCurrentSubject == __('subject.search')) { ?>
                    <?=__('subject.search')?>
                <?php } else {?>
                    <?=$oCategory?>
                <?php } ?>
            </p>
            <?php include_partial('smallSearch', array('sPlaceholder' => __('text.search_article_placeholder'), 'sUrl' => MSHTools::getSubjectUrl(Functions::slugify(__('url.subjectsearch'))))) ?>

            <script type="text/javascript">
                submitOnReturn($('#form_information_search'), $('#form_information'));
            </script>

            <?php include_component('content','subjectSelection'); ?>
            <?php include_component('content','tagsAndOrdering', array('bQuestion' => false)); ?>

            <div id="ajax_articles" class="ajax">
                <ul class="block category no-js" id="ul_articles">
                    <?php if(sizeof($aArticle) == 0): ?>
                        <li>
                            <p class="empty head head3"><?=__('message.noarticleresults')?></p>
                        </li>

                    <?php else: ?>
                        <?php include_partial('contentArticles', array('aArticle' => $aArticle, 'iPages' => $iPages))?>
                    <?php endif; ?>
                </ul>
            </div>
            <a class="button down gray raquo" id="a_load_articles" title="<?=__('morearticles')?>"><?=__('morearticles')?></a>
        </section>

        <script type="text/javascript">

            var oArticles;
            var object      = { id: 'ul_articles', speed: <?=sfConfig::get('app_expander_speed')?>, trigger: 'a_load_articles', filter: 'filter', page_total: <?=$iPages?> };

            //
            oArticles = new Articles(object);
            oArticles.Init();
            oArticles.UpdatePageTotal(<?=$iPages?>);
        </script>

        <aside class="small" id="asideBanner">
            <?php include_partial('system/doubleclick'); ?>
            <?php include_component('property','asideTopProperties');?>
        </aside>

    </div>
</section>