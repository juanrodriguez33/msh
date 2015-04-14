<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 3/27/13
 * Time: 11:58
 * To change this template use File | Settings | File Templates.
 */
?>

<?php if(get_slot('bDisableBreadcrumb', false) !== true): ?>
    <section class="content" id="title">
        <div class="wrapper">
            <h1>
                <?=__('title.register.thanks')?>
            </h1>
            <?= include_component('system','breadcrumb'); ?>
        </div>
    </section>
<?php endif; ?>

    <section class="content" id="sectionLogin">
        <div class="wrapper">

            <h1>
                <?=__('portal.register.thanks')?>
            </h1>
            <p class="mt-0px">
                <?=__('portal.register.thanksdescription')?>
            </p>
            <form id="payment_form" method="POST" action="<?=$sPaymentUrl?>">
                <?php foreach($aParams as $sKey => $sValue): ?>
                    <input type="hidden" name="<?=$sKey?>" value="<?=$sValue?>">
                <?php endforeach; ?>
            </form>
        </div>
    </section>
<script type="text/javascript">
    $(function () {
        setTimeout(function() {
            $('#payment_form').submit();
        }, 2000);
    })
</script>