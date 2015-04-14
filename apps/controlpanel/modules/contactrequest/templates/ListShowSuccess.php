<section class="block full">
  <h1><?php echo __('Contactrequest detail', array(), 'messages') ?></h1>
</section>

<section class="block full">
  <div class="flat">
    <table class="form">
      <tr class="bar">
        <th colspan="2">Data</th>
      </tr>
      <tr>
        <th>Concerns</th>
        <td><?=$oContactRequest->getConcerns()?></td>
      </tr>
      <?php if($oContactRequest->getProperty() !== NULL && $oContactRequest->getProperty()->getAssociation() !== NULL):?>
      <tr>
        <th>Provider</th>
        <td><?=$oContactRequest->getProperty()->getAssociation()?></td>
      </tr>
      <?php endif; ?>
      <?php if($oContactRequest->getProperty() !== NULL && $oContactRequest->getProperty()->getUser() !== NULL):?>
      <tr>
        <th>Consumer</th>
        <td><?=$oContactRequest->getProperty()->getUser()->getName()?></td>
      </tr>
      <?php endif;?>
      <tr>
        <th>Name</th>
        <td><?=$oContactRequest->getName()?></td>
      </tr>
      <tr>
        <th>E-mail</th>
        <td><?=$oContactRequest->getEmailAddress()?></td>
      </tr>
      <tr>
        <th>Phone</th>
        <td><?=$oContactRequest->getPhoneNumber()?></td>
      </tr>
      <tr>
        <th>Message</th>
        <td><?=$oContactRequest->getContent()?></td>
      </tr>
      <tr>
        <th>Date</th>
        <td><?=format_date($oContactRequest->getCreatedAt(), 'f')?></td>
      </tr>
    </table>
  </div>
</section>

<section class="block full">
  <div>
    <ul class="actions">
      <li><a class="a_icon a_icon_index" href="<?php echo url_for('@contactrequest') ?>">Back to the list</a></li>
    </ul>
  </div>
</section>


