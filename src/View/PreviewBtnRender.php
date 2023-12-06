<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\View;

class PreviewBtnRender implements PreviewRenderInterface
{
    private const TEMPLATE = 'header-btn.tpl';

    private \Context $context;

    private \Is_shoppingcart $module;

    public function __construct(
        \Context $context,
        \Is_shoppingcart $module
    ) {
        $this->context = $context;
        $this->module = $module;
    }

    public function render(): string
    {
        $template = self::TEMPLATE;

        return $this->context->smarty->fetch(
            "module:{$this->module->name}/views/templates/front/{$template}"
        );
    }
}
