<?php include_component('portal', 'header'); ?>

<section class="content" id="statistics">
    <div class="wrapper">

        <h1><?=__('portal.title.statistics')?></h1>

        <section id="statisticsGraph">
            <p class="head head1"><?=__('portal.title.graph')?></p>
            <img alt="<?=__('portal.title.statistics')?>" class="loader loader_64x64" src="<?=url_for('portal_statistics_graph')?>" />
        </section>

        <section id="statisticsFilter">
            <p class="head head1"><?=__('portal.stats.filter')?></p>
            <form action="<?=url_for('portal_statistics')?>" id="form_filter" method="post">
                <?=$form['_csrf_token']->render()?>
                <table class="form">
                    <tbody>
                        <tr>
                            <th>
                                <label for="filter_start" title="<?=__('portal.stats.filter.start')?>"><?=__('portal.stats.filter.start')?></label>
                            </th>
                            <td>
                                <?=$form['startDate']->render();?>
                                <span></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="filter_end" title="<?=__('portal.stats.filter.end')?>"><?=__('portal.stats.filter.end')?></label>
                            </th>
                            <td>
                                <?=$form['endDate']->render();?>
                                <span></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="filter_type" title="<?=__('portal.stats.filter.showingraph')?>"><?=__('portal.stats.filter.showingraph')?></label>
                            </th>
                            <td>
                                <span class="dropdown"></span>
                                <?=$form['type']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="filter_country" title="<?=__('portal.stats.filter.country')?>"><?=__('portal.stats.filter.country')?></label>
                            </th>
                            <td>
                                <span class="dropdown"></span>
                                <?=$form['country']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a class="button float_right orange" href="Javascript:$('#form_filter').submit();" title="<?=__('portal.stats.filter.button')?>"><?=__('portal.stats.filter.button')?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </section>

        <div class="devider"></div>

        <?php include_component('portal', 'totalBlock');?>

        <?php include_component('portal', 'demographyBlock');?>

        <?php include_component('portal', 'bestShownBlock');?>




    </div>

    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script>
        /* */
        $(function() {
            $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        });
    </script>
</section>