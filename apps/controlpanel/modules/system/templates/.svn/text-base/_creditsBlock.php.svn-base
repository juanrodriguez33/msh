<table>
    <tr>
        <th>Aantal</th>
        <td><?=$sf_user->getAssociation()->getCredits()?></td>
    </tr>
    <tr>
        <th>Laatste toevoeging</th>
        <td><?=$sf_data->getRaw('sf_user')->getAssociation()->getLatestTransaction() !== null ? format_date($sf_data->getRaw('sf_user')->getAssociation()->getLatestTransaction()->getCreatedAt(),'f') : 'Geen beschikbaar'?></td>
    </tr>
</table>
<ul class="actions">
  <li><a class="a_button" href="<?php echo url_for('transaction/ListRequest') ?>"><span>Tegoed aanvragen</span></a></li>
  <li class="demarcation"><a class="a_icon a_icon_index" href="/transaction"><span>Overzicht transacties</span></a></li>
</ul>