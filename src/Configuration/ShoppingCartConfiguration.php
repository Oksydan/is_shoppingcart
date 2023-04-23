<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Configuration;

class ShoppingCartConfiguration
{
    public const IS_BLOCK_CART_AJAX = 'IS_BLOCK_CART_AJAX';

    public function isAjaxCartEnabled()
    {
        return \Configuration::get(ShoppingCartConfiguration::IS_BLOCK_CART_AJAX);
    }
}
