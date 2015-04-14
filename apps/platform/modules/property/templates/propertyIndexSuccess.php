<script type="text/javascript">
            $('body').attr("onScroll", "document.cookie='ypos=' + window.pageYOffset");
            $(document).ready(function() {
                //window.scrollTo(0,readCookieToScroll('ypos'));
            	$('html, body').animate({
                    scrollTop: readCookieToScroll('ypos')
                }, 1000);
            });
</script>

<?php include_component('content', 'stepHeader'); ?>
<section class="content" id="offerSection">
    <div class="wrapper">
        <h1><?=__('title.propertiesin')?> <?php if(isset($oCity)):?><?=$oCity?>, <?php endif; ?> <?php if(isset($oRegion)):?><?=$oRegion?>, <?php endif; ?><?=$sf_user->getCountry()->getTitle()?></h1>
        <div class="bar" id="div_tabs">
            <ul>
                <li <?=$sf_user->getRefine() == 'all' ? 'class="current"' :''?> id="tab_search_results">
                    <a href="<?=$sUrl?>?refine=all" title="<?=__('text.yourselection')?>" id="button_search_results">
                        <?=__('text.yourselection')?> <span id="span_tab_all" class="span_tab span_tab_all">(5)</span>
                    </a>
                </li>
                <li <?=$sf_user->getRefine() == 'favorite' ? 'class="current"' :''?> id="tab_favorites">
                    <a href="<?=$sUrl?>?refine=favorite" title="<?=__('text.favorites')?>" id="button_favorites">
                        <span class="favorites"></span><?=__('text.favorites')?> <span id="span_tab_favorite" class="span_tab span_tab_favorites">(<?=$iFavorite?>)</span>
                    </a>
                </li>
            </ul>
        </div>

        <script type="text/javascript">
            initShowResultsButton();
            initShowFavoritesButton();
        </script>

        <?php include_component('property', 'displayAndSort');?>

        <div id="div_demarcation" class="demarcation demarcation_filter">

            <section class="filter" id="filterBar">
                <?php include_component('property', 'filter');?>
            </section>

            <section id="content" class="results">
                <?php if($sResultsType == 'favorite'): ?>
                    <?php include_component('property', 'favorites');?>
                <?php else: ?>
                    <?php include_component('property', 'propertyResults', array('pages' => $iPage));?>
                <?php endif; ?>
            </section>
        </div>

    </div>
</section>