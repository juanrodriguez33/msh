<?php /** @var Transaction $transaction */ ?>
<?php if($transaction->getState() == Transaction::STATE_NEW){ ?>
    New
<?php } elseif($transaction->getState() == Transaction::STATE_PROCESSING) {?>
    Processing
<?php } elseif($transaction->getState() == Transaction::STATE_PAID) {?>
    Paid
<?php } elseif($transaction->getState() == Transaction::STATE_CANCELLED) {?>
    Cancelled
<?php } elseif($transaction->getState() == Transaction::STATE_ERROR) {?>
    Error
<?php }?>