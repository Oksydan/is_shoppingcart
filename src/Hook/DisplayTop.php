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
            'cart' => (new CartPresenter())->present(isset($params['cart']) ? $params['cart'] : $this->context->cart),
            'refresh_url' => $this->context->link->getModuleLink($this->module->name, 'ajax', [], null, null, null, true),
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
