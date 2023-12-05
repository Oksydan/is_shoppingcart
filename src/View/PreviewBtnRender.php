<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\View;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter;

class PreviewBtnRender implements PreviewRenderInterface
{
    private const TEMPLATE = 'header-btn.tpl';

    private \Context $context;

    private \Is_shoppingcart $module;

    private ShoppingCartConfiguration $shoppingCartConfiguration;

    public function __construct(
        \Context $context,
        \Is_shoppingcart $module,
        ShoppingCartConfiguration $shoppingCartConfiguration
    )
    {
        $this->context = $context;
        $this->module = $module;
        $this->shoppingCartConfiguration = $shoppingCartConfiguration;
    }


    public function render(\Cart $cart): string
    {
        $this->assignVariables($cart);

        return $this->context->smarty->fetch(
            "module:{$this->module->name}/views/templates/front/{self::TEMPLATE}"
        );
    }

    private function assignVariables(\Cart $cart)
    {
        $this->context->assign([
            'previewType' => $this->shoppingCartConfiguration->getCartPreviewType(),
            'cart' => $this->context->smarty->getTemplateVars('cart') ?? (new CartPresenter())->present($cart),
        ]);
    }
}
