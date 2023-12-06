<?php

namespace Oksydan\IsShoppingcart\Persister;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use Oksydan\IsShoppingcart\DTO\CartProductDTO;
use PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter;

class TemplateVarsPersister
{
    private \Context $context;

    private ShoppingCartConfiguration $shoppingCartConfiguration;

    public function __construct(
        \Context $context,
        ShoppingCartConfiguration $shoppingCartConfiguration
    ) {
        $this->context = $context;
        $this->shoppingCartConfiguration = $shoppingCartConfiguration;
    }

    public function persist(CartProductDTO $cartProductDTO): void
    {
        $this->assignDefaultVariables();
        $this->assignCartAddedProductVariables($cartProductDTO);
    }

    private function assignDefaultVariables()
    {
        $this->context->smarty->assign([
            'previewType' => $this->shoppingCartConfiguration->getCartPreviewType(),
            'cart_url' => $this->context->link->getPageLink(
                'cart',
                null,
                $this->context->language->id,
                [
                    'action' => 'show',
                ],
                false,
                null,
                true
            ),
            'cart' => $this->context->smarty->getTemplateVars('cart') ?? (new CartPresenter())->present($this->context->cart),
        ]);
    }

    private function assignCartAddedProductVariables(CartProductDTO $cartProductDTO)
    {
        $product = null;

        if ($cartProductDTO->getIdProduct() && isset($this->context->smarty->getTemplateVars('cart')['products'])) {
            foreach ($this->context->smarty->getTemplateVars('cart')['products'] as $p) {
                if ((int) $p['id_product'] == $cartProductDTO->getIdProduct() &&
                    (int) $p['id_product_attribute'] == $cartProductDTO->getIdProductAttribute() &&
                    (int) $p['id_customization'] == $cartProductDTO->getIdCustomization()) {
                    $product = $p;
                    break;
                }
            }
        }

        $this->context->smarty->assign([
            'product' => $product,
        ]);
    }
}
