<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Hook;

class ActionFrontControllerSetMedia extends AbstractHook
{
    public function execute(array $params): void
    {
        if (!\Configuration::isCatalogMode() && $this->shoppingCartConfiguration->isAjaxCartEnabled()) {
            $this->context->controller->registerJavascript(
                'modules-is_shoppingcart',
                "modules/{$this->module->name}/views/js/is_shoppingcart.js",
                [
                    'position' => 'bottom',
                    'priority' => 150,
                ]
            );
        }
    }
}
