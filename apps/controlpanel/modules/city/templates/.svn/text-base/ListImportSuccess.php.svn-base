  <section class="block large">
  <h1>
    <?php echo __('Import', array(), 'messages') ?>
  </h1>

      <?php if(strlen($sUpdateText)>0):?>
          <div>
              <h2>Import result</h2>
              <p>
                <?=$sf_data->getRaw('sUpdateText')?>
              </p>
          </div>
      <?php endif;?>
  

    <div>
      <form id="import_form" action="<?php echo url_for('city_collection', array('action' => 'ListImport')) ?>" method="post" enctype="multipart/form-data">
        <?=$form['file']->render()?><br />
          <button type="submit" value="Import">Import</button>
      </form>
  </div>
    <div>
      <ul class="actions">
        <li><a class="a_icon a_icon_" href="<?= url_for('city_collection', array('action' => 'index'))?>">Back to city list</a></li>
      </ul>
    </div>
</section>