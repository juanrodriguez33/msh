<?php $actions = array() ?>
      <?php $actions['actions']['_new'] = true ?>
        <?php $actions['actions']['back'] = true ?>
        <?php $actions['object_actions']['up'] = true ?>
        <?php $actions['object_actions']['down'] = true ?>
        <?php $actions['object_actions']['_delete'] = true ?>
  

  <section class="block full">
  <h1>
    <?php echo __('Images for', array(), 'messages') ?> <?=$property?>
    <?php if(isset($actions['actions']['_new'])): ?>
      <a class="a_button" href="<?php echo url_for('linkpropertyimage/new') ?>"><span>Toevoegen</span></a>
    <?php endif; ?>
  </h1>
  
  <?php if(!isset($actions['batch_actions']) && !isset($actions['actions'])): ?>
    <div class="flat">
  <?php else: ?>
    <div>
  <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      <form id="form_batch_actions" action="<?php echo url_for('linkpropertyimage_collection', array('action' => 'batch')) ?>" method="post">
    <?php endif; ?>
      <?php include_partial('linkpropertyimage/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'actions' => $actions)) ?>
      <?php if(isset($actions['batch_actions']) || isset($actions['actions'])): ?>
        <ul class="actions">
          <?php if(isset($actions['batch_actions'])): ?>
            <?php include_partial('linkpropertyimage/list_batch_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
          <?php if(isset($actions['actions'])): ?>
            <?php include_partial('linkpropertyimage/list_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      </form>
    <?php endif; ?>
  </div>
</section>


<?php include_partial('linkpropertyimage/flashes') ?>