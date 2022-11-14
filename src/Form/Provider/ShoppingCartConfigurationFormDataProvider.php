<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\Provider;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

class ShoppingCartConfigurationFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var DataConfigurationInterface
     */
    private $shoppingCartConfigurationDataConfiguration;

    /**
     * @param DataConfigurationInterface $shoppingCartConfigurationDataConfiguration
     */
    public function __construct(DataConfigurationInterface $shoppingCartConfigurationDataConfiguration)
    {
        $this->shoppingCartConfigurationDataConfiguration = $shoppingCartConfigurationDataConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        return $this->shoppingCartConfigurationDataConfiguration->getConfiguration();
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data): array
    {
        return $this->shoppingCartConfigurationDataConfiguration->updateConfiguration($data);
    }
}
