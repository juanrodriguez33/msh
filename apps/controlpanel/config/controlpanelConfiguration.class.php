<?php

class controlpanelConfiguration extends sfApplicationConfiguration
{
    public function setup() {
        $this->enablePlugins('sfPropelPlugin', 'kmDefaultPlugin', 'sfImageTransformPlugin', 'kmAdminThemesPlugin', 'sfSphinxPlugin', 'sfCaptchaGDPlugin');
    }

    public function configure()
    {
    }
}
