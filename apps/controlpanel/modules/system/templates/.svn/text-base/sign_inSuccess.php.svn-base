<form id="form_sign_in" action="<?php echo url_for('sign_in') ?>" method="post" enctype="multipart/form-data">
  <?php //echo $form['_csrf_token']->render() ?>
  <h1>Beheerpaneel</h1>
  <p>
    E-mailadres / wachtwoord:
    <?php echo $form['user']->render() ?>
    <?php echo $form['password']->render() ?>
  </p>

  <a class="a_button orange" href="JavaScript: $('#form_sign_in').submit()"><span>Inloggen</span></a>
  <?php /*
  <a class="password" href="<?=url_for('forgot_password')?>"><span>Wachtwoord opvragen</span></a>
  */ ?>
  <input type="submit" />
</form>

<?php if($form['user']->hasError()): ?>
  <script>
    initNotification('error', '<?php echo $form['user']->getError() ?>');
  </script>
<?php elseif($form['password']->hasError()): ?>
  <script>
    initNotification('error', '<?php echo $form['password']->getError() ?>');
  </script>
<?php endif; ?>