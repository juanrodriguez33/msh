<?php include_component('content', 'stepHeader'); ?>

<section class="content gray">
    <div class="wrapper">

        <article class="large" id="articleList">

            <div id="ajax_articles" class="ajax">
                <ul class="block category no-js" id="ul_articles">
                    <?php include_partial('contentExperiences', array('aExperience' => $aExperience))?>
                </ul>
            </div>
            <a class="button down gray raquo" id="a_load_questions" title="<?=__('moreexperiences')?>"><?=__('moreexperiences')?></a>
        </article>

        <script type="text/javascript">

            var oArticles;
            var object      = { id: 'ul_articles', trigger: 'a_load_questions', filter: 'filter', page_total: <?=$iPages?> };

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