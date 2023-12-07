<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Configuration;

class ShoppingCartConfiguration
{
    public const IS_CART_NOTIFICATION_TYPE = 'IS_CART_NOTIFICATION_TYPE';

    public const IS_CART_PREVIEW_TYPE = 'IS_CART_PREVIEW_TYPE';

    public function getCartNotificationType(): ?string
    {
        return \Configuration::get(self::IS_CART_NOTIFICATION_TYPE);
    }

    public function getCartPreviewType(): ?string
    {
        return \Configuration::get(self::IS_CART_PREVIEW_TYPE);
    }
}
