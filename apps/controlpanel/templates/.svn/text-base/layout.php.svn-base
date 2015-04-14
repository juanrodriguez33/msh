<!DOCTYPE html>
<html lang="nl">

<head>

    <title>MySecondHome Beheerpaneel</title>

    <meta charset="UTF-8"/>
    <meta name="author" content="KiwiMedia"/>
    <meta name="robots" content="noindex, nofollow"/>

    <base href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/">

    <link rel="stylesheet" href="/css/fonts.css?version=<?php echo date('Ym')?>"/>
    <link rel="stylesheet" href="/css/controlpanel.css?version=<?php echo date('Ymd')?>"/>

    <link rel="shortcut icon" href="/graphics/controlpanel/favicon.ico?version=<?php echo date('Ym')?>"/>
    <link rel="apple-touch-icon-precomposed" href="/graphics/controlpanel/touch.png?version=<?php echo date('Ym')?>"/>
    
    <!--[if IE 8]><link rel="stylesheet" type="text/css" href="./css/controlpanel_ie8.css"><![endif]-->

    <script src="/js/jquery.js?version=<?php echo date('Ym')?>"></script>
    <script src="/js/html5.js?version=<?php echo date('Ym')?>"></script>
    <script src="/js/functions_admin.js?version=<?php echo date('Ymd') ?>"></script>
    <script src="/tinymce/tiny_mce.js?version=<?php echo date('Ymd') ?>"></script>


    <script src="/js/editor_admin.js?version=<?php echo date('Ymd') ?>"></script>
    <script src="/js/swfobject.js?version=<?php echo date('Ymd') ?>"></script>

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?=Functions::getAnalyticsTracker()?>']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>

</head>

<body id="body" class="controlpanel">

<div id="notification">
</div>

<div id="topBorder"></div>
<div id="menuBorder"></div>

<?php if (preg_match('/kiwiwerkplaats/', $_SERVER['HTTP_HOST'])): ?>
    <div id="workplace">
        Werkplaats
    </div>
<?php endif; ?>

<div id="frame">

    <header id="header">

        <img class="logo" src="/graphics/controlpanel/logo.png" alt="Vind je Plek"/>

        <aside>
            <p>
                Ingelogd als <strong><?php echo $sf_user->getAdmin()->getName() ?></strong>
                <br/>
                <a class="a_icon a_icon_sign_out" href="<?php echo url_for('sign_out') ?>"
                   title="Uitloggen">Uitloggen</a>
            </p>
        </aside>

    </header>

    <nav id="menu">
        <ul><?php /*
            <li <?= get_slot('menu', '') == '' ? 'class="active"' : ''?>><a class="dashboard" href="/"
                                                                            title="Start"><span></span>Start</a></li>
            */ ?>
            <li <?= get_slot('menu', '') == 'association' ? 'class="active"' : ''?>>
                <a class="associations" href="<?php echo url_for('association/index') ?>" title="Providers"><span></span>Providers</a>
                <ul>
                    <li><a class="admins" href="<?php echo url_for('user/index') ?>?tab=consumer"
                           title="Developments"><span></span>Consumers</a></li>
                </ul>
            </li>
            <li <?= (get_slot('menu', '') == 'property' || get_slot('menu', '') == 'development') ? 'class="active"' : ''?>>
                <a class="property_index index" href="JavaScript: void(0)" title="Properties"><span></span>Properties</a>
                <ul>
                    <li><a class="properties" href="<?php echo url_for('property/index') ?>"
                                               title="Properties"><span></span>Properties</a></li>
                    <li><a class="development" href="<?php echo url_for('development/index') ?>"
                           title="Developments"><span></span>Developments</a></li>
                </ul>
            </li>
            <?php /**
            <li <?= (get_slot('menu', '') == 'property' || get_slot('menu', '') == 'scheme' || get_slot('menu', '') == 'offer' || get_slot('menu', '') == 'development') ? 'class="active"' : ''?>>
                <a class="index" href="JavaScript: void(0)" title="Properties"><span></span>Properties</a>
                <ul>
                    <li><a class="properties" href="<?php echo url_for('property/index') ?>"
                           title="Properties"><span></span>Properties</a></li>
                    <li><a class="development" href="<?php echo url_for('development/index') ?>"
                           title="Developments"><span></span>Developments</a></li>
                </ul>
            </li>
            <li <?= get_slot('menu', '') == 'association' ? 'class="active"' : ''?>><a class="associations"
                                                                                       href="<?php echo url_for('association/index') ?>"
                                                                                       title="Providers"><span></span>Providers</a>
            </li>**/?>
            <?php/**<li <?= get_slot('menu','') == 'agency' ? 'class="active"' : ''?>><a class="agencies" href="<?php echo url_for('agency/index') ?>" title="Makelaars"><span></span>Makelaars</a></li>**/?>

            <?php/**<li <?= get_slot('menu', '') == 'contracts' ? 'class="active"' : ''?>></a>
                <a class="contracts" href="JavaScript: void(0)" title="Contracts"><span></span>Contracts</a>
                <ul>
                    <li><a class="contracts" href="<?php echo url_for('contract/index') ?>"
                           title="Contracts"><span></span>Contracts</a></li>
                    <li><a class="transactions" href="<?php echo url_for('transaction/index') ?>"
                           title="Transactions"><span></span>Transactions</a></li>
                </ul>
            </li>**/?>
            <li <?= get_slot('menu', '') == 'content' ? 'class="active"' : ''?>>
                <a class="pages_index index" href="JavaScript: void(0)" title="Content"><span></span>Content</a>
                <ul>
                    <li><a class="pages" href="<?php echo url_for('category/index') ?>" title="Categories"><span></span>Categories</a></li>
                    <li><a class="pages" href="<?php echo url_for('page/index') ?>" title="Content"><span></span>Content</a></li>
                    <li><a class="pages" href="<?php echo url_for('question/index') ?>" title="Questions"><span></span>Questions</a></li>
                    <li><a class="pages" href="<?php echo url_for('userreference/index') ?>" title="Experiences"><span></span>Experiences</a></li>
                    <li><a class="pages" href="<?php echo url_for('banner/index') ?>" title="Banners"><span></span>Banners</a></li>
                </ul>
            </li>
            <li <?= (get_slot('menu','') == 'contact') ? 'class="active"' : ''?>>
                <a class="conversions" href="JavaScript: void(0)" title="Conversies"><span></span>Conversions</a>
                <ul>
                    <li><a class="contacts" href="<?php echo url_for('contactrequest/index') ?>" title="Contactrequests"><span></span>Contactrequests</a></li>
                </ul>
            </li>
            <li <?= (get_slot('menu', '') == 'demography') ? 'class="active"' : ''?>>
                <a class="demographic_index index" href="JavaScript: void(0)" title="Demography"><span></span>Demography</a>
                <ul>
                    <li><a class="cities" href="<?php echo url_for('language/index') ?>"
                           title="Languages"><span></span>Languages</a></li>
                    <li><a class="cities" href="<?php echo url_for('country/index') ?>" title="Countries"><span></span>Countries</a>
                    </li>
                    <li><a class="cities" href="<?php echo url_for('region/index') ?>" title="Regions"><span></span>Regions</a>
                    </li>
                    <li><a class="cities" href="<?php echo url_for('city/index') ?>" title="Cities"><span></span>Cities</a>
                    </li>
                </ul>
            </li>
            <li <?= get_slot('menu', '') == 'static' ? 'class="active"' : ''?>></a>
                <a class="static_index index" href="JavaScript: void(0)" title="Content"><span></span>Static content</a>
                <ul>

                    <li><a class="pages" href="<?php echo url_for('staticpage/index') ?>" title="Static Pages"><span></span>Static Pages</a></li>
                    <li><a class="pages" href="<?php echo url_for('pagetype/index') ?>" title="PageTypes"><span></span>PageTypes</a></li>
                    <li><a class="emails" href="<?php echo url_for('email/index') ?>" title="Emails"><span></span>Emails</a>

                    </li>
                </ul>
            </li>
            <li <?= (get_slot('menu', '') == 'settings') ? 'class="active"' : ''?>>
                <a class="settings_index index" href="JavaScript: void(0)" title="Settings"><span></span>Settings</a>
                <ul>
                    <li><a class="settings" href="<?php echo url_for('contract/index') ?>" title="Contracts"><span></span>Contracts</a></li>
                    <li><a class="settings" href="<?php echo url_for('creditspackage/index') ?>" title="Creditspackages"><span></span>Creditspackages</a></li>
                    <li><a class="settings" href="<?php echo url_for('theme/index') ?>" title="Themes"><span></span>Themes</a></li>
                    <li><a class="settings" href="<?php echo url_for('propertytype/index') ?>"
                                               title="Propertytypes"><span></span>Propertytypes</a></li>
                    <li><a class="settings" href="<?php echo url_for('currency/index') ?>"
                           title="Currencies"><span></span>Currencies</a></li>
                    <li><a class="settings" href="<?php echo url_for('paymenttype/index') ?>"
                           title="Paymenttypes"><span></span>Paymenttypes</a></li>
                    <li><a class="settings" href="<?php echo url_for('invoicetype/index') ?>"
                           title="Invoicetypes"><span></span>Invoicetypes</a></li>
                    <li><a class="settings" href="<?php echo url_for('propertyview/index') ?>"
                           title="Usertype"><span></span>Views</a></li>
                    <li><a class="settings" href="<?php echo url_for('propertysurrounding/index') ?>"
                           title="Usertype"><span></span>Surroundings</a></li>
                </ul>
            </li>
            <li <?= get_slot('menu', '') == 'transaction' ? 'class="active"' : ''?>></a>
                <a class="static_index" href="<?php echo url_for('transaction/index') ?>" title="Content"><span></span>Transactions</a>
            </li>
        </ul>
        <ul class="right">
            <?/**
            <li <?= get_slot('menu','') == 'statistics' ? 'class="active"' : ''?>>
                <a class="statistics" href="<?php echo url_for('statistics/index') ?>" title="Stats"><span></span>Stats</a>
            </li>*/?>
            <li <?= get_slot('menu', '') == 'admin' ? 'class="active"' : ''?>>
                <a class="admins" href="<?php echo url_for('user/index') ?>" title="Users"><span></span>Users</a>
            </li>
        </ul>
    </nav>

    <?php echo $sf_content ?>

</div>

<?php $aNotification = $sf_user->getNotification();
if ($aNotification != null):?>
    <script type="text/javascript">
        initNotification('<?=$aNotification['sClass']?>', '<?=$aNotification['sMessage']?>');
    </script>
<?php endif;?>
</body>

</html>
