<?php

declare(strict_types=1);

if (!defined('_PS_VERSION_')) {
    exit;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use Oksydan\IsShoppingcart\Hook\HookInterface;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class Is_shoppingcart extends Module
{
    public function __construct()
    {
        $this->name = 'is_shoppingcart';
        $this->tab = 'front_office_features';
        $this->version = '3.0.0';
        $this->author = 'Igor Stępień';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->trans('Shopping cart', [], 'Modules.IsShoppingcart.Admin');
        $this->description = $this->trans('Display a shopping cart icon on your pages and the number of items it contains.', [], 'Modules.IsShoppingcart.Admin');
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_];
        $this->controllers = ['ajax'];
    }

    /**
     * @return bool
     */
    public function install(): bool
    {
        return parent::install()
            && $this->installHooks()
            && $this->installConfiguration();
    }

    /**
     * @return bool
     */
    public function installHooks(): bool
    {
        return $this->registerHook('displayTop')
            && $this->registerHook('displayBeforeBodyClosingTag')
            && $this->registerHook('actionFrontControllerSetMedia');
    }

    /**
     * @return bool
     */
    public function installConfiguration(): bool
    {
        return \Configuration::updateValue(ShoppingCartConfiguration::IS_BLOCK_CART_AJAX, 1);
    }

    /**
     * @return bool
     */
    public function uninstall(): bool
    {
        return parent::uninstall();
    }

    /** @param string $methodName */
    public function __call($methodName, array $arguments)
    {
        if (str_starts_with($methodName, 'hook')) {
            if ($hook = $this->getHookObject($methodName)) {
                return $hook->execute(...$arguments);
            }
        } else {
            return null;
        }
    }

    /**
     * @param string $methodName
     *
     * @return HookInterface|null
     */
    private function getHookObject($methodName)
    {
        $serviceName = sprintf(
            'oksydan.is_shoppingcart.hook.%s',
            \Tools::toUnderscoreCase(str_replace('hook', '', $methodName))
        );

        $hook = $this->getService($serviceName);

        return $hook instanceof HookInterface ? $hook : null;
    }

    /**
     * @template T
     *
     * @param class-string<T>|string $serviceName
     *
     * @return T|object|null
     */
    public function getService($serviceName)
    {
        try {
            return $this->get($serviceName);
        } catch (ServiceNotFoundException $exception) {
            return null;
        }
    }

    public function getContent(): void
    {
        \Tools::redirectAdmin(SymfonyContainer::getInstance()->get('router')->generate('is_shoppingcart_controller'));
    }
}
