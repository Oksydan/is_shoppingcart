<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\Provider;

use Oksydan\IsShoppingcart\Form\DataHandler\ShoppingCartConfigurationHandler;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

class ShoppingCartConfigurationFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var ShoppingCartConfigurationHandler
     */
    private ShoppingCartConfigurationHandler $shoppingCartConfigurationDataConfiguration;

    /**
     * @param ShoppingCartConfigurationHandler $shoppingCartConfigurationDataConfiguration
     */
    public function __construct(ShoppingCartConfigurationHandler $shoppingCartConfigurationDataConfiguration)
    {
        $this->shoppingCartConfigurationDataConfiguration = $shoppingCartConfigurationDataConfiguration;
    }

    public function getData(): array
    {
        return $this->shoppingCartConfigurationDataConfiguration->getConfiguration();
    }

    public function setData(array $data)
    {
        $this->shoppingCartConfigurationDataConfiguration->updateConfiguration($data);
    }
}
