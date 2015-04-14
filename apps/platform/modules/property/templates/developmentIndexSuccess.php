<?php include_component('content', 'stepHeader'); ?>
<section class="content" id="offerSection">
    <div class="wrapper">
        <h1><?=__('title.developmentsin')?> <?=$sf_user->getCountry()->getTitle()?></h1>

        <div class="bar" id="div_tabs">
            <ul>
                <li class="current">
                    <a href="<?=$sUrl?>" title="<?=__('text.yourSelection')?>">
                        <?=__('text.yourSelection')?> <span id="span_tab_all" class="span_tab span_tab_all">(5)</span>
                    </a>
                </li>
            </ul>
        </div>

        <?php include_component('property', 'displayAndSort');?>

        <div id="div_demarcation" class="demarcation demarcation_filter">

            <section class="filter" id="filterBar">
                <?php include_component('property', 'filter');?>
            </section>

            <section id="content" class="results">
                <?php include_component('property', 'developmentResults');?>
            </section>
        </div>

    </div>
</section>