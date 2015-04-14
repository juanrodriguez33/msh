<form id="form_forgot_password" action="<?php echo url_for('forgot_password') ?>" method="post" enctype="multipart/form-data">
  <p>
    E-mailadres:
    <?php echo $form['user']->render() ?>
  </p>

  <a class="a_button orange" href="JavaScript: $('#form_forgot_password').submit()"><span>Wachtwoord opsturen</span></a>
  <input type="submit" />
</form>

<?php if($form['user']->hasError()): ?>
  <script>
    initNotification('error', '<?php echo $form['user']->getError() ?>');
  </script>
<?php endif; ?>