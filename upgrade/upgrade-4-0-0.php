<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_4_0_0($module)
{
    $res = $module->unregisterHook('displayBeforeBodyClosingTag');
    $res .= $module->registerHook('actionFrontControllerSetMedia');

    return $res;
}
