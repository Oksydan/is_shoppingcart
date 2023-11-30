<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\Type;

use Oksydan\IsShoppingcart\Configuration\ShoppingCartConfiguration;
use Oksydan\IsShoppingcart\Form\ChoiceProvider\NotificationTypeChoiceProvider;
use Oksydan\IsShoppingcart\Form\ChoiceProvider\PreviewTypeChoiceProvider;
use Oksydan\IsShoppingcart\Translations\TranslationDomains;
use PrestaShopBundle\Form\Admin\Type\MultistoreConfigurationType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ShoppingCartConfigurationType extends TranslatorAwareType
{
    private NotificationTypeChoiceProvider $notificationTypeChoiceProvider;

    private PreviewTypeChoiceProvider $previewTypeChoiceProvider;

    public function __construct(
        TranslatorInterface $translator,
        array $locales,
        NotificationTypeChoiceProvider $notificationTypeChoiceProvider,
        PreviewTypeChoiceProvider $previewTypeChoiceProvider
    ) {
        parent::__construct($translator, $locales);

        $this->notificationTypeChoiceProvider = $notificationTypeChoiceProvider;
        $this->previewTypeChoiceProvider = $previewTypeChoiceProvider;
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
            ])
            ->add('notificationType', ChoiceType::class, [
                'label' => $this->trans('Type of notification', TranslationDomains::TRANSLATION_DOMAIN_ADMIN),
                'choices' => $this->notificationTypeChoiceProvider->getChoices(),
                'multistore_configuration_key' => ShoppingCartConfiguration::IS_CART_NOTIFICATION_TYPE,
            ])
            ->add('previewType', ChoiceType::class, [
                'label' => $this->trans('Type of cart preview', TranslationDomains::TRANSLATION_DOMAIN_ADMIN),
                'choices' => $this->previewTypeChoiceProvider->getChoices(),
                'multistore_configuration_key' => ShoppingCartConfiguration::IS_CART_PREVIEW_TYPE,
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
