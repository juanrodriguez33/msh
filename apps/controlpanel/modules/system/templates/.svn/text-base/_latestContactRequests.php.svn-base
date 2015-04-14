<?php if(sizeof($aRequest) > 0): ?>
  <table class="index">
      <tr class="bar">
          <th class="full">Betreft</th>
          <th>Naam</th>
          <th>Datum</th>
          <th>Acties</th>
      </tr>
      <?php foreach($sf_data->getRaw('aRequest') as $oRequest): ?>
      <tr>
          <td class="normal"><?=$oRequest->getProperty() != null ? $oRequest->getProperty() : ''?></td>
          <td><?=$oRequest->getName()?></td>
          <td><?=format_date($oRequest->getCreatedAt(), 'f')?></td>
          <?php include_partial("contactrequest/list_td_actions",array('contactrequest'=>$oRequest))?>
      </tr>
      <?php endforeach; ?>
  </table>
  <ul class="actions">
    <li><a href="/contactrequest" class="a_button"><span>Overzicht reacties</span></a></li>
  </ul>
<?php else: ?>
  <p>Er zijn geen resultaten gevonden</p>
<?php endif; ?>