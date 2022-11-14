<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\DataConfiguration;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use PrestaShop\PrestaShop\Core\Configuration\AbstractMultistoreConfiguration;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Handles configuration data for demo multistore configuration options.
 */
final class ShoppingCartDataConfiguration extends AbstractMultistoreConfiguration
{
    private const CONFIGURATION_FIELDS = [
        'ajaxCartEnabled',
    ];

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        return (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('ajaxCartEnabled', 'bool');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];
        $shopConstraint = $this->getShopConstraint();

        $return['ajaxCartEnabled'] = $this->configuration->get(ShoppingCartConfiguration::IS_BLOCK_CART_AJAX, null, $shopConstraint);

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $shopConstraint = $this->getShopConstraint();
        $this->updateConfigurationValue(ShoppingCartConfiguration::IS_BLOCK_CART_AJAX, 'ajaxCartEnabled', $configuration, $shopConstraint);

        return [];
    }
}
