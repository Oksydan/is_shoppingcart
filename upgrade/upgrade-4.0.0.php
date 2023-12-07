<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

use Oksydan\IsShoppingcart\Configuration\NotificationsTypes;
use Oksydan\IsShoppingcart\Configuration\PreviewTypes;
use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;

function upgrade_module_4_0_0($module)
{
    if (Shop::isFeatureActive()) {
        Shop::setContext(Shop::CONTEXT_ALL);
    }

    $res = $module->unregisterHook('displayBeforeBodyClosingTag');
    $res .= $module->registerHook('actionFrontControllerSetMedia');
    $res .= Configuration::updateGlobalValue(ShoppingCartConfiguration::IS_CART_NOTIFICATION_TYPE, NotificationsTypes::NOTIFICATION_TYPE_TOAST) &&
    $res .= Configuration::updateGlobalValue(ShoppingCartConfiguration::IS_CART_PREVIEW_TYPE, PreviewTypes::PREVIEW_TYPE_OFFCANVAS);

    return $res;
}
