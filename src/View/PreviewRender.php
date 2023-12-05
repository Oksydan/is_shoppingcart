<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\View;

use Oksydan\IsShoppingcart\Configuration\PreviewTypes;
use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter;

class PreviewRender implements PreviewRenderInterface
{
    private const TEMPLATE_OFFCANVAS_CONTENT = 'preview-content-offcanvas.tpl';
    private const TEMPLATE_DROPDOWN_CONTENT = 'preview-content-dropdown.tpl';

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
            "module:{$this->module->name}/views/templates/front/{$this->getTemplate()}"
        );
    }

    private function assignVariables(\Cart $cart)
    {
        $this->context->assign([
            'previewType' => $this->shoppingCartConfiguration->getCartPreviewType(),
            'cart' => $this->context->smarty->getTemplateVars('cart') ?? (new CartPresenter())->present($cart),
        ]);
    }

    private function getTemplate(): string
    {
        switch ($this->shoppingCartConfiguration->getCartPreviewType()) {
            case PreviewTypes::PREVIEW_TYPE_OFFCANVAS:
                return self::TEMPLATE_OFFCANVAS_CONTENT;
            case PreviewTypes::PREVIEW_TYPE_DROPDOWN:
                return self::TEMPLATE_DROPDOWN_CONTENT;
            default:
                throw new \Exception('Unknown preview type');
        }
    }
}
