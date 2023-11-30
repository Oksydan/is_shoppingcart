<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\DataHandler;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use PrestaShop\PrestaShop\Core\Configuration\AbstractMultistoreConfiguration;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShoppingCartConfigurationHandler extends AbstractMultistoreConfiguration
{
    private const CONFIGURATION_FIELDS = [
        'ajaxCartEnabled',
        'notificationType',
        'previewType',
    ];

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        return (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('ajaxCartEnabled', 'bool')
            ->setAllowedTypes('notificationType', 'string')
            ->setAllowedTypes('previewType', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];
        $shopConstraint = $this->getShopConstraint();

        $return['ajaxCartEnabled'] = $this->configuration->get(
            ShoppingCartConfiguration::IS_BLOCK_CART_AJAX,
            null,
            $shopConstraint
        );
        $return['notificationType'] = $this->configuration->get(
            ShoppingCartConfiguration::IS_CART_NOTIFICATION_TYPE,
            null,
            $shopConstraint
        );
        $return['previewType'] = $this->configuration->get(
            ShoppingCartConfiguration::IS_CART_PREVIEW_TYPE,
            null,
            $shopConstraint
        );

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $shopConstraint = $this->getShopConstraint();

        $this->updateConfigurationValue(
            ShoppingCartConfiguration::IS_BLOCK_CART_AJAX,
            'ajaxCartEnabled',
            $configuration,
            $shopConstraint
        );

        $this->updateConfigurationValue(
            ShoppingCartConfiguration::IS_CART_NOTIFICATION_TYPE,
            'notificationType',
            $configuration,
            $shopConstraint
        );

        $this->updateConfigurationValue(
            ShoppingCartConfiguration::IS_CART_PREVIEW_TYPE,
            'previewType',
            $configuration,
            $shopConstraint
        );

        return [];
    }
}
