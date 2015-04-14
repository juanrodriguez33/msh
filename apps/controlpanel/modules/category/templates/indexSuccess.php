<?php $actions = array() ?>
      <?php $actions['actions']['_new'] = true ?>
        <?php $actions['batch_actions']['batchDelete'] = true ?>
        <?php $actions['object_actions']['_edit'] = true ?>
        <?php $actions['object_actions']['_delete'] = true ?>

        <?php $actions['object_actions']['up'] = true ?>
        <?php $actions['object_actions']['down'] = true ?>

  <section class="block large">
  <h1>
    <?php echo __('Categories', array(), 'messages') ?>
    <?php if(isset($actions['actions']['_new'])): ?>
      <a class="a_button" href="<?php echo url_for('category/new') ?>"><span>Toevoegen</span></a>
    <?php endif; ?>
  </h1>
  
  <?php if(!isset($actions['batch_actions']) && !isset($actions['actions'])): ?>
    <div class="flat">
  <?php else: ?>
    <div>
  <?php endif; ?>
    <ul class="tabs">
      <?php include_partial('category/tab', array('tab' => 'main', 'title' => 'Main categories', 'active' => $active)) ?>
      <?php include_partial('category/tab', array('tab' => 'sub', 'title' => 'Subcategories', 'active' => $active)) ?>
    </ul>
    <?php if(isset($actions['batch_actions'])): ?>
      <form id="form_batch_actions" action="<?php echo url_for('category_collection', array('action' => 'batch')) ?>" method="post">
    <?php endif; ?>
      <?php include_partial('category/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'actions' => $actions)) ?>
      <?php if(isset($actions['batch_actions']) || isset($actions['actions'])): ?>
        <ul class="actions">
          <?php if(isset($actions['batch_actions'])): ?>
            <?php include_partial('category/list_batch_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
          <?php if(isset($actions['actions'])): ?>
            <?php include_partial('category/list_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      </form>
    <?php endif; ?>
  </div>
</section>

  <section class="block small">
    <?php include_partial('category/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </section>

<?php include_partial('category/flashes') ?>