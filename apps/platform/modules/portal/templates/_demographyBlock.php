<aside>
    <p class="head head2"><?=__('portal.stats.demographyBlock')?></p>
    <table class="table" id="demographicTable">
        <tbody>
        <tr class="thead">
            <th><?=__('portal.stats.country')?></th>
            <td><?=__('portal.stats.count')?></td>
            <td>%</td>
        </tr>
        <?php $i=1; foreach($aTotals as $sKey => $aValues): if(intval($aValues['iTotal'])<=0) continue;?>
            <tr>
                <td><?=$sKey?></td>
                <td class="text-align_right"><strong><?=number_format($aValues['iTotal'],0,',','.')?></strong></td>
                <td class="text-align_right"><?=number_format($aValues['iPerc'],2,',','.')?></td>
            </tr>
            <?php $i++; endforeach;?>
            <?php if($i==1): ?>
                <tr>
                    <td colspan="3">
                        <?=__('portal.text.noresultsyet')?>
                    </td>
                </tr>
            <?php endif;?>
        </tbody>
    </table>
</aside>