<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Hook;

interface HookInterface
{
    public function execute(array $params);
}
