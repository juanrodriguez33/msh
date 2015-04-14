<?php if($transaction->getType() == Transaction::TRANS_CONTRACT){ ?>
    New contract
<?php } elseif($transaction->getType() == Transaction::TRANS_CONSUMERPROPERTY) {?>
    <?=$transaction->getDescription()?>
<?php } elseif($transaction->getType() == Transaction::TRANS_ADDCREDITS) {?>
    <?=$transaction->getCredits()?> credits bought
<?php } elseif($transaction->getType() == Transaction::TRANS_PACKAGECHANGE) {?>
    <?=$transaction->getDescription()?>
<?php } elseif($transaction->getType() == Transaction::TRANS_DEDUCTCREDITS) {?>
    <?php if(stripos($transaction->getDescription(), 'toprated')!==false) {?>
        (-<?=$transaction->getCredits()?> credits) Toprated: <?=$transaction->getProperty()?>
    <?php } elseif(stripos($transaction->getDescription(), 'newsletter')!== false)  { ?>
        (-<?=$transaction->getCredits()?> credits) Newsletter: <?=$transaction->getProperty()?>
    <?php } else { ?>
        (-<?=$transaction->getCredits()?> credits) <?=$transaction->getDescription()?>
    <?php } ?>
<?php }?>