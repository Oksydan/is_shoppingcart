<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Hook;

use PrestaShop\PrestaShop\Adapter\Presenter\Cart\CartPresenter;

class DisplayTop extends AbstractDisplayHook
{
    private const TEMPLATE_FILE = 'is_shoppingcart.tpl';

    protected function getTemplate(): string
    {
        return DisplayTop::TEMPLATE_FILE;
    }

    protected function assignTemplateVariables(array $params)
    {
        $this->context->smarty->assign([
            'notificationType' => $this->shoppingCartConfiguration->getCartNotificationType(),
            'previewType' => $this->shoppingCartConfiguration->getCartPreviewType(),
            'cart' => (new CartPresenter())->present(isset($params['cart']) ? $params['cart'] : $this->context->cart),
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
        ]);
    }
}
