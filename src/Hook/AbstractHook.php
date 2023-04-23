<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Hook;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;

abstract class AbstractHook implements HookInterface
{
    protected $module;
    protected $context;
    protected $shoppingCartConfiguration;

    public function __construct(\Module $module, \Context $context, ShoppingCartConfiguration $shoppingCartConfiguration)
    {
        $this->module = $module;
        $this->context = $context;
        $this->shoppingCartConfiguration = $shoppingCartConfiguration;
    }
}
