<?php $actions = array() ?>
      <?php $actions['actions']['_new'] = true ?>
        <?php $actions['batch_actions']['batchDelete'] = true ?>
        <?php $actions['object_actions']['_edit'] = true ?>
        <?php $actions['object_actions']['_delete'] = true ?>
        
        <?php if($active == "provider"): ?>
            <?php $actions['object_actions']['disable'] = true ?>
        <?php endif; ?>
  

  <section class="block large">
  <h1>
    <?php echo __('Users', array(), 'messages') ?>
    <?php if(isset($actions['actions']['_new'])): ?>
      <a class="a_button" href="<?php echo url_for('user/new') ?>"><span>Toevoegen</span></a>
    <?php endif; ?>
  </h1>
  
  <?php if(!isset($actions['batch_actions']) && !isset($actions['actions'])): ?>
    <div class="flat">
  <?php else: ?>
    <div>
  <?php endif; ?>
    <ul class="tabs">
      <?php include_partial('user/tab', array('tab' => 'admin', 'title' => 'Admin', 'active' => $active)) ?>
      <?php include_partial('user/tab', array('tab' => 'expert', 'title' => 'Expert', 'active' => $active)) ?>
      <?php include_partial('user/tab', array('tab' => 'provider', 'title' => 'Provider', 'active' => $active)) ?>
      <?php include_partial('user/tab', array('tab' => 'consumer', 'title' => 'Consumer', 'active' => $active)) ?>
    </ul>
    <?php if(isset($actions['batch_actions'])): ?>
      <form id="form_batch_actions" action="<?php echo url_for('user_collection', array('action' => 'batch')) ?>" method="post">
    <?php endif; ?>
      <?php include_partial('user/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'actions' => $actions)) ?>
      <?php if(isset($actions['batch_actions']) || isset($actions['actions'])): ?>
        <ul class="actions">
          <?php if(isset($actions['batch_actions'])): ?>
            <?php include_partial('user/list_batch_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
          <?php if(isset($actions['actions'])): ?>
            <?php include_partial('user/list_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      </form>
    <?php endif; ?>
  </div>
</section>

  <section class="block small">
    <?php include_partial('user/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </section>

<?php include_partial('user/flashes') ?>