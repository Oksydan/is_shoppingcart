<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\ChoiceProvider;

use Oksydan\IsShoppingcart\Translations\TranslationDomains;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class NotificationTypeChoiceProvider implements FormChoiceProviderInterface
{
    private TranslatorInterface $translator;

    public const TYPES = [
        'modal',
        'toast',
        'none',
    ];

    public function __construct(
        TranslatorInterface $translator
    )
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getChoices(): array
    {
        $choices = [];

        foreach (self::TYPES as $type) {
            $choices[$this->getLabelByType($type)] = $type;
        }

        return $choices;
    }

    private function getLabelByType(string $type): string
    {
        switch ($type) {
            case 'modal':
                return $this->translator->trans('Modal', [], TranslationDomains::TRANSLATION_DOMAIN_ADMIN);
            case 'toast':
                return $this->translator->trans('Floating toast', [], TranslationDomains::TRANSLATION_DOMAIN_ADMIN);
            case 'none':
                return $this->translator->trans('No notification', [], TranslationDomains::TRANSLATION_DOMAIN_ADMIN);
            default:
                throw new \InvalidArgumentException(sprintf('Unknown type "%s"', $type));
        }
    }
}
