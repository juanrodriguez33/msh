<section class="block full">
    <?php if ($form->isNew()): ?>
        <?php if ($page->getPhase() == 0): ?>
            <h1><?php echo __('New orientation article', array(), 'messages') ?></h1>
        <?php elseif ($page->getPhase() == 1): ?>
            <h1><?php echo __('New inform article', array(), 'messages') ?></h1>
        <?php else: ?>
            <h1><?php echo __('New news article', array(), 'messages') ?></h1>
        <?php endif; ?>
    <?php else: ?>
        <h1><?php echo __('Edit', array(), 'messages') ?></h1>
    <?php endif; ?>
</section>

<?php include_partial('page/form', array('page' => $page, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
<?php include_partial('page/flashes') ?>