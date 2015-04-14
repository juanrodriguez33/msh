<form id="form_contact" action="<?php echo url_for('system/index') ?>" method="post" enctype="multipart/form-data">
      <table class="form">
        <tr>
          <th>Naam</th>
          <td>
            <?php echo $oForm['name']->render() ?>
            <?php echo $oForm['name']->renderError() ?>
            <?php if($help = $oForm['name']->renderHelp()): ?>
              <br /><span><?php echo $help ?></span>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th>Onderwerp</th>
          <td>
            <?php echo $oForm['subject']->render() ?>
            <?php echo $oForm['subject']->renderError() ?>
            <?php if($help = $oForm['subject']->renderHelp()): ?>
              <br /><span><?php echo $help ?></span>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th>Bericht</th>
          <td>
            <?php echo $oForm['content']->render() ?>
            <?php echo $oForm['content']->renderError() ?>
            <?php if($help = $oForm['content']->renderHelp()): ?>
              <br /><span><?php echo $help ?></span>
            <?php endif; ?>
          </td>
        </tr>
      </table>

        <ul class="actions">
            <li><a class="a_button" href="JavaScript:$('#form_contact').submit()"><span>Verzenden</span></a></li>
        </ul>


</form>