<?php $actions = array() ?>
      <?php $actions['actions']['_new'] = true ?>
        <?php $actions['batch_actions']['batchDelete'] = true ?>
        <?php $actions['object_actions']['_edit'] = true ?>
        <?php $actions['object_actions']['_delete'] = true ?>
<?php $actions['object_actions']['comments'] = true ?>
  

  <section class="block large">
  <h1>
    <?php echo __('Content', array(), 'messages') ?>
    <?php if(isset($actions['actions']['_new'])): ?>
      <a class="a_button" href="<?php echo url_for('page/new') ?>"><span>Toevoegen</span></a>
    <?php endif; ?>
  </h1>
  
  <?php if(!isset($actions['batch_actions']) && !isset($actions['actions'])): ?>
    <div class="flat">
  <?php else: ?>
    <div>
  <?php endif; ?>
    <ul class="tabs">
      <?php include_partial('page/tab', array('tab' => 'orient', 'title' => 'Orient', 'active' => $active)) ?>
      <?php include_partial('page/tab', array('tab' => 'inform', 'title' => 'Inform', 'active' => $active)) ?>
      <?php include_partial('page/tab', array('tab' => 'news', 'title' => 'News', 'active' => $active)) ?>
    </ul>
    <?php if(isset($actions['batch_actions'])): ?>
      <form id="form_batch_actions" action="<?php echo url_for('page_collection', array('action' => 'batch')) ?>" method="post">
    <?php endif; ?>
      <?php include_partial('page/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'actions' => $actions)) ?>
      <?php if(isset($actions['batch_actions']) || isset($actions['actions'])): ?>
        <ul class="actions">
          <?php if(isset($actions['batch_actions'])): ?>
            <?php include_partial('page/list_batch_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
          <?php if(isset($actions['actions'])): ?>
            <?php include_partial('page/list_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      </form>
    <?php endif; ?>
  </div>
</section>

  <section class="block small">
    <?php include_partial('page/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </section>

<?php include_partial('page/flashes') ?>