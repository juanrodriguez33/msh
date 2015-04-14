<?php $actions = array() ?>
      <?php $actions['actions']['_new'] = true ?>
  

  <section class="block large">
  <h1>
    <?php echo __('Transactions', array(), 'messages') ?>
    <?php if(isset($actions['actions']['_new'])): ?>
      <a class="a_button" href="<?php echo url_for('transaction/new') ?>"><span>Toevoegen</span></a>
    <?php endif; ?>
  </h1>
  
  <?php if(!isset($actions['batch_actions']) && !isset($actions['actions'])): ?>
    <div class="flat">
  <?php else: ?>
    <div class="transactionsModule">
  <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      <form id="form_batch_actions" action="<?php echo url_for('transaction_collection', array('action' => 'batch')) ?>" method="post">
    <?php endif; ?>
      <?php include_partial('transaction/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'actions' => $actions)) ?>
      <?php if(isset($actions['batch_actions']) || isset($actions['actions'])): ?>
        <ul class="actions">
          <?php if(isset($actions['batch_actions'])): ?>
            <?php include_partial('transaction/list_batch_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
          <?php if(isset($actions['actions'])): ?>
            <?php include_partial('transaction/list_actions', array('helper' => $helper, 'actions' => $actions)) ?>
          <?php endif; ?>
        </ul>
      <?php endif; ?>
    <?php if(isset($actions['batch_actions'])): ?>
      </form>
    <?php endif; ?>
  </div>
</section>

  <section class="block small">
    <?php include_partial('transaction/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </section>

<?php include_partial('transaction/flashes') ?>