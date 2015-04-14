<table class="index">
    <tr class="bar">
        <th class="full">Naam</th>
        <th>E-mailadres</th>
        <th>Telefoonnummer</th>
        <th>Woningen actief</th>
    </tr>
    <?php foreach($sf_data->getRaw('aAssociation') as $oAssociation): ?>
    <tr>
        <td class="normal"><?=$oAssociation?></td>
        <td><?=$oAssociation->getEmailAddress()?></td>
        <td><?=$oAssociation->getPhoneNumber()?></td>
        <td class="text-align_right"><?=$oAssociation->getNumberPlaced()?></td>
    </tr>
    <?php endforeach; ?>
</table>
<ul class="actions">
  <li><a class="a_button" href="/association"><span>Overzicht woningcorporaties</span></a></li>
  <li class="demarcation"><a class="a_icon a_icon_index" href="/transaction"><span>Overzicht transacties</span></a></li>
</ul>