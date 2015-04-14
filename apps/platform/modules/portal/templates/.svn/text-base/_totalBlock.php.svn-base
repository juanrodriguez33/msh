<aside>
    <p class="head head2"><?=__('portal.stats.total')?></p>
    <table class="table" id="totalTable">
        <tbody>
            <tr class="thead">
                <th><?=__('portal.stats.total')?></th>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="text-align_right"><strong><?= isset($aTotals['displayed']) ? number_format($aTotals['displayed'],0,',','.') : 0?></strong></td>
                <td class="full"><?=$iProperty == null ? __('portal.stats.stat.displayed') : __('text.displayed') ?></td>
                <?php //$iProperty == null ? 'Woningen getoond' : 'Getoond' ?>
            </tr>
            <tr>
                <td class="text-align_right"><strong><?=isset($aTotals['found']) ? number_format($aTotals['found'],0,',','.') : 0?></strong></td>
                <td class="full"><?=$iProperty == null ? __('portal.stats.stat.found') : __('text.found')?></td>
                <?php //$iProperty == null ? 'Woningen gevonden' : 'Gevonden'?>
            </tr>
            <tr>
                <td class="text-align_right"><strong><?=isset($aTotals['viewed']) ? number_format($aTotals['viewed'],0,',','.') : 0?></strong></td>
                <td class="full"><?=$iProperty == null ? __('portal.stats.stat.viewed') : __('text.viewed')?></td>
                <?php //$iProperty == null ? 'Woningen bekeken' : 'Bekeken'?>
            </tr>
            <tr>
                <td class="text-align_right"><strong><?=isset($aTotals['contact']) ? number_format((isset($aTotals['contact']) ? $aTotals['contact'] : 0) +
                        (isset($aTotals['public_visit']) ? $aTotals['public_visit'] : 0),0,',','.') : 0?></strong></td>
                <td class="full"><?=__('portal.stats.stat.contact')?></td>
                <?php // Contact opgenomen ?>
            </tr>        
            <tr>
                <td class="text-align_right"><strong><?=isset($aTotals['brochure']) ? number_format($aTotals['brochure'],0,',','.') : 0?></strong></td>
                <td class="full"><?=__('portal.stats.stat.brochure')?></td>
                <?php // Brochure gedownload ?>
            </tr>
            <tr>
                <td class="text-align_right"><strong><?=isset($aTotals['phone']) ? number_format($aTotals['phone'],0,',','.') : 0?></strong></td>
                <td class="full"><?=__('portal.stats.stat.phone')?></td>
                <?php // Telefoonnummer opgevraagd ?>
            </tr>
            <tr>
                <td class="text-align_right"><strong><?=isset($aTotals['website']) ? number_format($aTotals['website'],0,',','.') : 0?></strong></td>
                <td class="full"><?=__('portal.stats.stat.website')?></td>
                <?php // Doorgeklikt naar website ?>
            </tr>
        </tbody>
    </table>
</aside>