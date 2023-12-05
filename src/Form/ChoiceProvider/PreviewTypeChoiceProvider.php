<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Form\ChoiceProvider;

use Oksydan\IsShoppingcart\Configuration\PreviewTypes;
use Oksydan\IsShoppingcart\Translations\TranslationDomains;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class PreviewTypeChoiceProvider implements FormChoiceProviderInterface
{
    private TranslatorInterface $translator;

    public function __construct(
        TranslatorInterface $translator
    ) {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getChoices(): array
    {
        $choices = [];

        foreach (PreviewTypes::getTypes() as $type) {
            $choices[$this->getLabelByType($type)] = $type;
        }

        return $choices;
    }

    private function getLabelByType(string $type): string
    {
        switch ($type) {
            case PreviewTypes::PREVIEW_TYPE_DROPDOWN:
                return $this->translator->trans('Dropdown', [], TranslationDomains::TRANSLATION_DOMAIN_ADMIN);
            case PreviewTypes::PREVIEW_TYPE_OFFCANVAS:
                return $this->translator->trans('Offcanvas cart', [], TranslationDomains::TRANSLATION_DOMAIN_ADMIN);
            default:
                throw new \InvalidArgumentException(sprintf('Unknown type "%s"', $type));
        }
    }
}