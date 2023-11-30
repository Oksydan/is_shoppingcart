<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\Type;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use Oksydan\IsShoppingcart\Translations\TranslationDomains;
use PrestaShopBundle\Form\Admin\Type\MultistoreConfigurationType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ShoppingCartConfigurationType extends TranslatorAwareType
{
    public function __construct(
        TranslatorInterface $translator,
        array $locales
    ) {
        parent::__construct($translator, $locales);
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ajaxCartEnabled', SwitchType::class, [
                'label' => $this->trans('Ajax cart', TranslationDomains::TRANSLATION_DOMAIN_ADMIN),
                'help' => $this->trans('Activate Ajax mode for the cart.', TranslationDomains::TRANSLATION_DOMAIN_ADMIN),
                'multistore_configuration_key' => ShoppingCartConfiguration::IS_BLOCK_CART_AJAX,
            ]);
    }

    /**
     * {@inheritdoc}
     *
     * @see MultistoreConfigurationTypeExtension
     */
    public function getParent(): string
    {
        return MultistoreConfigurationType::class;
    }
}
