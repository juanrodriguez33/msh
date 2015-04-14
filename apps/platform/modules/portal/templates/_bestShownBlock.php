<aside>
    <p class="head head2"><?=__('portal.stats.bestshownblock')?></p>
    <table class="table" id="topPropertyTable">
        <tbody>
        <tr class="thead">
            <td>&nbsp;</td>
            <th><?=__('portal.stats.property')?></th>
            <td><?=__('portal.stats.count')?></td>
            <td>%</td>
        </tr>
        <?php $i = 1 ?>
        <?php foreach($aTotals as $sKey => $aValues): ?>
            <tr>
                <td class="text-align_right"><?=$i?></td>
                <td><?=$aValues['sLabel']?></td>
                <td class="text-align_right"><strong><?=number_format($aValues['iTotal'],0,',','.')?></strong></td>
                <td class="text-align_right"><?=number_format($aValues['iPerc'],2,',','.')?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach;?>
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