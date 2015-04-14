<h3><?=__('title.appreciateprovider')?></h3>

<?php if($bValid): ?>
    <p>
        <?=__('text.thanksforyourappreciation')?>
    </p>
<?php else: ?>
<form id="form_appreciation" action="<?=MSHTools::getCountryProviderUrl($oProvider)?>?box=appreciation" method="POST">
<?=$oForm['_csrf_token']->render()?>

    <?=$oForm['country_knowledge']->render()?>
    <?=$oForm['communication']->render()?>
    <?=$oForm['financial_knowledge']->render()?>
    <?=$oForm['guidance']->render()?>


<table>
    <tbody>
        <tr>
            <th><?=__('text.countryknowledge')?></th>
            <td>
                <div class="rating dynamicInput" id="" ratingTarget="association_appreciation_country_knowledge">
                    <div>
                        <a <?=$iCountryKnowledge==5 ? 'class="highlite"' :'' ?> href="">5</a>
                        <a <?=$iCountryKnowledge==4 ? 'class="highlite"' :'' ?> href="">4</a>
                        <a <?=$iCountryKnowledge==3 ? 'class="highlite"' :'' ?> href="">3</a>
                        <a <?=$iCountryKnowledge==2 ? 'class="highlite"' :'' ?> href="">2</a>
                        <a <?=$iCountryKnowledge==1 ? 'class="highlite"' :'' ?> href="">1</a>
                    </div>
                </div>
            </td>
        </tr>
        
        <tr>
            <th><?=__('text.communication')?></th>
            <td>
                <div class="rating dynamicInput" id="" ratingTarget="association_appreciation_communication">
                    <div>
                        <a <?=$iCommunication==5 ? 'class="highlite"' :'' ?> class="" href="">5</a>
                        <a <?=$iCommunication==4 ? 'class="highlite"' :'' ?> class="" href="">4</a>
                        <a <?=$iCommunication==3 ? 'class="highlite"' :'' ?> class="" href="">3</a>
                        <a <?=$iCommunication==2 ? 'class="highlite"' :'' ?> class="" href="">2</a>
                        <a <?=$iCommunication==1 ? 'class="highlite"' :'' ?> class="" href="">1</a>
                    </div>
                </div>
            </td>
        </tr>
        
        <tr>
            <th><?=__('text.financialknowledge')?></th>
            <td>
                <div class="rating dynamicInput" id="" ratingTarget="association_appreciation_financial_knowledge">
                    <div>
                        <a <?=$iFinancialKnowledge==5 ? 'class="highlite"' :'' ?> class="" href="">5</a>
                        <a <?=$iFinancialKnowledge==4 ? 'class="highlite"' :'' ?> class="" href="">4</a>
                        <a <?=$iFinancialKnowledge==3 ? 'class="highlite"' :'' ?> class="" href="">3</a>
                        <a <?=$iFinancialKnowledge==2 ? 'class="highlite"' :'' ?> class="" href="">2</a>
                        <a <?=$iFinancialKnowledge==1 ? 'class="highlite"' :'' ?> class="" href="">1</a>
                    </div>
                </div>
            </td>
        </tr>
        
        <tr>
            <th><?=__('text.guidance')?></th>
            <td>
                <div class="rating dynamicInput" id="" ratingTarget="association_appreciation_guidance">
                    <div>
                        <a <?=$iGuidance==5 ? 'class="highlite"' :'' ?> class="" href="">5</a>
                        <a <?=$iGuidance==4 ? 'class="highlite"' :'' ?> class="" href="">4</a>
                        <a <?=$iGuidance==3 ? 'class="highlite"' :'' ?> class="" href="">3</a>
                        <a <?=$iGuidance==2 ? 'class="highlite"' :'' ?> class="" href="">2</a>
                        <a <?=$iGuidance==1 ? 'class="highlite"' :'' ?> class="" href="">1</a>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<p>
    <?=__('text.emailadressrequiredforappreciation')?>
</p>

    <?=$oForm['email_address']->render()?>
    <a href="Javascript:void(0);" id="aCancelAppreciation" tabindex="2" title="<?=__('text.notnow')?>"><?=__('text.notnow')?></a>
    <input class="button" id="inputSubmitAppreciate" tabindex="3" type="submit" value="<?=__('text.saveappreciation')?>" />

    <?php if($bSubmitted && $bAlreadySubmitted): ?>
        <?=$oForm->render()?>
        <script type="text/javascript">
            initNotification('error', '<?=__('text.warningalreadysubmitted')?>');
        </script>
    <?php elseif($bSubmitted):?>
        <?=$oForm->render()?>
        <script type="text/javascript">
            initNotification('error', '<?=__('text.warningproviderappreciationemailandappreciationisrequired')?>');
        </script>
    <?php endif; ?>
</form>
<?php endif; ?>



<script type="text/javascript">
    
    $('.dynamicInput div a').on('click', function(e){
    
        e.preventDefault();
        
        //
        var sFieldId = $(this).parent().parent().attr('ratingTarget');
        var sValue   = $(this).html();
        
        //
        $(this).parent().find('a').removeClass('highlite');
        $(this).addClass('highlite');
        
        
        // Set Value
        $('#'+sFieldId).val(sValue);
    });
    
    $('#form_appreciation').on('submit', function(e){
    
        e.preventDefault();
    
        //
        $.post($(this).attr('action'), $(this).serialize(), function(data){
            $('#divProviderAppreciation').html(data);
        });
        
    });
    
</script>