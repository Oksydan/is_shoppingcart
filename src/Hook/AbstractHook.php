<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Hook;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;

abstract class AbstractHook implements HookInterface
{
    protected \Is_shoppingcart $module;
    protected \Context $context;
    protected ShoppingCartConfiguration $shoppingCartConfiguration;

    public function __construct(\Is_shoppingcart $module, \Context $context, ShoppingCartConfiguration $shoppingCartConfiguration)
    {
        $this->module = $module;
        $this->context = $context;
        $this->shoppingCartConfiguration = $shoppingCartConfiguration;
    }
}
