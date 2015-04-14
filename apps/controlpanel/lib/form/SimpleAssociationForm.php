<?php
/**
 * Created by JetBrains PhpStorm.
 * User: simonsabelis
 * Date: 6/28/12
 * Time: 13:29
 * To change this template use File | Settings | File Templates.
 */
class SimpleAssociationForm extends AssociationForm
{
    public function configure()
    {
        parent::configure();
        unset($this['image_id']);
        unset($this['threshold_warning']);
        unset($this['newsletter']);
        unset($this['main_offer_id']);
    }

}
