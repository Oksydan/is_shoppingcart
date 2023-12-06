<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Hook;

class ActionFrontControllerSetMedia extends AbstractHook
{
    public function execute(array $params)
    {
        \Media::addJsDef([
            'refreshCartPreviewUrl' => $this->context->link->getModuleLink($this->module->name, 'ajax', [
                'action' => 'getCartPreview',
                'ajax' => '1',
            ]),
        ]);
    }
}
