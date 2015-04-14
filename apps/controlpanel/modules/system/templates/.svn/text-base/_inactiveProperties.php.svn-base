<?php if(sizeof($aProperty) > 0): ?>
  <table class="index">
    <tr class="bar">
        <th class="full">Adres</th>
        <th>Postcode</th>
        <th>Plaats</th>
        <th>Aankoopbedrag</th>
        <th>Toevoegdatum</th>
        <th>Acties</th>
    </tr>
    <?php foreach($sf_data->getRaw('aProperty') as $oProperty): ?>
    <tr>
        <td class="normal"><?=$oProperty->getFirstAddressParts()?></td>
        <td><?=$oProperty->getZipcode()?></td>
        <td><?=$oProperty->getCity()?></td>
        <td class="text-align_right">&euro; <?=number_format($oProperty->getPrice(), 0, ',', '.')?>,-</td>
        <td><?=format_date($oProperty->getCreatedAt(), 'D')?></td>
        <?php include_partial("property/list_td_actions",array('property'=>$oProperty, 'bStats' => false))?>
    </tr>
    <?php endforeach; ?>
  </table>
  <ul class="actions">
    <li><a class="a_button" href="/property?tab=inactive"><span>Overzicht woningen met aandacht</span></a></li>
  </ul>
<?php else: ?>
  <p>Er zijn geen resultaten gevonden</p>
<?php endif; ?>