<section class="content mh-120px" id="title">
    <div class="wrapper">
        <div class="mh-50px">
            <p class="head head1">
                <?=__('title.portal.controlpanel')?>
            </p>
        </div>
        <?= include_component('system','breadcrumb'); ?>

        <?php if(sfConfig::get('app_accountoverview_enabled') === true):?>
        <aside id="accountOverview">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">
                            <?=$sf_user->getUser()->getName()?><?php if($sf_user->hasCredential('ROLE_ASSOCIATION')):?>, <span><?=$sf_user->getUser()->getAssociation()->getTitle()?></span><?php endif;?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><?=__('portal.properties')?></th>
                        <td><?=$iActiveProperties?> <?php if($sf_user->hasCredential('ROLE_ASSOCIATION')):?>/ <?=$iMaxProperties?><?php endif;?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php if($sf_user->hasCredential('ROLE_ASSOCIATION')):?>
                        <tr>
                            <th><?=__('portal.developments')?></th>
                            <td><?=$iDevelopment?> / <?=$iMaxDevelopment?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th><?=__('portal.package')?></th>
                            <td>&euro; <?= /*format_currency_msh*/($fMonthly)?></td>
                            <td>
                                <a class="add" href="<?=url_for('portal_package')?>" title="<?=__('portal.add')?>">+</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th><?=__('portal.credits')?></th>
                        <td><?=$iCredits?> / <?=$iMaxCredits?></td>
                        <td>
                            <a class="add" href="<?=url_for('portal_buycredits')?>" title="<?=__('portal.add')?>">+</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </aside>
        <?php endif; ?>
    </div>
</section>